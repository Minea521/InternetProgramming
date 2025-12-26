<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories() {
        $categories = Category::all();  // ← REAL: Get all from DB
        return response()->json($categories);  // ← Return actual data
        // return ["message" => "Setting list of categories"];
    }

    // --- Post /api/categories
    public function createCategory() {
        $category = Category::create([
            'name' => $request->name  // ← REAL: Create from request data
        ]);
        return response()->json($category, 201);  // ← Return created category
        // return ["message" => "Creating 1 new category"];
    }

    // --- Get /api/categories/{categoryId}
    public function getCategory($categoryId) {
        $category = Category::find($categoryId);  // ← REAL: Find by ID
        
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        
        return response()->json($category);  // ← Return actual category
        // return ["message" => "Setting 1 category base on given categoryId"];
    }

    // --- Patch /api/categories/{categoryId}
    public function updateCategory($categoryId) {
        $category = Category::find($categoryId);  // ← REAL: Find by ID
        
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        
        $category->update($request->only(['name']));  // ← REAL: Update from request
        return response()->json($category);  // ← Return updated category
        // return ["message" => "Updating 1 category base on given categoryId"];
    }

    // --- Delete /api/categories/{categoryId}
    public function deleteCategory($categoryId) {
        $category = Category::find($categoryId);  // ← REAL: Find by ID
        
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        
        $category->delete();  // ← REAL: Delete from DB
        return response()->json(['message' => 'Category deleted successfully']);
        // return ["message" => "Deleting 1 category base on given categoryId"];
    }
}
