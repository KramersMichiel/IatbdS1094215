<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use App\Services\Helpers;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product): View
    {
        //dd(Helpers::checkCurrentUserBan());

        return view('pages.reviewPage', [
            'product' => $product,
            'banned' => Helpers::checkCurrentUserBan(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product): RedirectResponse
    {
        $this->authorize('delete', $product);

        if(!Helpers::checkCurrentUserBan()){
            $this->authorize('create', [Review::class, $product]);

            $validated = $request->validate([
                'review' => 'max:255',
            ]);

            if($validated['review'] != null){
                $request->user()->reviews()->create([
                    'review' => $validated['review'],
                    'reviewed_user_id' => $product->loan->user->id,
                ]);
            }
        }
        
        $product->loan->delete();

        return redirect(route('page.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
