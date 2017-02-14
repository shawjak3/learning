@extends('layouts.app')

@section('content')
    <h1>Posts Page</h1>

    <ul>
      @foreach ($posts as $post)
        <li><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></li>
      @endforeach
    </ul>
@endsection
