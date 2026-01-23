<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthorController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validate incoming data in authors array
        $validated = $request->validate([
            'authors' => 'required|array|min:1',
            'authors.*.name'     => 'required|string|max:255',
            'authors.*.username' => 'required|string|max:255|unique:users,name',
        ]);

        $createdAuthors = [];

        // 2. Loop through each author in the array
        foreach ($validated['authors'] as $data) {
            // Create user
            $user = User::create([
                'name'     => $data['username'],
                'email'    => $data['username'] . '@example.com',
                'password' => Hash::make('password123'),
            ]);

            // Create author linked to user
            $author = Author::create([
                'name'    => $data['name'],
                'user_id' => $user->id,
            ]);

            $createdAuthors[] = [
                'author' => $author,
                'user'   => $user->only(['id', 'name', 'email']),
            ];
        }

        // 3. Return success response (201 Created)
        return response()->json([
            'message' => count($createdAuthors) . ' authors and users created successfully',
            'data'    => $createdAuthors,
        ], 201);
    }

    public function index()
    {
        $authors = Author::with('user')->get();
        return response()->json($authors);
    }

    public function show($id)
    {
        $author = Author::with('user')->findOrFail($id);
        return response()->json($author);
    }
}