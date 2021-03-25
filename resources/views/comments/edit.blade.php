@extends('layouts.main') @section('content')

<div class="container">
    <div><small>By {{ $comment->user->fullName() }}</small></div>
    <br>
    <div>

        <form action="{{ route('comment.update', ['comment' => $comment->id] )}}" method="post">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="" class="function-title">Edit Comment</label>

                <textarea name="comment" id="" cols="30" rows="10" class="form-control">{{$comment->comment}}</textarea>
            </div>

            <button class="btn btn-conu" type="submit">Update</button>
        </form>
    </div>

</div>

@endsection
