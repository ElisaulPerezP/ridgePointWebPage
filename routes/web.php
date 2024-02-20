<?php

use App\Http\Controllers\PendingMatterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
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


Route::get('/dashboard', [WelcomeController::class, 'start'])->middleware(['auth', 'verified'])->name('dashboard');

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

Route::post('quotes', [QuoteController::class, 'store'])
    ->middleware('throttle:2,1')
    ->name('quotes.store');

Route::get('quotes/create', [QuoteController::class, 'create'])
    ->name('quotes.create');

Route::get('quotes', [QuoteController::class, 'index'])
    ->middleware('auth')
    ->name('quotes.index');

Route::get('quotes/{quote}', [QuoteController::class, 'show'])
    ->middleware('auth')
    ->name('quotes.show');

Route::get('quotes/{quote}/edit', [QuoteController::class, 'edit'])
    ->middleware('auth')
    ->name('quotes.edit');

Route::put('quotes/{quote}', [QuoteController::class, 'update'])
    ->middleware('auth')
    ->name('quotes.update');

Route::delete('quotes/{quote}', [QuoteController::class, 'destroy'])
    ->middleware('auth')
    ->name('quotes.destroy');



Route::resource('pendingMatters', PendingMatterController::class)->middleware(['auth', 'verified', 'role:admin']);


Route::resource('users', UserController::class)->middleware(['auth', 'role:admin']);
Route::resource('roles', RolesController::class)->middleware(['auth', 'role:admin']);



require __DIR__.'/auth.php';
