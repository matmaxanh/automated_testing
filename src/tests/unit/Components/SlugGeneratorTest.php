<?php


namespace App\tests\unit\Components;


use App\Components\SlugGenerator;
use App\Entities\Models\Post;
use App\tests\TestCase;
use Carbon\Carbon;


class SlugGeneratorTest extends TestCase
{
    /**
     * @var SlugGenerator
     */
    private $slugGenerator;

    protected function setUp()
    {
        parent::setUp();

        $this->slugGenerator = app()->make(SlugGenerator::class);
    }

    /**
     * @test
     * @dataProvider slugGeneratorDataProvider
     *
     * @param Post $post
     * @param Carbon $current
     * @param string $expected
     */
    public function it_can_generate_slug(Post $post, Carbon $current, $expected)
    {
        Carbon::setTestNow($current);

        $slug = $this->slugGenerator->generate($post);

        $this->assertEquals($expected, $slug);
    }

    public function slugGeneratorDataProvider()
    {
        return [
            'normal_string' => [
                new Post(['title' => 'This is a test post']),
                Carbon::createFromTimestamp(1484063204),
                'this-is-a-test-post-1484063204'
            ],

            'string_with_digits' => [
                new Post(['title' => 'This is a 2 test post']),
                Carbon::createFromTimestamp(1484067685),
                'this-is-a-2-test-post-1484067685'
            ],

            'unwanted_characters' => [
                new Post(['title' => 'This is a test post']),
                Carbon::createFromTimestamp(1484063204),
                'this-is-a-test-post-1484063204'
            ],

            'with_spaces' => [
                new Post(['title' => '   This is   a test   post   ']),
                Carbon::createFromTimestamp(1484066666),
                'this-is-a-test-post-1484066666'
            ],

            'duplicate_hyphen' => [
                new Post(['title' => 'This--is a test--post']),
                Carbon::createFromTimestamp(1484063204),
                'this-is-a-test-post-1484063204'
            ]
        ];
    }
}
