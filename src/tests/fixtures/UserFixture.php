<?php


namespace App\tests\fixtures;


use App\Entities\Models\User;

class UserFixture extends AbstractFixture
{
    public function getModelClass()
    {
        return User::class;
    }

    public function getFixtures()
    {
        return [
            'user-1' => [
                'id' => 1,
                'first_name' => 'First name 1',
                'last_name' => 'Last name 1',
                'gender' => true,
                'email' => 'user1@example.com',
                'password' => 'password-1'
            ],

            'user-2' => [
                'id' => 2,
                'first_name' => 'First name 2',
                'last_name' => 'Last name 2',
                'gender' => false,
                'email' => 'user2@example.com',
                'password' => 'password-2'
            ]
        ];
    }
}