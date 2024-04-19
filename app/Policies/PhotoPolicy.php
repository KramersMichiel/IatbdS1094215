<?php

namespace App\Policies;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Services\Helpers;

class PhotoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Photo $photo): bool
    {
        //
    }

    //A user can create a photo if they are not banned
    public function create(User $user): bool
    {
        return !Helpers::checkUserBan($user);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Photo $photo): bool
    {
        return $photo->product->user()->is($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Photo $photo): bool
    {
        return $this->update($user, $photo);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Photo $photo): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Photo $photo): bool
    {
        //
    }
}
