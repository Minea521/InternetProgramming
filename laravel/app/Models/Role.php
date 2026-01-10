<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    /**
     * A role belongs to many users
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * A role has many permissions
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);  // uses permission_role pivot
    }
}
