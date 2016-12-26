<?php

namespace App\Entities\Repositories;

use App\Entities\Models\Post;

interface PostRepositoryInterface
{
    /**
     * Return all posts
     *
     * @return Post[]
     */
    public function findAll();
}