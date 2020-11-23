<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\Role;

class RoleTest extends TestCase
{
    protected $role;

    public function setUp() : void
    {
        parent::setUp();
        $this->role = new Role();
    }

    public function tearDown() : void
    {
        parent::tearDown();
        $this->role = null;
    }

    public function test_contains_valid_fillable_properties()
    {
        $this->assertFillableProperties([
            'name',
        ], $this->role);
    }

    public function test_user_has_hasmany_relationship_with_comments()
    {
        $this->assertHasMany(User::class, 'role_id', $this->role, 'users');
    }
}
