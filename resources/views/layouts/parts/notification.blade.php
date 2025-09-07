@if ($errors->any())
<div class="alert alert-danger" role="alert">
    <strong>Error!</strong>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        <strong>Success!</strong>
        {{ session('success') }}
    </div>
@endif