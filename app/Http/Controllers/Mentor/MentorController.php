<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advisor;
use Auth;
use Alert;

class MentorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $coaches = Advisor::where('status', config('status.request.pending_number'))->paginate(config('paginate.lesson_number'));
        $coaches->load('student', 'lesson.course');

        return view('mentor.component.request', compact('coaches'));
    }

    public function showRequestHistory()
    {
        $histories = Advisor::where([['status', config('status.request.finish_number')], ['mentor_id', Auth::id()]])->paginate(config('paginate.lesson_number'));
        $histories->load(['student.comments' => function($query) {
            $query->where([['commentable_type', config('type.mentor')], ['commentable_id', Auth::id()]]); 
        }, 'lesson.course']);

        return view('mentor.component.history', compact('histories'));
    }
    
    public function acceptRequest(Advisor $advisor)
    {
        $success = $advisor->update(['status' => config('status.request.finish_number')]);
        if ($success) {
            Alert::success(trans('label.accept_success'));
        } else {
            Alert::success(trans('label.accept_fail'));
        }
        
        return back();
    }
}
