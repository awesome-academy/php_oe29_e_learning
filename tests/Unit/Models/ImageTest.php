<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\Course;
use App\Models\Image;

class ImageTest extends TestCase
{
    protected $image;

    public function setUp() : void
    {
        parent::setUp();
        $this->image = new Image();
    }

    public function tearDown() : void
    {
        parent::tearDown();
        $this->image = null;
    }

    public function test_contains_valid_fillable_properties()
    {
        $this->assertFillableProperties([
            'url',
            'imageable_id',
            'imageable_type',
        ], $this->image);
    }

    public function test_comment_has_morphto_relationship_with_user()
    {
        $this->assertMorphTo(User::class, $this->image, 'imageable');
    }

    public function test_comment_has_morphto_relationship_with_course()
    {
        $this->assertMorphTo(Course::class, $this->image, 'imageable');
    }
}
