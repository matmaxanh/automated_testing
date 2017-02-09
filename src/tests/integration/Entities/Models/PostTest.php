<?php


namespace App\tests\integration\Entities\Models;


use App\Entities\Models\Post;
use App\tests\TestCase;

class PostTest extends TestCase
{
    /**
     * @var Post
     */
    private $post;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->post = Post::find(1);
    }

    /**
     * @test
     */
    public function it_can_find_author_user()
    {
        $user = $this->post->authorUser;

        $this->assertEquals(1, $user->id);
        $this->assertEquals('First name 1', $user->first_name);
        $this->assertEquals('Last name 1', $user->last_name);
        $this->assertEquals(true, $user->gender);
    }
}