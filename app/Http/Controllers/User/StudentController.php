<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\User;
use App\Models\Advisor;
use Auth;
use App\Http\Requests\StoreCommentRequest;
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
        $lesson->load(['course', 'comments.user.image', 'exercises']);
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
        $lesson->load('course');
        $lessons = $this->getLessonsOfStudentByCourseId($lesson->course->id);
        if (!$lessons->contains($lesson)) {
            foreach ($lessons as $lesson) {
                if ($lesson->pivot->status == config('status.course.progress_number')) {
                    return redirect()->route('course.lesson', [$lesson->id]);
                }
            }
            DB::transaction(function() use($lesson, $lessons) {
                try {
                    $lessons->last()->users()->updateExistingPivot(Auth::user(), ['status'=> config('status.course.finish_number')]);
                    $lesson->users()->attach(Auth::user()->id, ['status' => config('status.course.progress_number')]);
                } catch (Exception $exception) {
                    abort(403);
                }
            });
        }

        return redirect()->route('course.lesson', [$id]);
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
}
