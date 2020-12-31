<?php

namespace Tests\Unit\Mail;

use Tests\TestCase;
use App\Mail\RemindStudent;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class RemindStudentTest extends TestCase
{
    protected $user;
    protected $remindStudentMail;

    public function setUp() : void
    {
        parent::setUp();
        $this->user = factory(User::class)->make();
        $this->remindStudentMail = new RemindStudent($this->user);
    }

    public function tearDown() : void
    {
        unset($this->user);
        unset($this->remindStudentMail);
        parent::tearDown();
    }

    public function test_build_return_markdown_with_data()
    {
        Mail::fake();
        Mail::send($this->remindStudentMail);
        Mail::assertSent(RemindStudent::class);
        Mail::assertSent(RemindStudent::class, function ($mail) {
            $mail->build();
            $this->assertEquals($mail->viewData['username'], $this->user->name);
            $this->assertEquals($mail->viewData['url'], route('home'));

            return true;
        });
    }
}
