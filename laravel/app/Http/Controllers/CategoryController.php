<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // public function getCategories() {
    //     $categories = Category::all();  // ← REAL: Get all from DB
    //     return response()->json($categories);  // ← Return actual data
    //     // return ["message" => "Setting list of categories"];
    // }

    // // --- Post /api/categories
    // public function createCategory() {
    //     $category = Category::create([
    //         'name' => $request->name  // ← REAL: Create from request data
    //     ]);
    //     return response()->json($category, 201);  // ← Return created category
    //     // return ["message" => "Creating 1 new category"];
    // }

    // // --- Get /api/categories/{categoryId}
    // public function getCategory($categoryId) {
    //     $category = Category::find($categoryId);  // ← REAL: Find by ID
        
    //     if (!$category) {
    //         return response()->json(['message' => 'Category not found'], 404);
    //     }
        
    //     return response()->json($category);  // ← Return actual category
    //     // return ["message" => "Setting 1 category base on given categoryId"];
    // }

    // // --- Patch /api/categories/{categoryId}
    // public function updateCategory($categoryId) {
    //     $category = Category::find($categoryId);  // ← REAL: Find by ID
        
    //     if (!$category) {
    //         return response()->json(['message' => 'Category not found'], 404);
    //     }
        
    //     $category->update($request->only(['name']));  // ← REAL: Update from request
    //     return response()->json($category);  // ← Return updated category
    //     // return ["message" => "Updating 1 category base on given categoryId"];
    // }

    // // --- Delete /api/categories/{categoryId}
    // public function deleteCategory($categoryId) {
    //     $category = Category::find($categoryId);  // ← REAL: Find by ID
        
    //     if (!$category) {
    //         return response()->json(['message' => 'Category not found'], 404);
    //     }
        
    //     $category->delete();  // ← REAL: Delete from DB
    //     return response()->json(['message' => 'Category deleted successfully']);
    //     // return ["message" => "Deleting 1 category base on given categoryId"];
    // }

    public function getCategories() {
        // Use policy's viewAny method to check if user can view any categories
        $this->authorize('viewAny', Category::class);
        
        // Apply scoping based on user role
        if (auth()->user()->hasRole('admin')) {
            // Admin sees all
            $categories = Category::all();
        } elseif (auth()->user()->hasRole('manager')) {
            // Manager sees categories in their projects
            $categories = Category::whereHas('project', function($query) {
                $query->where('manager_id', auth()->id());
            })->get();
        } elseif (auth()->user()->hasRole('staff')) {
            // Staff sees only categories assigned to them
            $categories = Category::where('assigned_to', auth()->id())->get();
        } else {
            $categories = collect(); // Empty collection
        }
        
        return response()->json($categories);
    }

    public function createCategory(Request $request) {
        // Use policy's create method
        $this->authorize('create', Category::class);
        
        $category = Category::create([
            'name' => $request->name,
            'assigned_to' => $request->assigned_to ?? null, // If assigning at creation
        ]);
        return response()->json($category, 201);
    }

    public function getCategory($categoryId) {
        $category = Category::findOrFail($categoryId);
        
        // Use policy's view method for object-level authorization
        $this->authorize('view', $category);
        
        return response()->json($category);
    }

    public function updateCategory(Request $request, $categoryId) {
        $category = Category::findOrFail($categoryId);
        
        // Use policy's update method for object-level authorization
        $this->authorize('update', $category);
        
        $category->update($request->only(['name', 'assigned_to']));
        return response()->json($category);
    }

    public function deleteCategory($categoryId) {
        $category = Category::findOrFail($categoryId);
        
        // Use policy's delete method for object-level authorization
        $this->authorize('delete', $category);
        
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }
    
    /**
     * Custom method for updating status (if you have a status field)
     */
    public function updateStatus(Request $request, $categoryId) {
        $category = Category::findOrFail($categoryId);
        
        // Use the custom policy method
        $this->authorize('updateStatus', $category);
        
        // Validate the request
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed'
        ]);
        
        $category->update(['status' => $request->status]);
        return response()->json(['message' => 'Status updated successfully', 'category' => $category]);
    }

    // public function createCategory(Request $request) {
    //     // Only users with 'category.create' permission
    //     abort_unless(auth()->user()->can('categories.create'), 403);
        
    //     $category = Category::create([
    //         'name' => $request->name
    //     ]);
    //     return response()->json($category, 201);
    // }

    // public function updateCategory(Request $request, $categoryId) {
    //     // Only users with 'category.update' permission
    //     abort_unless(auth()->user()->can('categories.update'), 403);
        
    //     $category = Category::find($categoryId);
        
    //     if (!$category) {
    //         return response()->json(['message' => 'Category not found'], 404);
    //     }
        
    //     $category->update($request->only(['name']));
    //     return response()->json($category);
    // }

    // public function deleteCategory($categoryId) {
    //     // Only users with 'category.delete' permission
    //     abort_unless(auth()->user()->can('categories.delete'), 403);
        
    //     $category = Category::find($categoryId);
        
    //     if (!$category) {
    //         return response()->json(['message' => 'Category not found'], 404);
    //     }
        
    //     $category->delete();
    //     return response()->json(['message' => 'Category deleted successfully']);
    // }

}
