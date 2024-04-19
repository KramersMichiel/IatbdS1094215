<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product): View
    {
        return view('pages.loanPage', [
            'product' => $product,
            'endDate' => Carbon::now()->addDays(14)->toDateTime(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Product $product): RedirectResponse
    {
        $this->authorize('create', [Loan::class, $product]);

        $product->loan()->create([
            'user_id' => Auth::user()->id,
            'return_by' => Carbon::now()->addDays(14)->toDateTime(),
        ]);

        return redirect(route('page.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        //
    }
}
