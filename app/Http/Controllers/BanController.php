<?php

namespace App\Http\Controllers;

use App\Models\Ban;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user): View
    {
        return view('pages.banPage', [
            'user' => $user,
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
    public function store(Request $request, User $user): RedirectResponse
    {
        $this->authorize('create', Ban::class);

        $validatedInfo = $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $user->ban()->create([
            'reason_for_ban' => $validatedInfo['reason'],
            'banned_until' => Carbon::now()->addWeeks($request->duration)->toDateTime(),
        ]);

        return redirect(route('page.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Ban $ban)
    {
        return view('pages.bannedPage', [
            'ban' => $ban,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ban $ban)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ban $ban)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ban $ban)
    {
        //
    }
}
