<?php

namespace App\Enum;

use App\Models\User as UserModel;

enum User: int
{
    case ADMIN_USER = 1;

    public static function getAdminUser(): ?UserModel
    {
        return UserModel::find(self::ADMIN_USER->value);
    }
}
