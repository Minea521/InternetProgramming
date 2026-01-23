<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Article;
use App\Models\Author;
use App\Models\Audience;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'commentable_id'   => 'required|integer',
            'commentable_type' => 'required|string|in:App\\Models\\Article,App\\Models\\Author,App\\Models\\Audience',
            'user_id'          => 'required|exists:users,id',
            'name'             => 'required|string|max:500',  // comment content
        ]);

        $comment = Comment::create([
            'name'              => $validated['name'],
            'user_id'           => $validated['user_id'],
            'commentable_id'   => $validated['commentable_id'],
            'commentable_type' => $validated['commentable_type'],
        ]);

        return response()->json([
            'message' => 'Comment created successfully',
            'comment' => $comment->load('user'),
        ], 201);
    }
}
