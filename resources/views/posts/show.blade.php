@extends('layouts.app')

@section('title', 'Show Post')

@section('content')
    <div class="mt-2 border border-2 rounded py-3 px-4 shadow-sm">
        <h2 class="h4">{{$post->title}}</h2>
        <h3 class="h6 text-muted">
                {{$post->user->name}}
        </h3>
        <p>{{$post->body}}</p>
        {{--
            call the image from the storage/public/images folder
            --}}
        {{-- <img src="{{asset('images/'.$post->image)}}" alt="{{$post->image}}" class="w-100 shadow"> --}}
        <img src="{{asset('/storage/images/'.$post->image)}}" alt="{{$post->title}}" class="w-100 shadow">
    </div>
    {{-- Prepare the form that submits a comment. --}}
    <form action="" method="POST">
        @csrf
        <div class="input-group mt-5">
            <input type="text" class="form-control" name="comment" id="comment" placeholder="Enter your comment here..." value="{{ old('comment') }}">
            <button type="submit" class="btn btn-outline-secondary btn-sm ">Post</button>
        </div>


   </form>

@endsection
