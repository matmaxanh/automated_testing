<?php


namespace App\Entities\Repositories;


use App\Entities\Models\Post;

interface PostRepositoryInterface
{
    /**
     * Search posts
     *
     * @param string $searchQuery
     * @param int $itemPerPage
     * @param int $currentPage
     * @param bool $count
     *
     * @return Post[]
     */
    public function search($searchQuery = '', $itemPerPage = 50, $currentPage = 1, $count = false);

    /**
     * Save a post
     *
     * @param Post $post
     *
     * @return boolean
     */
    public function save(Post $post);
}