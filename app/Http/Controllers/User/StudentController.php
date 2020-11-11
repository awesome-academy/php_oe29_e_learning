<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\User;
use App\Http\Requests\StoreCommentRequest;
use Auth;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showLesson($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->load(['course', 'comments.user.image']);
        $course = $lesson->course->load('lessons');

        return view('user.component.lesson_detail', compact('lesson', 'course'));
    }

    public function storeCourseComment(StoreCommentRequest $request, Course $course)
    {
        $course->comments()->create([
            'content' => $request->content, 
            'user_id' => Auth::id(), 
            'rate' => config('rate.default'),
        ]);

        return redirect()->route('course.lesson', [$lesson->id]);
    }
    
    public function storeLessonComment(StoreCommentRequest $request, Lesson $lesson)
    {
        $lesson->comments()->create([
            'content' => $request->content, 
            'user_id' => Auth::id(), 
            'rate' => config('rate.default'),
        ]);

        return redirect()->route('course.lessons', [$course->id]);
        
    }
}
