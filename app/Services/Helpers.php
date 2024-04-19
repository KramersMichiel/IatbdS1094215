<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Models\Review;
use App\Models\Loan;

class Helpers
{
    public static function checkCurrentUserBan()
    {
        return Helpers::checkUserBan(auth()->user());
    }

    public static function checkUserBan(User $user)
    {
        $banned = false;

        $bans = $user->ban()->getmodels();

        if(count($bans) > 0)
        {
            foreach($bans as $ban)
            {
                if($ban->banned_until >= Carbon::now())
                {
                    $banned = true;
                }
            }
        }  

        return $banned;
    }

    public static function getUserProducts(User $user)
    {
        return Product::where('user_id', '=', $user->id)->latest()->get();
    }

    public static function getLoanedProducts(User $user)
    {
        if($user == auth()->user())
        {
            $loans = Loan::where('user_id', '=', $user->id)->latest()->get();
            $loanedProducts = [];
            foreach($loans as $loan)
            {
                array_push($loanedProducts, $loan->product);
            }
            return $loanedProducts;
        }
        else
        {
            return [];
        }
    }

    public static function getUserReviews(User $user)
    {
        if($user != auth()->user())
        {
            return Review::where('reviewed_user_id', '=', $user->id)
            ->whereNotIN('user_id', function($query){
                $query->select('user_id')
                        ->from('bans')
                        ->whereDate('banned_until', '>', Carbon::now());
            })
            ->latest()
            ->get();
        }
        else
        {
            return [];
        }
    }
}