<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BanController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [PageController::class, 'index']);

Route::Get('page.profile/{user}', [PageController::class, 'profile'])->name('page.profile');

Route::Get('ban.index/{user}', [BanController::class, 'index'])->name('ban.index');
Route::Post('ban.store/{user}', [BanController::class, 'store'])->name('ban.store');


Route::resource('page', PageController::class)
    ->only('index', 'profile')
    ->middleware(['auth', 'verified']);

Route::resource('product', ProductController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('photo', PhotoController::class)
    ->only(['store', 'edit', 'update'])
    ->middleware(['auth', 'verified']);

Route::resource('product.loan', LoanController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('product.review', ReviewController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('ban', BanController::class)
    ->only(['index/{user}', 'store/{user}', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
