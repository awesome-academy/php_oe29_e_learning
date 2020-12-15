<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\Advisor;
use App\Models\Message;
use Auth;
use App\Events\MessageEvent;
use App\Events\MyEvent;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Advisor\AdvisorRepositoryInterface;
use App\Repositories\Message\MessageRepositoryInterface;

class HomeController extends Controller
{
    protected $courseRepo, $userRepo, $advisorRepo, $messageRepo;

    public function __construct(
        CourseRepositoryInterface $courseRepo,
        UserRepositoryInterface $userRepo,
        AdvisorRepositoryInterface $advisorRepo,
        MessageRepositoryInterface $messageRepo
    ) {
        $this->courseRepo = $courseRepo;
        $this->userRepo = $userRepo;
        $this->advisorRepo = $advisorRepo;
        $this->messageRepo = $messageRepo;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $courses = $this->courseRepo->getLatestCourse(['image'], config('title.course_number'));

        return view('user.component.index', compact('courses'));
    }

    public function course()
    {
        $courses = $this->courseRepo->getAll(['image']);
        
        return view('user.component.course', compact('courses'));
    }

    public function showLessons($course)
    {
        $course = $this->courseRepo->loadRelations($course, ['image', 'lessons', 'comments.user.image']);
        
        return view('user.component.lessons', compact('course'));
    }

    public function showMentors()
    {   
        $mentors = $this->userRepo->getData(['mentorComments.user.image', 'image'], ['role_id' => config('role.mentor_id')]);
        foreach ($mentors as $mentor) {
            $rate = config('rate.default');
            foreach ($mentor->mentorComments as $comment) {
                $rate += $comment->rate;
            }
            if ($rate) {
                $mentor->rate = floor($rate/($mentor->mentorComments->count()));
            }
        }
        $mentorHasBeenBooked = $this->advisorRepo->getMessageSendFromMentor(Auth::id());
        
        return view('user.component.mentor', compact('mentors', 'mentorHasBeenBooked'));
    }
}
