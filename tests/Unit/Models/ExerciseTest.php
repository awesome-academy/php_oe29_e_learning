<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Exercise;

class ExerciseTest extends TestCase
{
    protected $exercise;

    public function setUp() : void
    {
        parent::setUp();
        $this->exercise = new Exercise();
    }

    public function tearDown() : void
    {
        parent::tearDown();
        $this->exercise = null;
    }

    public function test_contains_valid_fillable_properties()
    {
        $this->assertFillableProperties([
            'title',
            'url',
            'submit_url',
            'lesson_id',
        ], $this->exercise);
    }

    public function test_exercise_has_belongsto_relationship_with_lesson()
    {
        $this->assertBelongsTo(Lesson::class, 'lesson_id', 'id', $this->exercise, 'lesson');
    }

    public function test_exercise_has_belongstomany_relationship_with_users()
    {
        $this->assertBelongsToMany(User::class, 'exercise_id', 'user_id', $this->exercise, 'users');
    }
}
