<?php

use App\Http\Controllers\Admin\Main\AdminIndexController;
use App\Http\Controllers\Admin\User\CreateController;
use App\Http\Controllers\Admin\User\DestroyController;
use App\Http\Controllers\Admin\User\IndexController;
use App\Http\Controllers\Admin\User\ShowController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
 | Public welcome
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'categories' => Category::all()

    ]);
});

/*
 | Dashboard
*/
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
 | Authenticated routes
*/
// Route::middleware('auth')->group(function () {
Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/users', function () {
        return Inertia::render('Admin/Users', [
            'users' => User::all()
        ]);
    });
    Route::get('/admin/categories', function () {
        return Inertia::render('Admin/Categories', [
            'categories' => Category::all()
        ]);
    });
    Route::get('/profile', function () {
        return Inertia::render('Profile', [
            'user' => Auth::user()
        ]);
    })->name('profile');




    // Route::middleware('auth')->get('/api/profile', function () {
    //     return response()->json([
    //         'profile' => auth()->user(),
    //     ]);
    // });
});

require __DIR__ . '/auth.php';
