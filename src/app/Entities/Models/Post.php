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
 *
 * @property User $authorUser
 */
class Post extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'slug',
        'body',
        'author'
    ];

    /**
     * Setup relationship with User model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function authorUser()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}