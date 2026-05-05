<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

use App\Livewire\User\Dashboard;
use App\Livewire\Admin\ProblemManager;
use App\Livewire\Admin\ContestManager;
use App\Livewire\User\ProblemList;
use App\Livewire\User\ProblemShow;
use App\Livewire\User\ContestList;
use App\Livewire\User\ContestShow;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/problems', ProblemList::class)->name('problems.index');
    Route::get('/problems/{problem}', ProblemShow::class)->name('problems.show');
    Route::get('/contests', ContestList::class)->name('contests.index');
    Route::get('/contests/{contest}', ContestShow::class)->name('contests.show');
    Route::view('/tutorial/python', 'tutorial')->name('tutorial.python');


    // Admin routes
    Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', \App\Livewire\Admin\UserManager::class)->name('users');
        Route::get('/problems', ProblemManager::class)->name('problems');
        Route::get('/contests', ContestManager::class)->name('contests');
        Route::get('/contests/{contest}/summary', \App\Livewire\Admin\ContestSummary::class)->name('contests.summary');
    });
});

require __DIR__.'/auth.php';

// Helper routes for cPanel deployment
Route::get('/clear', function() {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    return 'Application Cache Cleared Successfully!';
});

Route::get('/optimize', function() {
    \Illuminate\Support\Facades\Artisan::call('optimize');
    \Illuminate\Support\Facades\Artisan::call('view:cache');
    return 'Application Optimized Successfully!';
});
