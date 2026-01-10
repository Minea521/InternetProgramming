<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        // Gate check inside controller (alternative to middleware)
        $this->authorize('products.create');

        // Your creation logic here...
        return response()->json(['message' => 'Product created successfully']);
    }
}
