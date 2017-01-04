<?php


namespace App\Http\Controllers;


use App\Components\Paginator;
use App\Entities\Repositories\PostRepositoryInterface;
use Illuminate\Http\Request;

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
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
   {
       $itemPerPage = config('app.pagination.item_per_page');
       $page = $request->input('page') ? : 1;
       $searchQuery = $request->input('search-query');

       $total = $this->postRepository->search($searchQuery, $itemPerPage, $page, true);
       $posts = $this->postRepository->search($searchQuery, $itemPerPage, $page);

       $paginator = new Paginator($itemPerPage, $total, $page);

       return view('home.index', [
           'posts' => $posts,
           'paginator' => $paginator
       ]);
   }
}
