<?php

namespace Tests\Unit\Jobs;

use Tests\TestCase;
use App\Jobs\ProcessMailer;
use App\Mail\RemindStudent;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ProcessMailerTest extends TestCase
{
    protected $user;
    protected $job;

    public function setUp() : void
    {
        parent::setUp();
        $this->user = factory(User::class)->make();
        $this->job = new ProcessMailer($this->user);
    }

    public function tearDown() : void
    {
        unset($this->user);
        unset($this->job);
        parent::tearDown();
    }

    public function test_handle_send_mail()
    {
        Mail::fake();
        $this->job->handle();
        Mail::assertSent(RemindStudent::class);
        Mail::assertSent(RemindStudent::class, function($mail) {
            return $mail->hasTo($this->user);
        });
    }
}
