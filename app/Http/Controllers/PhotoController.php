<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function store(Request $request): RedirectResponse
    {
        $imageName = time().'.'.Str::random(10).'.'.$request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        $request->product->photo()->create(['url'=>$imageName]);

        return redirect(route('page.index'));
    }

    public function edit(Photo $photo): View
    {
        $this->authorize('update', $photo);
 
        return view('pages.editImgPage', [
            'photo' => $photo,
        ]);
    }

    public function update(Request $request, Photo $photo): RedirectResponse
    {
        $this->authorize('update', $photo);
 
        $validated = $request->validate([
            'image' => 'required|file|mimes:png,jpg,jpeg|max:2048',
        ]);
 
        // $imageName = time().'.'.Str::random(10).'.'.$validated['image']->extension();

        $validated['image']->move(public_path('images'), $photo->url);

        // Storage::disk('local')->delete('public/images/'.$photo->url);

        // $photo->update(['url'=>$imageName]);
 
        return redirect(route('page.index'));
    }

}
