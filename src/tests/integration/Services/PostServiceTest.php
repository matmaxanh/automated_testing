<?php


namespace App\tests\integration\Services;


use App\Entities\Models\Post;
use App\Services\PostService;
use App\tests\TestCase;
use Carbon\Carbon;


class PostServiceTest extends TestCase
{
    /**
     * @var PostService
     */
    private $postService;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->postService = app()->make(PostService::class);
    }

    /** @test */
    public function it_can_save_a_post()
    {
        $postData = [
            'title' => 'Test title',
            'body' => 'Test body'
        ];

        $nowTimeStamp = 1484063204;
        Carbon::setTestNow(Carbon::createFromTimestamp($nowTimeStamp));

        $result = $this->postService->save($postData);

        $this->assertTrue($result);

        $savedPost = Post::where(['title' => 'Test title'])->first();

        $this->assertEquals('Test title', $savedPost->title);
        $this->assertEquals('test-title-' . $nowTimeStamp, $savedPost->slug);
        $this->assertEquals('Test body', $savedPost->body);
        $this->assertEquals(1, $savedPost->author);
    }
}
