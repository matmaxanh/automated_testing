<?php


namespace App\Services;


use App\Components\SlugGenerator;
use App\Entities\Models\Post;
use App\Entities\Repositories\PostRepositoryInterface;

class PostService
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * @var SlugGenerator
     */
    private $slugGenerator;

    /**
     * PostService constructor.
     *
     * @param PostRepositoryInterface $postRepository
     * @param SlugGenerator $slugGenerator
     */
    public function __construct(PostRepositoryInterface $postRepository, SlugGenerator $slugGenerator)
    {
        $this->postRepository = $postRepository;
        $this->slugGenerator = $slugGenerator;
    }

    /**
     * Save a post
     *
     * @param array $postData
     *
     * @return bool
     */
    public function save($postData = [])
    {
        $post = new Post($postData);
        $post->slug = $this->slugGenerator->generate($post);
        $post->author = 1;

        return $this->postRepository->save($post);
    }
}