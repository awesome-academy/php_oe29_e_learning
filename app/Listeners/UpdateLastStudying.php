<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\StudentStudying;
use App\Models\User;
use Auth;

class UpdateLastStudying
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(StudentStudying $event)
    {
        $event->user->update(['last_studied_at' => $event->currentTime]);
    }
}
