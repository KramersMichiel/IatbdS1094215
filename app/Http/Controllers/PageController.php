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
use App\Services\DatabaseService;
use App\Services\RequestService;
use Carbon\Carbon;

class PageController extends Controller
{
    public function index(Request $request): View
    {
        $catagories = DB::table('catagories')->get();
        $activeCatagories = RequestService::getActiveCatagories($request);
        $products = DatabaseService::GetAllValidProducts($activeCatagories, $request->search);

        $exclusiveCatagories = RequestService::GetActiveExclusiveCatagories($activeCatagories);

        return view('pages.index',[
            'products' => $products,
            'exclusiveCatagories' => $exclusiveCatagories,
            'inclusiveCatagories' => DB::table('catagories')->where('type', '=', 'inclusive')->get(),
            'request' => $request,
            'banned' => Helpers::checkCurrentUserBan(),
        ]);
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
            'banned' => Helpers::checkCurrentUserBan(),
        ]);
    }

    
}
