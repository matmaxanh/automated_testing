<?php


namespace App\tests\integration\Entities\Repositories\Eloquent;


use App\Entities\Models\Post;
use App\Entities\Repositories\Eloquent\PostRepository;
use App\Entities\Repositories\PostRepositoryInterface;
use App\tests\TestCase;


class PostRepositoryTest extends TestCase
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    protected function setUp()
    {
        parent::setUp();

        $this->postRepository = app()->make(PostRepository::class);
    }

    /** @test */
    public function it_can_save_a_post()
    {
        $post = new Post([
            'title' => 'Test title',
            'slug' => 'test-save',
            'body' => 'Test body',
            'author' => 1
        ]);
        $result = $this->postRepository->save($post);

        $this->assertTrue($result);

        $savedPost = Post::where(['title' => 'Test title'])->first();

        $this->assertEquals('Test title', $savedPost->title);
        $this->assertEquals('test-save', $savedPost->slug);
        $this->assertEquals('Test body', $savedPost->body);
        $this->assertEquals(1, $savedPost->author);
    }

    /**
     * @test
     * @dataProvider searchDataProvider
     *
     * @param $searchQuery
     * @param $itemPerPage
     * @param $currentPage
     * @param $count
     * @param array|int $expected Expected post id
     */
    public function it_can_search_the_post($searchQuery, $itemPerPage, $currentPage, $count, $expected)
    {
        $result = $this->postRepository->search($searchQuery, $itemPerPage, $currentPage, $count);

        if ($count) {
            $this->assertEquals($expected, $result);
            return;
        }

        $this->assertCount(count($expected), $result);
        foreach ($result as $index => $post) {
            /** @var Post $post */
            $this->assertEquals($expected[$index], $post->id);
        }
    }

    public function searchDataProvider()
    {
        $itemPerPage = 2;
        $currentPage1 = 1;
        $currentPage2 = 2;

        return [
            'empty string' => [
                '',
                $itemPerPage,
                $currentPage1,
                false,
                [3, 2]
            ],
            'return first page' => [
                'Post title',
                $itemPerPage,
                $currentPage1,
                false,
                [3, 2]
            ],
            'return second page' => [
                'Post title',
                $itemPerPage,
                $currentPage2,
                false,
                [1]
            ],
            'return total 1' => [
                'Post title',
                $itemPerPage,
                $currentPage2,
                true,
                3
            ],
            'return total 2' => [
                'Post title 1',
                $itemPerPage,
                $currentPage2,
                true,
                1
            ]
        ];
    }
}
