<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestService
{
    public static function GetActiveExclusiveCatagories(array $activeCatagories)
    {
        $exclusiveCatagories = DB::table('catagories')->where('type', '=', 'exclusive')->get()->toArray();
        $exclusiveCatagoryExport = [];
        foreach($exclusiveCatagories as $catagor)
        {
            if(in_array($catagor->id, $activeCatagories))
            {
                array_unshift($exclusiveCatagoryExport, $catagor->name);
            }
            else
            {
                array_push($exclusiveCatagoryExport, $catagor->name);
            }
        }
        return $exclusiveCatagoryExport;
    }

    public static function getActiveCatagories(Request $request)
    {
        $activeCatagories = [];
        $catagories = DB::table('catagories')->where('type', '=', 'inclusive')->get();
        
        if(isset($request->exclusiveCatagory))
        {
            array_push($activeCatagories, DB::table('catagories')->where('name', '=', $request->exclusiveCatagory)->first()->id);
        }
        
        foreach($catagories as $catagory)
        {
            $name = $catagory->name;
            if($request->$name == "on")
            {
                array_push($activeCatagories, $catagory->id);
            }
        }
        return $activeCatagories;
    }
}