<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserProfileController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/users', [UserController::class, 'index']);
// Route::get('/profile', [UserProfileController::class, 'index']);
Route::get('/profile', [UserProfileController::class, 'index']);

Route::apiResource('categories', CategoryController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index']);
        Route::put('/', [ProfileController::class, 'update']);
    });

    Route::apiResource('skills', SkillController::class);
});



// Route::get('/categories', [UserController::class, 'index']);
