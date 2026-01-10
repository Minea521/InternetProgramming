<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['name', 'author_id'];

    // 3. Article belongs to an author
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // 4. Article has many audiences
    public function audiences()
    {
        return $this->belongsToMany(Audience::class);
    }

    // 6. Article has many comments (Polymorphic)
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}


