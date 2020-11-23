<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Comment;
use App\Models\Image;

class CourseTest extends TestCase
{
    protected $course;

    public function setUp() : void
    {
        parent::setUp();
        $this->course = new Course();
    }

    public function tearDown() : void
    {
        parent::tearDown();
        $this->course = null;
    }

    public function test_contains_valid_fillable_properties()
    {
        $this->assertFillableProperties([
            'name',
            'description',
        ], $this->course);
    }

    public function test_course_has_belongstomany_relationship_with_users()
    {
        $this->assertBelongsToMany(User::class, 'course_id', 'user_id', $this->course, 'users');
    }

    public function test_course_has_hasmany_relationship_with_lessons()
    {
        $this->assertHasMany(Lesson::class, 'course_id', $this->course, 'lessons');
    }

    public function test_course_has_morphmany_relationship_with_comments()
    {
        $this->assertMorphMany(Comment::class, 'commentable', $this->course, 'comments');
    }

    public function test_course_has_morphone_relationship_with_image()
    {
        $this->assertMorphOne(Image::class, 'imageable', $this->course, 'image');
    }
}
