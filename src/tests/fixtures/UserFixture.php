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
                'first_name' => 'William',
                'last_name' => 'Bill Gates',
                'gender' => true,
                'email' => 'gate@microsoft.com',
                'password' => 'verycomplexpassword'
            ],

            'user-2' => [
                'id' => 2,
                'first_name' => 'Sheryl',
                'last_name' => 'Sandberg',
                'gender' => false,
                'email' => 'sheryl@facebook.com',
                'password' => 'verysimplepassword'
            ]
        ];
    }
}