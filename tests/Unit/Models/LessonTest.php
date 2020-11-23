<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Exercise;
use App\Models\Comment;
use App\Models\Advisor;

class LessonTest extends TestCase
{
    protected $lesson;

    public function setUp() : void
    {
        parent::setUp();
        $this->lesson = new Lesson();
    }

    public function tearDown() : void
    {
        parent::tearDown();
        $this->lesson = null;
    }

    public function test_contains_valid_fillable_properties()
    {
        $this->assertFillableProperties([
            'title',
            'description',
            'video_url',
            'course_id',
            'course_order',
        ], $this->lesson);
    }

    public function test_lesson_has_belongstomany_relationship_with_users()
    {
        $this->assertBelongsToMany(User::class, 'lesson_id', 'user_id', $this->lesson, 'users');
    }

    public function test_lesson_has_hasmany_relationship_with_exercises()
    {
        $this->assertHasMany(Exercise::class, 'lesson_id', $this->lesson, 'exercises');
    }

    public function test_lesson_has_hasmany_relationship_with_requests()
    {
        $this->assertHasMany(Advisor::class, 'lesson_id', $this->lesson, 'requests');
    }

    public function test_lesson_has_morphmany_relationship_with_mentor_comments()
    {
        $this->assertMorphMany(Comment::class, 'commentable', $this->lesson, 'comments');
    }

    public function test_lesson_has_belongsto_relationship_with_role()
    {
        $this->assertBelongsTo(Course::class, 'course_id', 'id', $this->lesson, 'course');
    }
}
