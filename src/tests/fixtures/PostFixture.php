<?php


namespace App\tests\fixtures;


use App\Entities\Models\Post;

class PostFixture extends AbstractFixture
{
    public function getModelClass()
    {
        return Post::class;
    }

    public function getFixtures()
    {
        return [
            'post-1' => [
                'id' => 1,
                'title' => 'Post title 1',
                'slug' => 'post-1',
                'body' => 'Post body 1',
                'author' => 1
            ],

            'post-2' => [
                'id' => 2,
                'title' => 'Post title 2',
                'slug' => 'post-2',
                'body' => 'Post body 2',
                'author' => 1
            ],

            'post-3' => [
                'id' => 3,
                'title' => 'Post title 3',
                'slug' => 'post-3',
                'body' => 'Post body 3',
                'author' => 2
            ]
        ];
    }
}