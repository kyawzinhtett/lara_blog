@extends('layout.layout')

@section('content')
    <div class="container mt-3">
        <h1 class="text-center mb-3">Create New Post</h1>
        <form action="/posts" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Title</label>
                <input type="text" class="form-control" name="name" placeholder="Enter title">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" cols="30" rows="10" placeholder="Enter description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>
@endsection