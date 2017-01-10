<?php


namespace App\Http\Controllers;


use App\Components\Paginator;
use App\Components\SlugGenerator;
use App\Entities\Models\Post;
use App\Entities\Repositories\PostRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
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
     * HomeController constructor.
     *
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository, SlugGenerator $slugGenerator)
    {
        $this->postRepository = $postRepository;
        $this->slugGenerator = $slugGenerator;
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
       $post = new Post($request->all());
       $post->slug = $this->slugGenerator->generate($post);
       $post->author = 1;

       if (!$this->postRepository->save($post)) {
            $request->session()->flash('error', 'Could not save the post');
            return redirect()->route('post_create')->withInput();
       }

        $request->session()->flash('success', 'Post saved');
       return redirect()->route('post_list');
    }
}
