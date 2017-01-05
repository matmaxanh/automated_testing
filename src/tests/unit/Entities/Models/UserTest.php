<?php


namespace App\tests\unit\Entities\Models;


use App\Entities\Models\User;
use App\tests\TestCase;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_return_display_name()
    {
        $user = new User();
        $user->first_name = 'First Name';
        $user->last_name = 'Last Name';
        $user->gender = 1;

        $this->assertEquals('Mr. First Name Last Name', $user->displayName());

        $user->gender = 0;
        $this->assertEquals('Mrs. First Name Last Name', $user->displayName());
    }
}
