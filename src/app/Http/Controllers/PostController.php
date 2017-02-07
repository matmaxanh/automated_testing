<?php


namespace App\Http\Controllers;


use App\Components\Paginator;
use App\Entities\Repositories\PostRepositoryInterface;
use App\Services\PostService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * @var PostService
     */
    private $postService;

    /**
     * HomeController constructor.
     *
     * @param PostRepositoryInterface $postRepository
     * @param PostService $postService
     */
    public function __construct(
        PostRepositoryInterface $postRepository,
        PostService $postService
    ) {
        $this->postRepository = $postRepository;
        $this->postService = $postService;
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

        return view('post.index', [
            'posts' => $posts,
            'paginator' => $paginator
        ]);
    }

    /**
     * @return View
     */
    public function create()
    {
       return view('post.create');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

       if ($this->postService->save($request->all())) {
           $request->session()->flash('success', 'Post saved');
           return redirect()->route('post_list');
       }

        $request->session()->flash('error', 'Could not save the post');
        return redirect()->route('post_create')->withInput();
    }
}
