<?php

namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 *
 * @package App\Entities\Models
 *
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property int $author
 */
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