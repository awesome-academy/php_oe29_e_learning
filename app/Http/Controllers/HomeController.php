<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\Advisor;
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

    public function showLessons(Course $course)
    {
        $course->load(['image', 'lessons', 'comments.user.image']);
        
        return view('user.component.lessons', compact('course'));
    }

    public function showMentors()
    {   
        $mentors = User::with('mentorComments.user.image', 'image')->where('role_id', config('role.mentor_id'))->get();
        foreach ($mentors as $mentor) {
            $rate = config('rate.default');
            foreach ($mentor->mentorComments as $comment) {
                $rate += $comment->rate;
            }
            if ($rate) {
                $mentor->rate = floor($rate/($mentor->mentorComments->count()));
            }
        }

        return view('user.component.mentor', compact('mentors'));
    }
}
