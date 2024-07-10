<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Product;

class AlterObjectsService
{
    public static function attachCatagories(Request $request, Product $product)
    {
        $exCatagory = DB::table('catagories')->where('name', '=', $request->exclusiveCatagory)->first();

        $product->catagories()->attach($exCatagory->id);

        $catagories = DB::table('catagories')->where('type', '=', 'inclusive')->get();
        
        foreach($catagories as $catagory)
        {
            $name = $catagory->name;
            if($request->$name == "on")
            {
                $product->catagories()->attach($catagory->id);
            }
            
        }

    }

    public static function storeImage(array $imageProduct)
    {
        $imageName = time().'.'.Str::random(10).'.'.$imageProduct['image']->extension();

        $imageProduct['image']->move(public_path('images'), $imageName);

        $imageProduct['product']->photo()->create(['url'=>$imageName]);
    }
}