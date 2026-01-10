<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'assigned_to', 'project_id', 'status'];
    
    /**
     * Get the user assigned to this category
     */
    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
    
    /**
     * Get the project this category belongs to
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
