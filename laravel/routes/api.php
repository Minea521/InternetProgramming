<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Api\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(CategoryController::class)->prefix('categories')->group(function () {
    Route::get('/', 'getCategories');
    Route::post('/', 'createCategory');
    Route::get('/{categoryid}', 'getCategory');
    Route::put('/{categoryid}', 'updateCategory');
    Route::delete('/{categoryid}', 'deleteCategory');
});

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (!Auth::attempt($credentials)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $user = $request->user();

    // Create personal access token
    $token = $user->createToken('mobile')->accessToken;

    return response()->json(['token' => $token]);
});

Route::middleware('auth:api')->group(function () {
    // GET /api/me - returns current user + roles
    Route::get('/me', function (Request $request) {
        return $request->user()->load('roles');
    });

    // Example: POST /api/products - manager only
    Route::post('/products', function () {
        return response()->json(['message' => 'Product created']);
    })->middleware('can:products.create');

    // Example: PATCH /api/categories/{id}/status - staff only
    Route::patch('/categories/{id}/status', function ($id) {
        return response()->json(['message' => 'Category status updated']);
    })->middleware('can:categories.update');
});

Route::post('/products', [ProductController::class, 'store'])->middleware('auth:api');