<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\Response;
use App\Services\Helpers;

class ProductPolicy
{
    //A user can create a product listing if they are not banned
    public function create(User $user): bool
    {
        return !Helpers::checkUserBan($user);
    }

    //A user can update a product listing if they own it
    public function update(User $user, Product $product): bool
    {
        return $product->user()->is($user);
    }

    //A user can delete a product listing if they own it
    public function delete(User $user, Product $product): bool
    {
        return $this->update($user, $product);
    }
}
