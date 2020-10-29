<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $courses = Course::with('image')->latest('created_at')->take(config('title.course_number'))->get();
        
        return view('user.component.index', compact('courses'));
    }

    public function course()
    {
        $courses = Course::with('image')->get();
        
        return view('user.component.course', compact('courses'));
    }
}
