<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AudienceController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\CommentController;

 
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

// Create Author + User
Route::post('/authors', [AuthorController::class, 'store']);

// Create Article + link to Author
Route::post('/articles', [ArticleController::class, 'store']);

// Create Audience + User
Route::post('/audiences', [AudienceController::class, 'store']);

// Subscribe Audience to Articles
Route::post('/subscribe', [SubscribeController::class, 'subscribe']);

// Add Comment to Article/Author/Audience
Route::post('/comments', [CommentController::class, 'store']);

// Get list of Authors with Users
Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/authors/{id}', [AuthorController::class, 'show']);

// Get list of Articles with Authors
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{id}', [ArticleController::class, 'show']);

// Get list of Audiences with Users
Route::get('/audiences', [AudienceController::class, 'index']);
Route::get('/audiences/{id}', [AudienceController::class, 'show']);

// Get subscribed articles for an audience
Route::get('/audiences/{id}/articles', [AudienceController::class, 'subscribedArticles']);

// Get comments for an article
Route::get('/articles/{id}/comments', [ArticleController::class, 'comments']);

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