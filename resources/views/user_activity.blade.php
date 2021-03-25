@extends('layouts.main') @section('content')

<!-- Styles -->

<link href="{{ asset('css/style.css') }}" rel="stylesheet">

<div class="container">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <h2 class="function-title">{{Auth::user()->fullName()}} Posts</h2>
    </br>
        <?php
        if(sizeof($posts)== 0){
         echo '<h4>No posts available</h4>';
        }
        ?>
    @foreach($posts as $post)

    <?php
            $numberOfComments = count($post->comments);
            $numberOfViews = $post->view_count;
            ?>


        <div id="rowContainer1" class="row">
            <div class="col-sm-1">
                <span class="nb-of-Comments-Block " style=" overflow: auto;
                          WIDTH: 100%;
                          display: block;
                          text-align: center;">
                        <a href="{{route('post.show', ['post' => $post->id])}}">{{$numberOfComments }}</a>
                        </br>
                        Comments</span>
            </div>

            <div class="col-sm-1">
                <span style=" overflow: auto;
                          WIDTH: 100%;
                          display: block;
                          text-align: center;">
                        <a href="{{route('post.show', ['post' => $post->id])}}">{{$post->countVotes()}}</a>
                        </br>
                        Votes</span>
            </div>

            <div class="col-sm-1">
                <span class="nb-of-Comments-Block " style=" text-overflow: ellipsis;
                          WIDTH: 100%;
                          display: block;
                          text-align: center;">
                        <a href="{{route('post.show', ['post' => $post->id])}}">{{$numberOfViews }}</a>
                        </br>
                        Views</span>
            </div>

            <div class="col-sm-9">
                <span style=" overflow: auto;
                          WIDTH: 100%;
                          display: block;
                          text-align: center;">

                    <a href="{{route('post.show', ['post' => $post->id])}}">{{ $post->title }}</a>
                     @foreach($post->tags as $tag)
                      <label class ="tags">{{$tag->name}}</label>
                    @endforeach
                    <label>Last Edit: {{mb_substr($post->updated_at, 0, 10)}}</label>
                        </span>
            </div>
        </div>



        @endforeach



        </br>
        <h2 class="function-title">{{Auth::user()->fullName()}} Comments</h2>
        </br>


        <?php
        if(sizeof($comments)== 0){
            echo '<h4>No comments available</h4>';
        }
        ?>

        @foreach($comments as $comment)


        <div div id="rowContainer1" class="row">


            <div class="col-sm-5">
                <span class="My-Comments " style=" overflow: auto;
                          WIDTH: 100%;
                          display: block;
                          text-align: center;">
                        <div class="titleOfComment"><a href="{{route('post.show', ['post' => $comment->post_id])}}">{{$comment->post->title}}</a></div>
                        <div class="commentContent">{{ $comment->comment }}</div>

                        </span>
            </div>

            <div class="col-sm-7">
                <span style=" overflow: auto;
                          WIDTH: 100%;
                          display: block;
                          text-align: center;">


                    <p>Last Edit: {{mb_substr($post->updated_at, 0, 10)}}</p>
                        </span>
            </div>

        </div>



        @endforeach

</div>


@endsection
