@extends('layouts.main') @section('content')

<div class="container">
    <div class="mx-auto text-center">

        <div>
            <Strong>Are you <span class="function-title">SURE</span> you want to delete this post titled "{{$post->title}}"? </Strong>
            <br>
            <br>
            <p class="text-left function-sub">Content:</p>
            <p class="text-left">{{$post->body}}</p>
        </div>
        <br>
        <br>

        <div>
            <form action="{{ route('post.destroy', ['post' => $post->id] )}}" method="DELETE">
                {{ csrf_field() }}
                <button class="btn btn-conu" type="submit">Delete this post</button>
            </form>
            <br>
            <strong class="function-title">WARNING: ALL DELETES ARE FINAL</strong>
        </div>
    </div>

    @endsection
