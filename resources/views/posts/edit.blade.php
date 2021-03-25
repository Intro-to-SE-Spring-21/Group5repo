@extends('layouts.main') @section('content')

<div class="container">
    <div><small>By {{ $post->user->fullName() }}</small></div>
    <h1>{{ $post->title }}</h1>
    <div>

        <form action="{{ route('post.update', ['post' => $post->id] )}}" method="post">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="" class="function-title">Edit Issue</label>
                <textarea name="body" id="" cols="30" rows="10" class="form-control">{{$post->body}}</textarea>
            </div>

            <button class="btn btn-conu" type="submit">Update</button>
        </form>
    </div>

</div>

@endsection
