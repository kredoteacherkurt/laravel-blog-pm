@extends('layouts.app')


@section('title', 'Homepage')



@section('content')
    @forelse ($all_posts as $post)
        <div class="p-3 border rounded-1">
            <a href="" class="h5">
                {{ $post->title }}
            </a>
            <p class="text-muted">{{ $post->user->name }}</p>
            <p>{{ $post->body }}</p>
            @if ($post->user->id === Auth::id())
                <div class="text-end p-0">
                    <a href="#" class="btn btn-sm btn-outline-warning">
                        <i class="fa-regular fa-pen-to-square"></i>

                    </a>
                    <form action="#" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </form>
                </div>
            @endif
        </div>
    @empty
        <div style="margin-top: 100px">
            <h2 class="text-muted text-center">No posts yet</h2>
            <p class="text-center">
                <a href="{{ route('post.create') }}" class="text-decoration-none">Create a new post</a>
            </p>
        </div>
    @endforelse
@endsection
