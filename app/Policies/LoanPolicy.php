<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use App\Models\Loan;
use App\Services\Helpers;

class LoanPolicy
{
    /**
     * For this authentication input the user actioning the request and the product it relates to
     */

    //A user cant create a loan if they own the product to be loaned or are banned
    public function create(User $user, Product $product): bool
    {
        if($product->user()->is($user) || Helpers::checkUserBan($user))
        {
            return false;
        }
        else{
            return true;
        }
    }

    //A user can only update a loan if they own the product it governs
    public function update(User $user, Product $product): bool
    {
        return $product->user()->is($user);
    }

    //A user can only delete a loan if they own the product it governs
    public function delete(User $user, Product $product): bool
    {
        return $this->update($user, $product);
    }
}
