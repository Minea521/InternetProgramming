<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audience extends Model
{
    protected $fillable = ['name', 'article_id', 'user_id'];

    // 2. Audience has one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 4. Audience belongs to many articles
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    // 5. Audience has many comments (Polymorphic)
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
