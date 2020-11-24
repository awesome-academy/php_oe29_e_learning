<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Comment;

class CommentTest extends TestCase
{
    protected $comment;

    public function setUp() : void
    {
        parent::setUp();
        $this->comment = new Comment();
    }

    public function tearDown() : void
    {
        parent::tearDown();
        $this->comment = null;
    }

    public function test_contains_valid_fillable_properties()
    {
        $this->assertFillableProperties([
            'content',
            'commentable_id',
            'comentable_type',
            'rate',
            'user_id',
        ], $this->comment);
    }

    public function test_comment_has_belongsto_relationship_with_user()
    {
        $this->assertBelongsTo(User::class, 'user_id', 'id', $this->comment, 'user');
    }

    public function test_comment_has_morphto_relationship_with_user()
    {
        $this->assertMorphTo(User::class, $this->comment, 'commentable');
    }

    public function test_comment_has_morphto_relationship_with_course()
    {
        $this->assertMorphTo(Course::class, $this->comment, 'commentable');
    }

    public function test_comment_has_morphto_relationship_with_lesson()
    {
        $this->assertMorphTo(Lesson::class, $this->comment, 'commentable');
    }
}
