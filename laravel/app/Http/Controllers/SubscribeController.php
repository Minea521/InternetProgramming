<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audience;
use App\Models\Article;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SubscribeController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'audience_id' => 'required|exists:audiences,id',
            'article_ids' => 'required|array|min:1',
            'article_ids.*' => 'required|exists:articles,id',
        ]);

        $audience = Audience::findOrFail($validated['audience_id']);

        // Attach articles (subscribe)
        $audience->articles()->sync($validated['article_ids']);

        return response()->json([
            'message' => 'Subscribed successfully',
            'audience' => $audience->load('articles'),
        ], 200);
    }
}
