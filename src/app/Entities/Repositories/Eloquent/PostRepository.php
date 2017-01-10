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
    public function search($searchQuery = '', $itemPerPage = 50, $currentPage = 1, $count = false)
    {
        $offset = ($currentPage - 1) * $itemPerPage;

        $query = $this->model->where('title', 'like', "%$searchQuery%");

        if ($count) {
            return $query->count();
        }

        return $query
            ->orderBy('id', 'desc')
            ->offset($offset)
            ->limit($itemPerPage)
            ->get();
    }

    /**
     * @inheritdoc
     */
    public function save(Post $post)
    {
        $post->save();

        return $this;
    }
}