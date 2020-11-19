<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Exercise;
use App\Models\Course;
use App\Models\User;
use App\Models\Advisor;
use Auth;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\BookMentorRequest;
use Illuminate\Support\Facades\DB;
use Exception;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showLessonById($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->load(['course', 'comments.user.image', 'exercises.users' => function($query) {
            $query->where('user_id', Auth::id());
        }]);
        $lessonsOfUser = $this->getLessonsOfStudentByCourseId($lesson->course->id);
        $course = $lesson->course->load('lessons.exercises');
        foreach ($course->lessons as $lessonOfCourse) {
            foreach ($lessonsOfUser as $lessonUser) {
                if ($lessonOfCourse->id == $lessonUser->id) {
                    $lessonOfCourse->status = $lessonUser->pivot->status;

                    break;
                } else {
                    $lessonOfCourse->status = config('status.course.not_register_number');
                }
            }
        }

        return view('user.component.lesson_detail', compact('lesson', 'course'));
    }

    public function enrollLesson($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->load('course', 'exercises');
        $lessonsOfUser = $this->getLessonsOfStudentByCourseId($lesson->course->id);
        $notRegisterLessons = Lesson::where([
            ['course_id', $lesson->course->id], 
            ['course_order', '>', $lessonsOfUser->last()->course_order], 
        ])->orderBy('course_order', 'asc')->get();
        if ($notRegisterLessons->first()->course_order >= $lesson->course_order) {
            if (!$lessonsOfUser->contains($lesson)) {
                foreach ($lessonsOfUser as $lessonOfUser) {
                    if ($lessonOfUser->pivot->status == config('status.course.progress_number')) {

                        return redirect()->route('course.lesson', [$lessonOfUser->id])->with('error', trans('label.need_finish'));
                    }
                }
                DB::transaction(function() use($lesson) {
                    try {
                        if ($lesson->exercises->count() > 0) {
                            $lesson->users()->attach(Auth::user()->id, ['status' => config('status.course.progress_number')]);
                        } else {
                            $lesson->users()->attach(Auth::user()->id, ['status' => config('status.course.finish_number')]);
                        }
                    } catch (Exception $exception) {
                        abort(403);
                    }
                });
            }

            return redirect()->route('course.lesson', [$id]);
        }

        return back()->with('error', trans('label.need_finish'));
    }

    public function enrollCourse(Course $course)
    {
        $lessons = $this->getLessonsOfStudentByCourseId($course->id);
        foreach ($lessons as $lesson) {
            if ($lesson->pivot->status == config('status.course.progress_number')) {
                
                return redirect()->route('course.lesson', [$lesson->id]);
            }
        }

        return redirect()->route('course.lesson', [$lessons->last()->id]);
    }

    public function getLessonsOfStudentByCourseId($id)
    {
        return Auth::user()->lessons()->where('course_id', $id)->get();
    }

    public function storeEnrollCourse(Request $request)
    {
        $course = Course::findOrFail($request->course_id);
        $course->load('users', 'lessons');
        if ($course->users->contains(Auth::user())) {
            return redirect()->route('course.enroll', [$request->course_id]);
        } else {
            DB::transaction(function() use($course) {
                try {
                    $course->users()->attach(Auth::user()->id, ['status' => config('status.course.progress_number')]);
                    $course->lessons->first()->users()->attach(Auth::user()->id, ['status' => config('status.course.progress_number')]);
                } catch (Exception $exception) {
                    abort(403);
                }
            });   
        }

        return redirect()->route('course.lesson', [$course->lessons->first()->id]);
    }

    public function storeCourseComment(StoreCommentRequest $request, Course $course)
    {
        $course->comments()->create([
            'content' => $request->content, 
            'user_id' => Auth::id(), 
            'rate' => config('rate.default'),
        ]);

        return redirect()->route('course.lessons', [$course->id]);
    }
    
    public function storeLessonComment(StoreCommentRequest $request, Lesson $lesson)
    {
        $lesson->comments()->create([
            'content' => $request->content, 
            'user_id' => Auth::id(),
            'rate' => config('rate.default'),
        ]);

        return redirect()->route('course.lesson', [$lesson->id]);
    }

    public function bookMentor(Request $request)
    {
        Advisor::create([
            'lesson_id' => $request->lesson_id,
            'student_id' => Auth::id(),
            'status' => config('status.request.pending_number'),
        ]);

        return redirect()->back()->with('message', trans('label.book_success'));
    }
    
    public function storeExercise(Request $request)
    {
        $exercise = Exercise::findOrFail($request->exercise_id);
        $exercise->load('lesson');
        $lesson = Lesson::findOrFail($exercise->lesson->id);
        $lesson->load('exercises');
        $exercisesOfUser = $this->getExercisesOfUserByLessonId($lesson->id);
        DB::transaction(function() use($request, $lesson, $exercise, $exercisesOfUser) {
            try {
                if ($exercisesOfUser->contains($exercise)) {
                    Auth::user()->exercises()->updateExistingPivot($request->exercise_id, [
                        'submit_url' => $request->submit_url,
                        'status' => config('status.exercise.pending_number'),
                    ]);
                } else {
                    Auth::user()->exercises()->attach($request->exercise_id, [
                        'status' => config('status.exercise.pending_number'),
                        'submit_url' => $request->submit_url,
                    ]);
                }
                $exercisesOfUser = $this->getExercisesOfUserByLessonId($lesson->id);
                if ($exercisesOfUser->count() == $lesson->exercises->count()) {
                    $flag = false;
                    foreach ($exercisesOfUser as $exercise) {
                        if ($exercise->pivot->status == config('status.exercise.reject_number')) {
                            $flag = true;
                            break;
                        }
                    }
                    if (!$flag) {
                        Auth::user()->lessons()->updateExistingPivot($lesson, ['status' => config('status.course.finish_number')]);
                    }
                }
            } catch (Exception $exception) {
                abort(403);
            }
        });

        return redirect()->back();
    }

    public function getExercisesOfUserByLessonId($id)
    {
        return Auth::user()->exercises()->where('lesson_id', $id)->get();
    }

    public function storeRating(StoreRatingRequest $request, User $mentor)
    {
        DB::transaction(function() use($request, $mentor) {
            try {
                $mentor->mentorComments()->create([
                    'content' => $request->content,
                    'rate' => $request->rate,
                    'user_id' => Auth::id(),
                ]);
                $request = Advisor::findOrFail($request->request_id);
                $request->update(['status' => config('status.request.finish_number')]);
            } catch (Exception $exception) {
                abort(403);
            }
        });
        
        return back();
    }
}
