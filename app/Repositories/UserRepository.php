<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getUserType(User $user): string
    {
        if ($user->hasAnyAccess(['user.admin', 'user.update']))
            return 'truck';
        else
            return 'none';
    }
}
