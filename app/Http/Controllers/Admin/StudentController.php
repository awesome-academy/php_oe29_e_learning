<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class StudentController extends Controller
{
    public function index()
    {
        $students = Role::findOrFail(config('role.student_id'))->users;

        return view('admin.component.student', compact('students'));
    }
}
