<?php

namespace App\Enums;

enum UserRole: string
{
    case USER = 'user';
    case ADMIN = 'admin';
    case SUPER_ADMIN = 'superadmin';

    public function canAccessAdminPanel(): bool
    {
        return $this === self::ADMIN || $this === self::SUPER_ADMIN;
    }
}
