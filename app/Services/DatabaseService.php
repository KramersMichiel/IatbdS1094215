<?php

namespace App\Services;
use App\Models\Product;
use Carbon\Carbon;

class DatabaseService
{
    public static function GetAllValidProducts(array $activeCatagories, $search)
    {
        return Product::where('user_id', '!=', auth()->id())
                        ->when(count($activeCatagories)>0, function($query) use ($activeCatagories){
                            $query->whereHas('catagories', function($subquery) use ($activeCatagories){
                                $subquery->whereIn('catagories.id', $activeCatagories);
                            });
                        })
                        ->when($search != null, function($query){
                            $query->where('name', 'LIKE', '%'.$search.'%')
                                ->orWhere('description', 'LIKE', '%'.$search.'%')
                                ->where('user_id', '!=', auth()->id());
                        })
                        ->whereNotIN('id', function($query){
                            $query->select('product_id')
                                ->from('loans');
                        })
                        ->whereNotIN('user_id', function($query){
                            $query->select('user_id')
                                ->from('bans')
                                ->whereDate('banned_until', '>', Carbon::now());
                        })
                        ->latest()
                        ->get();
    }
}