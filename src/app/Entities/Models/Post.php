<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'body',
        'author'
    ];

    public function authorUser()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}