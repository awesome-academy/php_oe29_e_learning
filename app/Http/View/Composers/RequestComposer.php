<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Advisor;
use Auth;

class RequestComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (Auth::check()) {
            $acceptedRequests = Advisor::where([[Auth::user()->role_id == config('role.student_id') ? 'student_id' : 'mentor_id', Auth::id()], ['status', config('status.request.accept_number')]])->get();
            $view->with('acceptedRequests', $acceptedRequests);
        }
    }
}
