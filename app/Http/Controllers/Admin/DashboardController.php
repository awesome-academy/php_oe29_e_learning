<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;

class DashboardController extends Controller
{
    public function index()
    {
        $students = $this->getUserByRole(config('role.student_id'));
        $mentors = $this->getUserByRole(config('role.mentor_id'));
        $lessons = Lesson::all();
        $courses = Course::all();

        return view('admin.component.dashboard', compact('students', 'mentors', 'lessons', 'courses'));
    }

    public function getUserByRole($role)
    {
        $user = User::where('role_id', $role)->get();

        return $user;
    }

    public function getAllMentors()
    {
        $mentors = $this->getUserByRole(config('role.mentor_id'));

        return view('admin.component.mentor', compact('mentors'));
    }
}
