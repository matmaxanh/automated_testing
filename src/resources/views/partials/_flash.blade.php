@if (Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{{ session('success') }}</li>
        </ul>
    </div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif