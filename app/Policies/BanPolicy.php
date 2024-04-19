<?php

namespace App\Policies;

use App\Models\User;

class BanPolicy
{
    /**
     * The only users that can ban people are admins
     * For this it is important to input the banning user and not the to be banned user
     */

    public function create(User $user): bool
    {
        return $this->update($user);
    }

    public function update(User $user): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user): bool
    {
        return $this->update($user);
    }
}
