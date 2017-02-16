<?php

namespace App\Entities\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @package App\Entities\Models
 *
 * @property string $first_name
 * @property string $last_name
 * @property boolean $gender
 * @property string $email
 * @property string $password
 *
 * @property Post[] $posts
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'gender',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Setup relationship with User model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'author', 'id');
    }

    /**
     * Return user title, first name and last name combined
     *
     * @return string
     */
    public function displayName()
    {
        $title = $this->getTitle();

        return $title . ' ' . $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Return user title
     *
     * @return string
     */
    private function getTitle()
    {
        return $this->gender ? 'Mr.' : 'Mrs.';
    }
}
