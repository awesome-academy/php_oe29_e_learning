<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Exercise;
use App\Models\Comment;
use App\Models\Advisor;
use App\Models\Image;

class UserTest extends TestCase
{
    protected $user;

    public function setUp() : void
    {
        parent::setUp();
        $this->user = new User();
    }

    public function tearDown() : void
    {
        parent::tearDown();
        $this->user = null;
    }

    public function test_contains_valid_fillable_properties()
    {
        $this->assertFillableProperties([
            'name',
            'email',
            'password',
            'status',
            'phone',
            'status',
            'date_of_birth',
            'address',
            'github_url',
            'role_id',
            'last_studied_at',
        ], $this->user);
    }

    public function test_contains_valid_casts_properties()
    {
        $this->assertCastsProperties([
            'id' => 'int',
            'email_verified_at' => 'datetime',
        ], $this->user);
    }

    public function test_contains_valid_hidden_properties()
    {
        $this->assertHiddenProperties([
            'password', 
            'remember_token',
        ], $this->user);
    }

    public function test_user_has_belongsto_relationship_with_role()
    {
        $this->assertBelongsTo(Role::class, 'role_id', 'id', $this->user, 'role');
    }

    public function test_user_has_belongstomany_relationship_with_courses()
    {
        $this->assertBelongsToMany(Course::class, 'user_id', 'course_id', $this->user, 'courses');
    }

    public function test_user_has_belongstomany_relationship_with_lessons()
    {
        $this->assertBelongsToMany(Lesson::class, 'user_id', 'lesson_id', $this->user, 'lessons');
    }

    public function test_user_has_belongstomany_relationship_with_exercises()
    {
        $this->assertBelongsToMany(Exercise::class, 'user_id', 'exercise_id', $this->user, 'exercises');
    }

    public function test_user_has_hasmany_relationship_with_comments()
    {
        $this->assertHasMany(Comment::class, 'user_id', $this->user, 'comments');
    }

    public function test_user_has_morphmany_relationship_with_mentor_comments()
    {
        $this->assertMorphMany(Comment::class, 'commentable', $this->user, 'mentorComments');
    }

    public function test_user_has_hasmany_relationship_with_student_requests()
    {
        $this->assertHasMany(Advisor::class, 'student_id', $this->user, 'studentRequests');
    }

    public function test_user_has_hasmany_relationship_with_mentor_requests()
    {
        $this->assertHasMany(Advisor::class, 'mentor_id', $this->user, 'mentorRequests');
    }

    public function test_user_has_morphone_relationship_with_image()
    {
        $this->assertMorphOne(Image::class, 'imageable', $this->user, 'image');
    }
}
