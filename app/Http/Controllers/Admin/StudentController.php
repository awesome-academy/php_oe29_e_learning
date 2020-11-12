<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Exercise;

class StudentController extends Controller
{
    public function index()
    {
        $students = Role::findOrFail(config('role.student_id'))->users;

        return view('admin.component.student', compact('students'));
    }

    public function exercises()
    {
        $students = Role::findOrFail(config('role.student_id'))->users;
        $students->load('exercises');

        return view('admin.component.exercises_user', compact('students'));
    }
}
