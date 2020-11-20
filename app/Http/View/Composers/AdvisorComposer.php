<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Advisor;
use Auth;

class AdvisorComposer
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
            $requestsOfUser = Advisor::whereNotNull('mentor_id')
                ->where([['student_id', Auth::id()], ['status', config('status.request.accept_number')]])
                ->with('mentor.image', 'lesson.course')
                ->get();
            
            $view->with('requestsOfUser', $requestsOfUser);
        }
    }
}
