@extends('layouts.app')

@section('title','Edit post')


@section('content')
    <form action="{{route('post.update',$post)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="body" rows="3">{{$post->body}}</textarea>
        </div>
        <div class="mb-3">
            <img src="{{asset('storage/images/'.$post->image)}}" alt="" class="d-block img-thumbnail">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button class="btn btn-primary px-5">Post</button>
    </form>

@endsection
