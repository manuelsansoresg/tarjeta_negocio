<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\LandingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BusinessProfileController;
use App\Http\Controllers\Admin\SocialLinkController;

Route::get('/', [LandingController::class, 'index'])->name('landing');

Auth::routes(['register' => false]);

// Redirige el home al dashboard admin para unificar la experiencia
Route::get('/home', function () { return redirect()->route('admin.dashboard'); })->name('home');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [BusinessProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [BusinessProfileController::class, 'update'])->name('profile.update');

    Route::get('/social', [SocialLinkController::class, 'index'])->name('social.index');
    Route::post('/social', [SocialLinkController::class, 'store'])->name('social.store');
    Route::post('/social/{socialLink}', [SocialLinkController::class, 'update'])->name('social.update');
    Route::delete('/social/{socialLink}', [SocialLinkController::class, 'destroy'])->name('social.destroy');
});
