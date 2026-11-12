<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreShortUrlController;
use App\Http\Controllers\RedirectUrlController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\UrlAnalyticsController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/urls/{shortUrl}/analytics', [UrlAnalyticsController::class, 'show'])
    ->name('short-urls.analytics');

    Route::patch('/urls/{shortUrl}/toggle', [ShortUrlController::class, 'toggle'])
        ->name('short-urls.toggle');

    Route::delete('/urls/{shortUrl}', [ShortUrlController::class, 'destroy'])
        ->name('short-urls.destroy');
});

Route::post('/short-urls', StoreShortUrlController::class)
    ->middleware('throttle:10,1')
    ->name('short-urls.store');

Route::get('/s/{short_code}', RedirectUrlController::class)
    ->name('short-urls.redirect');

require __DIR__.'/auth.php';
