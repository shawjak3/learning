@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>

    {{-- <form action="/posts/{{ $post->id }}" method="post">
      {{csrf_field()}}
      <input type="hidden" name="_method" value="PUT">
      <input type="text" name="title" placeholder="Enter Title" value="{{ $post->title }}">
      <input type="submit" value="Update">
    </form> --}}

    {!! Form::model($post, ['method' => 'PATCH', 'action' => ['PostsController@update', $post->id]]) !!}
      <div class="form-group">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::submit('Edit Post', ['class' => 'btn btn-primary']) !!}
      </div>
    {!! Form::close() !!}

    {{-- <form action="/posts/{{ $post->id }}" method="post">
      {{csrf_field()}}
      <input type="hidden" name="_method" value="DELETE">
      <input type="submit" value="Delete">
    </form> --}}

    {!! Form::open(['method' => 'DELETE', 'action' => ['PostsController@destroy', $post->id]]) !!}
      <div class="form-group">
        {!! Form::submit('Delete Post', ['class' => 'btn btn-primary']) !!}
      </div>
    {!! Form::close() !!}

@endsection
