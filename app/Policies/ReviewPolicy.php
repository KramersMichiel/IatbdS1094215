<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use App\Models\Review;
use App\Services\Helpers;

class ReviewPolicy
{
    /**
     * A user is only allowed to create a review of the loaner if they didnt loan the product, own the product and are not currently banned
     * They are only allowed to update or delete the review if they own it
     * Therefore input the user actioning the request and either the requested product that was loaned out or the review the user wants to change
     */
    public function create(User $user, Product $product): bool
    {
        if($product->user()->isNot($user) || $product->loan->user()->is($user) || Helpers::checkUserBan($user))
        {
            return false;
        }
        else{
            return true;
        }
    }

    //A user can only update a loan if they own the product it governs
    public function update(User $user, Review $review): bool
    {
        return $review->user()->is($user);
    }

    //A user can only delete a loan if they own the product it governs
    public function delete(User $user, Review $review): bool
    {
        return $this->update($user, $review);
    }
}
