<?php

namespace App\Entities\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function displayName()
    {
        $title = $this->getTitle();

        return $title . ' ' . $this->first_name . ' ' . $this->last_name;
    }

    private function getTitle()
    {
        $title = 'Mr.';

        if ($this->gender === 0) {
            $title = 'Mrs.';
        }

        return $title;
    }
}
