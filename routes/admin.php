<?php

use App\Livewire\Admin\Auth\ForgotPassword;
use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Auth\ResetPassword;
use App\Livewire\Admin\Dashboard\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/login');
Route::redirect('/admin', '/admin/login');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', Login::class)->name('login');
        Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
        Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', Dashboard::class)->name('dashboard');

        Route::prefix('contact')->name('contact.')->group(function () {
            Route::get('/', \App\Livewire\Admin\Contact\Index::class)->name('index');
            Route::get('create', \App\Livewire\Admin\Contact\Create::class)->name('create');
            Route::get('edit/{contact}', \App\Livewire\Admin\Contact\Edit::class)->name('edit');
            // Route::get('show/{contact}', \App\Livewire\Admin\Contact\Show::class)->name('show');
        });
    });

    Route::post('logout', function () {
        Auth::guard('admin')->logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('admin.login');
    })->name('logout');
});
