<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;

// テナント識別をスキップするルート
Route::middleware([])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Welcome', [
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    })->name('welcome');
});

// テナント識別を行うルート
Route::middleware([App\Http\Middleware\InitializeTenancyCustom::class])->group(function () {
    Route::get('/home', function () {
        return Inertia::render('TenantHome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    })->name('tenant-home');

    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/forum', [PostController::class, 'index'])->name('forum.index');
        Route::post('/forum/post', [PostController::class, 'store'])->name('forum.store');
        Route::delete('/forum/post/{id}', [PostController::class, 'destroy'])->name('forum.destroy');

        Route::post('/forum/comment', [CommentController::class, 'store'])->name('comment.store');
        Route::delete('/forum/comment/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');

        Route::resource('users', UserController::class);
        Route::get('/users/{user}/edit-profile', [UserController::class, 'editProfile'])->name('users.editProfile');
        Route::get('/users/{user}/edit-icon', [UserController::class, 'editIcon'])->name('users.editIcon');
        Route::post('/users/{user}/update-icon', [UserController::class, 'updateIcon'])->name('users.updateIcon');
    });
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

require __DIR__.'/auth.php';
