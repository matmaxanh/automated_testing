<?php

namespace App\Http\Controllers;

use App\Entities\Repositories\PostRepositoryInterface;

class HomeController extends Controller
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * HomeController constructor.
     *
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * List all posts
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
   {
       $posts = $this->postRepository->findAll();

       return view('home.index', ['posts' => $posts]);
   }
}
