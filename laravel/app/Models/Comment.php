<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['name', 'commentable_id', 'commentable_type', 'user_id'];

    // Polymorphic relationship to commentable models (Author, Audience, Article)
    public function commentable()
    {
        return $this->morphTo();
    }

    // Comment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
