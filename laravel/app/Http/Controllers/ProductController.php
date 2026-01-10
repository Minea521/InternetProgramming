<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request) {
        // Only users with 'products.create' permission
        abort_unless(auth()->user()->can('products.create'), 403);
        
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    public function update(Request $request, $id) {
        // Only users with 'products.update' permission
        abort_unless(auth()->user()->can('products.update'), 403);
        
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return response()->json($product);
    }

    public function destroy($id) {
        // Only users with 'products.delete' permission
        abort_unless(auth()->user()->can('products.delete'), 403);
        
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
