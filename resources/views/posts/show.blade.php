@extends('layouts.single_post') @section('content')
<div class="container ">
    <h2 class=" function-title">{{ $post->title }}</h2>
    @if($post->user->user_name==null)
    <div><small>By <a href="{{route('profile', ['profile'=>$post->user_id])}}">{{$post->user->fullName()}}
    </a></small></div>
    @else
    <div><small>By <a href="{{route('profile', ['profile'=>$post->user_id])}}">{{$post->user->user_name}}
    </a></small></div>
    @endif
    <hr>

    <div class="col-sm-1">
        <form action="{{route('answer.vote', ['post' => $post->id, 'vote' => 'up'])}}">
            {{csrf_field()}}
            <button class="updownVoteButton">
         <img src="{{URL::asset('/images/up_arrow.png')}}"  /></button>
        </form>
        <p class="votecount">{{$post->countVotes()}}</p>
        <form action="{{route('answer.vote', ['post' => $post->id, 'vote' => 'down'])}}">
            {{csrf_field()}}
            <button class="updownVoteButton"><img src="{{URL::asset('/images/down_arrow.png')}}"  /></button>
        </form>

    </div>
    <div class="col-sm-6">
        <p>{{ $post->body }}</p>

        <p>Posted in: {{$post->category->name}}</p>
        @foreach($post->tags as $tag)
        <label class="tags">{{$tag->name}}</label> @endforeach
        <br> @if(Auth::id()==$post->user_id and $post->solved==FALSE)

        <p>Last Edit: {{mb_substr($post->updated_at, 0, 10)}}</p>
        <a href="{{ route('post.edit', ['post' => $post->id])}}" class="btn btn-conu btn-xs btn-info pull-left edit-delete">Edit</a>
        <a href="{{ route('post.delete', ['post' => $post->id])}}" class="btn btn-conu btn-xs btn-info pull-left edit-delete">Delete</a>
        <br> @elseif(Auth::id()==$post->user_id and $post->solved==TRUE)
        <a href="{{ route('post.reopen', ['post' => $post->id])}}" class="btn btn-xs btn-info pull-left edit-delete">Reopen Post</a> @endif


    </div>
    <br>



    <div class="col-sm-1"> </div>
    <div class="col-sm-11">
        </br>
        </br>
        <h2 style="color:darkred"><b>Comments</b></h2>


        @foreach($post->comments as $comment)
        <div class="col-sm-12">
            <h5 class="post-title">{{$comment->name}} commented </h5>
        </div>
        <div class="col-sm-1">

            <!-- Votes for comments -->
            <form action="{{route('comment.vote', ['comment' => $comment->id, 'vote' => 'up'])}}">
                {{csrf_field()}}
                <button class="updownVoteButton"><img src="{{URL::asset('/images/up_arrow.png')}}"  /></button>
            </form>
            <p class="votecount">{{$comment->countVotes()}}</p>
            <form action="{{route('comment.vote', ['comment' => $comment->id, 'vote' => 'down'])}}">
                {{csrf_field()}}
                <button class="updownVoteButton"><img src="{{URL::asset('/images/down_arrow.png')}}"  /></button>
            </form>

            <!-- End Votes -->
        </div>

        <div class="col-sm-11">
            <p>{{$comment->comment}}</p>



            <p>Last Edit: {{mb_substr($comment->updated_at, 0, 10)}}</p>
            @if(Auth::id()==$comment->user_id)
            <a href="{{ route('comment.edit', ['comment' => $comment->id])}}" class="btn btn-conu btn-xs btn-info pull-left edit-delete">Edit</a>
            <a href="{{ route('comment.delete', ['comment' => $comment->id])}}" class="btn  btn-conu btn-xs btn-info pull-left edit-delete">Delete</a> @endif @if(Auth::id()==$post->user_id and $post->solved==FALSE)
            <a href="{{ route('comment.answer', ['comment' => $comment->id])}}" class="btn btn-conu btn-xs btn-info pull-left edit-delete">Best Answer</a> @endif @if(Auth::id()==$comment->user_id and $comment->best_answer==TRUE)
            <p style="color : green ; font-weight:bold; background: GreenYellow ;" class="btn btn-conu btn-xs btn-info pull-left edit-delete"> Best Answer</p> @endif
            <br>
        </div>
        @endforeach

        <div class="col-sm-12">
            <div>
                <form action="{{ route('comments.store', ['post' => $post->id] )}}" method="post">
                    {{ csrf_field() }}

                    <div class="form-group">
                        </br>
                        <label for="">Comment</label>
                        <textarea name="comment" id="" cols="30" rows="10" class="form-control" required></textarea>
                    </div>

                    <button class="btn btn-conu" type="submit">Add Comment</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection @section('related') @if($related != NULL)
<div class="contain2">
    <p style="font-weight:600; font-size:16px">Related Posts</p>
</div>@foreach($related as $post)
<?php
                    $numberOfComments = count($post->comments);
                    $numberOfViews = $post->view_count;
                ?>



    <div class="rowContainer2 contain2" class="row">
        <p></p>
        <div class="col-sm-2">
            <span class="nb-of-Comments-Block " style=" visible !important;
                                WIDTH: 110%;
                                display: block;
                                text-align: center;">
                                <a href="{{route('post.show', ['post' => $post->id])}}">{{$numberOfComments }}</a>
                                </br>
                            Comments</span>
        </div>

        <div class="col-sm-2">
            <span style=" overflow: visible !important;
                                WIDTH: 110%;
                                display: block;
                                text-align: center;">
                                <a href="{{route('post.show', ['post' => $post->id])}}">{{$post->countVotes()}}</a>
                                </br>
                                Votes</span>
        </div>

        <div class="col-sm-2">
            <span class="nb-of-Comments-Block " style=" overflow: visible !important;
                                WIDTH: 110%;
                                display: block;
                                text-align: center;">
                                <a href="{{route('post.show', ['post' => $post->id])}}">{{$numberOfViews }}</a>
                                </br>
                                Views</span>
        </div>

        <div class="col-sm-6">
            <span style=" overflow: auto;
                                WIDTH: 100%;
                                display: block;
                                text-align: center;">

                            <a href="{{route('post.show', ['post' => $post->id])}}">{{ $post->title }}</a>
                            @foreach($post->tags as $tag)
                            <label class ="tags">{{$tag->name}}</label>
                            @endforeach
                                </span>
        </div>

    </div>


    @endforeach @else
    <p style="margin-left: 150px ; margin-top : -9px; font-weight: bold ;font-size: 20px; font-color: black;
              text-decoration: underline ">There are no related posts </p>@endif @endsection
