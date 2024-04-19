<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\PhotoController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\User;
use App\Models\Review;
use App\Models\Loan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\Helpers;
use Carbon\Carbon;

class PageController extends Controller
{
    public function index(Request $request): View
    {
        $catagories = DB::table('catagories')->get();
        $activeCatagories = $this->getActiveCatagories($request);
        $products = Product::where('user_id', '!=', auth()->id())
                        ->when(count($activeCatagories)>0, function($query) use ($activeCatagories){
                            $query->whereHas('catagories', function($subquery) use ($activeCatagories){
                                $subquery->whereIn('catagories.id', $activeCatagories);
                            });
                        })
                        ->when($request->search != null, function($query) use($request){
                            $query->where('name', 'LIKE', '%'.$request->search.'%')
                                  ->orWhere('description', 'LIKE', '%'.$request->search.'%')
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


        
        $exclusiveCatagories = DB::table('catagories')->where('type', '=', 'exclusive')->get()->toArray();
        $exclusiveCatagoryExport = [];
        foreach($exclusiveCatagories as $catagor)
        {
            $id = $catagor->id;
            if(in_array($id, $activeCatagories))
            {
                array_unshift($exclusiveCatagoryExport, $catagor->name);
            }
            else
            {
                array_push($exclusiveCatagoryExport, $catagor->name);
            }
        }

        return view('pages.index',[
            'products' => $products,
            'exclusiveCatagories' => $exclusiveCatagoryExport,
            'inclusiveCatagories' => DB::table('catagories')->where('type', '=', 'inclusive')->get(),
            'request' => $request,
            'banned' => Helpers::checkCurrentUserBan(),
        ]);
    }

    private function getActiveCatagories(Request $request)
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

    public function profile(User $user): View
    {
        $userProducts = Helpers::getUserProducts($user);
        $loanedProducts = Helpers::getLoanedProducts($user);
        $userReviews = Helpers::getUserReviews($user);

        return view('pages.userProfile', [
            'user' => $user,
            'products' => $userProducts,
            'loanProducts' => $loanedProducts,
            'reviews' => $userReviews,
        ]);
    }

    
}
