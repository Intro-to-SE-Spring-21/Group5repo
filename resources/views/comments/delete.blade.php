@extends('layouts.main') @section('content')

<div class="container">
    <div class="mx-auto text-center">

        <div>
            <Strong>Are you <span class="function-title">SURE</span> you want to delete this comment?</Strong>
            <br>
            <br>
            <p class="text-left function-sub">Comment:</p>
            <p class="text-left">{{$comment->comment}}</p>
        </div>
        <br>
        <br>

        <div>
            <form action="{{ route('comment.destroy', ['comment' => $comment->id] )}}" method="DELETE">
                {{ csrf_field() }}
                <button class="btn btn-conu" type="submit">Delete this comment</button>
            </form>
            <br>
            <strong class="function-title">WARNING: ALL DELETES ARE FINAL</strong>
        </div>
    </div>

    @endsection
