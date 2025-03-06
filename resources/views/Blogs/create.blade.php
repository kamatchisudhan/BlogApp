@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Create Blog</h2>
    <form action="/createblog" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Upload Image</label>
        <input type="file" name="image" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>

</div>
@endsection
