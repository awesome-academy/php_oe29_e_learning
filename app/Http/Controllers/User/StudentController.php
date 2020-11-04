<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;

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
}
