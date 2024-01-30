<?php

use App\Http\Controllers\PendingMatterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\QuoteController;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', [WelcomeController::class, 'start'])->name('welcome');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('carousels', CarouselController::class);

Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');

Route::get('/google-callback', function () {
    $user = Socialite::driver('google')->user();

    $userExits = User::where('external_id', $user->id)->where('external_auth', 'google')->first();
    if($userExits){
        Auth::login($userExits);
    } else{
        $userNew = User::create([
            'name'=> $user->name,
            'email'=> $user->email,
            'avatar'=> $user->avatar,
            'external_id'=> $user->id,
            'external_auth'=> 'google',
        ]);
        Auth::login($userNew);
    }
    return redirect( route('dashboard'));
});

Route::resource('quotes', QuoteController::class)->middleware('auth');


Route::resource('pendingMatters', PendingMatterController::class)->middleware('auth');

require __DIR__.'/auth.php';
