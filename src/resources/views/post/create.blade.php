@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <h1>New post</h1>
            <hr>

            @include('partials._flash')

            <form method="post" action="{{ route('post_store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="control-label" for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Post title" value="{{ old('title') }}"/>
                </div>

                <div class="form-group">
                    <label class="control-label" for="body">Body</label>
                    <textarea name="body" class="form-control" id="body" rows="15">{{ old('body') }}</textarea>
                </div>

                <div class="buttons">
                    <button class="btn btn-primary">Save</button>
                    <a href="{{ route('post_list') }}" class="btn btn-default">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection