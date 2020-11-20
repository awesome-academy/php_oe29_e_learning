<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Exercise;
use App\Models\User;
use Auth;
use Alert;

class StudentController extends Controller
{
    public function index()
    {
        $students = Role::findOrFail(config('role.student_id'))->users;

        return view('admin.component.student', compact('students'));
    }

    public function exercises()
    {
        $exercises = Exercise::whereHas('users')->with(['users' => function($query) {
            $query->where('exercise_user.status', config('status.exercise.pending_number'));
        }])->paginate(config('paginate.exercise_number'));

        return view('admin.component.exercises_user', compact('exercises'));
    }

    public function acceptExercise(Request $request, Exercise $exercise)
    {
        $user = User::findOrFail($request->student_id);
        $exercise->users()->updateExistingPivot($user, ['status' => config('status.exercise.finish_number')]);
        Alert::success(trans('label.updated_success'));

        return back();
    }

    public function rejectExercise(Request $request, Exercise $exercise)
    {
        $exercise->load('lesson');
        $user = User::findOrFail($request->student_id);
        $exercise->users()->updateExistingPivot($user, ['status' => config('status.exercise.reject_number')]);
        $exercise->lesson->users()->updateExistingPivot($user, ['status' => config('status.course.progress_number')]);
        Alert::success(trans('label.updated_success'));

        return back();
    }
}
