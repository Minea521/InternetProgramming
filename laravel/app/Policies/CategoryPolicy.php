<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Admin can view all categories
        if ($user->hasRole('admin')) {
            return true;
        }
        
        // Manager and Staff can view categories
        return $user->hasRole('manager') || $user->hasRole('staff');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Category $category): bool
    {
        // Admin can view everything
        if ($user->hasRole('admin')) {
            return true;
        }
        
        // Manager can view categories in their projects
        // Assuming Category has a 'project' relationship and project has 'managed_by' or 'manager_id'
        if ($user->hasRole('manager')) {
            return $category->project && $category->project->manager_id === $user->id;
        }
        
        // Staff can only view categories assigned to them
        if ($user->hasRole('staff')) {
            return $category->assigned_to === $user->id;
        }
        
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Only Admin and Manager can create categories
        return $user->hasRole('admin') || $user->hasRole('manager');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Category $category): bool
    {
        // Admin can update everything
        if ($user->hasRole('admin')) {
            return true;
        }
        
        // Manager can update categories in their projects
        if ($user->hasRole('manager')) {
            return $category->project && $category->project->manager_id === $user->id;
        }
        
        // Staff can update categories assigned to them
        if ($user->hasRole('staff')) {
            return $category->assigned_to === $user->id;
        }
        
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Category $category): bool
    {
        // Only Admin can delete categories
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Category $category): bool
    {
       return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Category $category): bool
    {
        return $user->hasRole('admin');
    }

    public function updateStatus(User $user, Category $category): bool
    {
        // Only Staff assigned to this category can update its status
        return $user->hasRole('staff') && $category->assigned_to === $user->id;
    }
}
