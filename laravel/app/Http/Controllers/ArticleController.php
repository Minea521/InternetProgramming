<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Author;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ArticleController extends Controller
{
    public function store(Request $request)
    {
        // Validate input (array of articles)
        $validated = $request->validate([
            'articles' => 'required|array|min:1',
            'articles.*.name' => 'required|string|max:255',
            'articles.*.author_id' => 'required|int|exists:authors,id',
        ]);

        $createdArticles = [];

        foreach ($validated['articles'] as $item) {
            // Find author by name
            $author = Author::where('id', $item['author_id'])->first();

            if (!$author) {
                return response()->json([
                    'message' => 'Author not found: ' . $item['author_id']
                ], 404);
            }

            // Create article
            $article = Article::create([
                'name' => $item['name'],          
                'author_id' => $author->id,
            ]);

            $createdArticles[] = $article;
        }

        return response()->json([
            'message' => count($createdArticles) . ' articles created successfully',
            'articles' => $createdArticles,
        ], 201);
    }

    public function index()
    {
        $articles = Article::with('author')->get();
        return response()->json($articles);
    }

    public function show($id)
    {
        $article = Article::with('author')->findOrFail($id);
        return response()->json($article);
    }

    public function comments($id)
    {
        $article = Article::findOrFail($id);
        $comments = $article->comments()->with('user')->get();

        return response()->json([
            'article' => $article->only(['id', 'name']),
            'comments' => $comments
        ]);
    }

}
