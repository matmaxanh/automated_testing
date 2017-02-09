<?php


namespace App\tests\integration\Entities\Models;


use App\Entities\Models\User;
use App\tests\TestCase;

class UserTest extends TestCase
{
    /**
     * @var User
     */
    private $user;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->user = User::find(1);
    }

    /** @test */
    public function it_can_return_posts_belong_to_an_user()
    {
        $posts = $this->user->posts;

        $this->assertCount(2, $posts);
        $this->assertEquals(1, $posts[0]->id);
        $this->assertEquals(2, $posts[1]->id);
    }
}