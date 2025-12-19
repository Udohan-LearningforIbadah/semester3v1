<?php

use App\Livewire\LandingPage;
use App\Livewire\UserDashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingPage::class)->name('home');

// User Dashboard route (protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', UserDashboard::class)->name('dashboard');
});

// Laravel's built-in logout route
Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    
    return redirect('/');
})->name('logout');

Route::redirect('/login', '/admin/login')->name('login');