<?php

namespace App\Entities\Repositories\Eloquent;

use App\Entities\Models\Post;
use App\Entities\Repositories\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    /**
     * @var Post
     */
    private $model;

    /**
     * PostRepository constructor.
     *
     * @param Post $model
     */
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritdoc
     */
    public function findAll()
    {
        return $this->model->all();
    }
}