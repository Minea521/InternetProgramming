<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audience;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AudienceController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'audiences' => 'required|array|min:1',
            'audiences.*.name'     => 'required|string|max:255',
            'audiences.*.username' => 'required|string|max:255|unique:users,name',
        ]);

        $created = [];

        foreach ($validated['audiences'] as $data) {
            $user = User::create([
                'name'     => $data['username'],
                'email'    => $data['username'] . '@example.com',
                'password' => Hash::make('password123'),
            ]);

            $audience = Audience::create([
                'name'    => $data['name'],
                'user_id' => $user->id,
            ]);

            $created[] = [
                'audience' => $audience,
                'user'     => $user->only(['id', 'name', 'email']),
            ];
        }

        return response()->json([
            'message' => count($created) . ' audiences and users created successfully',
            'data'    => $created,
        ], 201);
    }

    public function index()
    {
        $audiences = Audience::with('user')->get();
        return response()->json($audiences);
    }

    public function show($id)
    {
        $audience = Audience::with('user')->findOrFail($id);
        return response()->json($audience);
    }

    public function subscribedArticles($id)
    {
        $audience = Audience::findOrFail($id);
        $articles = $audience->articles;

        return response()->json([
            'audience' => $audience->only(['id', 'name']),
            'subscribed_articles' => $articles
        ]);
    }

}
