<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pages\ArticleController;
use App\Http\Controllers\Pages\ProgramController;
use App\Http\Controllers\Pages\MemberController;
use App\Http\Controllers\Pages\MagazineController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\MagazineController as AdminMagazineController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;

/*
|--------------------------------------------------------------------------
| Public Routes (Guest / Pembaca)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::view('/tentang', 'pages.tentang')->name('tentang');

Route::get('/program', [ProgramController::class, 'index'])->name('program');

Route::get('/organisasi', [MemberController::class, 'index'])->name('organisasi');

Route::get('/artikel', [ArticleController::class, 'index'])
    ->name('artikel.index');

Route::get('/artikel/{slug}', [ArticleController::class, 'show'])
    ->name('artikel.show');

Route::get('/majalah', [MagazineController::class, 'index'])
    ->name('majalah.index');

Route::get('/majalah/{magazine}', [MagazineController::class, 'show'])
    ->name('majalah.show');

Route::get('/majalah-preview/{magazine}', [MagazineController::class, 'preview'])
    ->name('majalah.preview');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // Auth (guest only)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    });

    // Protected
    Route::middleware('admin')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('articles', AdminArticleController::class)->except(['show']);
        Route::resource('magazines', AdminMagazineController::class)->except(['show']);
        Route::resource('members', AdminMemberController::class)->except(['show']);
        Route::resource('programs', AdminProgramController::class)->except(['show']);
    });
});
