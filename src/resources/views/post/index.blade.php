@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <h1>Posts</h1>

            @include('partials._flash')

            <form class="form-inline" method="get">
                <div class="form-group">
                    <label for="search-query">Search post</label>
                    <input name="search-query" value="{{ request('search-query') }}" type="text" class="form-control" id="search-query" placeholder="Post title...">
                </div>

                <div class="form-group pull-right">
                    <a href="{{ route('post_create') }}" class="btn btn-primary">New post</a>
                </div>
            </form>

            <hr/>

            <p>There was total {{ $paginator->total() }} posts on {{ $paginator->totalPages() }} pages</p>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Author</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ $post->authorUser->displayName() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            @if ($paginator->shouldBeDisplayed())
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="{{ $paginator->isFirstPage() ? 'disabled' : '' }}">
                            <a href="{{ route('post_list', ['page' => $paginator->previousPage()]) }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        @for($i = 0; $i < $paginator->totalPages(); $i++)
                            <li class="{{ $paginator->isCurrentPage($i + 1) ? 'active' : '' }}"><a href="{{ route('post_list', ['page' => ($i + 1)]) }}">{{ $i + 1 }}</a></li>
                        @endfor
                        <li class="{{ $paginator->isLastPage() ? 'disabled' : '' }}">
                            <a href="{{ route('post_list', ['page' => $paginator->nextPage()]) }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            @endif
        </div>
    </div>
@endsection