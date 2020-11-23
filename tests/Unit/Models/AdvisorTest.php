<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Advisor;

class AdvisorTest extends TestCase
{
    protected $advisor;

    public function setUp() : void
    {
        parent::setUp();
        $this->advisor = new Advisor();
    }

    public function tearDown() : void
    {
        parent::tearDown();
        $this->advisor = null;
    }

    public function test_contains_valid_fillable_properties()
    {
        $this->assertFillableProperties([
            'student_id',
            'lesson_id',
            'status',
            'mentor_id',
        ], $this->advisor);
    }

    public function test_advisor_has_belongsto_relationship_with_lesson()
    {
        $this->assertBelongsTo(Lesson::class, 'lesson_id', 'id', $this->advisor, 'lesson');
    }

    public function test_advisor_has_belongsto_relationship_with_mentor()
    {
        $this->assertBelongsTo(User::class, 'mentor_id', 'id', $this->advisor, 'mentor');
    }

    public function test_advisor_has_belongsto_relationship_with_student()
    {
        $this->assertBelongsTo(User::class, 'student_id', 'id', $this->advisor, 'student');
    }
}
