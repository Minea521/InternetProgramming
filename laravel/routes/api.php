<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;

// Public routes (no auth)
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (!Auth::attempt($credentials)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $user = $request->user();
    $token = $user->createToken('mobile')->accessToken;

    return response()->json(['token' => $token]);
});

// Protected routes (require API token)
Route::middleware('auth:api')->group(function () {
    // Get current user + roles
    Route::get('/me', function (Request $request) {
        return $request->user()->load('roles');
    });

    // Categories resource (full CRUD)
    Route::controller(CategoryController::class)->prefix('categories')->group(function () {
        Route::get('/', 'getCategories');
        Route::post('/', 'createCategory')->middleware('can:categories.create');
        Route::get('/{categoryId}', 'getCategory');
        Route::put('/{categoryId}', 'updateCategory')->middleware('can:categories.update');
        Route::delete('/{categoryId}', 'deleteCategory')->middleware('can:categories.delete');
    });

    // Products - using controller + permission check
    Route::post('/products', [ProductController::class, 'store'])->middleware('can:products.create');
});