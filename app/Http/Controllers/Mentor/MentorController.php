<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advisor;

class MentorController extends Controller
{
    public function index()
    {
        $coaches = Advisor::where('status', config('status.request.pending_number'))->paginate(config('paginate.lesson_number'));
        $coaches->load('student', 'lesson.course');

        return view('mentor.component.request', compact('coaches'));
    }
}
