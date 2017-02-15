@extends('layouts.app')

@section('content')
    <h1>Create Page</h1>

    {{-- <form action="/posts" method="post">
      <input type="text" name="title" placeholder="Enter Title">
      {{csrf_field()}}
      <input type="submit" name="Submit">
    </form> --}}

    {!! Form::open(['method' => 'POST', 'action' => 'PostsController@store']) !!}
      <div class="form-group">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::submit('New Post', ['class' => 'btn btn-primary']) !!}
      </div>
    {!! Form::close() !!}

    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

@endsection
