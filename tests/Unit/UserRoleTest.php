<?php

namespace Tests\Unit;

use App\Enums\UserRole;
use PHPUnit\Framework\TestCase;

class UserRoleTest extends TestCase
{
    public function test_user_role_cannot_access_admin_panel()
    {
        $this->assertFalse(UserRole::USER->canAccessAdminPanel());
    }

    public function test_admin_role_can_access_admin_panel()
    {
        $this->assertTrue(UserRole::ADMIN->canAccessAdminPanel());
    }

    public function test_super_admin_role_can_access_admin_panel()
    {
        $this->assertTrue(UserRole::SUPER_ADMIN->canAccessAdminPanel());
    }
}
