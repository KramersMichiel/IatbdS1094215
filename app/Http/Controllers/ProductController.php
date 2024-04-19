<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\PhotoController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Services\Helpers;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('pages.addPage', [
            'exclusiveCatagories' => DB::table('catagories')->where('type', '=', 'exclusive')->get(),
            'inclusiveCatagories' => DB::table('catagories')->where('type', '=', 'inclusive')->get(),
            'banned' => Helpers::checkCurrentUserBan(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {

        $validatedInfo = $request->validate([
            'name' => 'required|string|max:30',
            'description' => 'required|string|max:255',
        ]);

        $validatedImage = $request->validate([
            'image' => 'required|file|mimes:png,jpg,jpeg|max:2048',
        ]);

        $product = $request->user()->products()->create($validatedInfo);

        $this->storeImage([
            'image'=>$validatedImage['image'],
            'product'=>$product,
        ]);
 
        $this->attachCatagories($request, $product);

        return redirect(route('page.index'));
    }

    public function attachCatagories(Request $request, Product $product)
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

    public function storeImage(array $imageProduct)
    {
        $imageName = time().'.'.Str::random(10).'.'.$imageProduct['image']->extension();

        $imageProduct['image']->move(public_path('images'), $imageName);

        $imageProduct['product']->photo()->create(['url'=>$imageName]);
    }

    public function edit(Product $product): View
    {
        //
        $this->authorize('update', $product);
 
        return view('pages.editPage', [
            'product' => $product,
        ]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        //
        $this->authorize('update', $product);
 
        $validated = $request->validate([
            'name' => 'required|string|max:30',
            'description' => 'required|string|max:255',
        ]);
 
        $product->update($validated);
 
        return redirect(route('page.index'));
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->authorize('delete', $product);
 
        $product->delete();
 
        return redirect(route('page.index'));
    }
}
