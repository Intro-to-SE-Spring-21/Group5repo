@extends('layouts.main')

@section('content')

    <!-- Styles -->

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">


    <div class="container">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <h2>Search Results</h2>
    </br>

    @foreach($posts as $post)
        <?php
            $numberOfComments = count($post->comments);
            $numberOfViews = $post->view_count;
        ?>
            <div id="rowContainer1" class="row">
                <div class="col-sm-1">
                    <span class = "nb-of-Comments-Block "style=   " overflow: auto;
                          WIDTH: 100%;
                          display: block;
                          text-align: center;">
                        <a href="{{route('post.show', ['post' => $post->id])}}">{{$numberOfComments }}</a>
                        </br>
                    Comments</span>
                </div>

                <div class="col-sm-1">
                    <span style=   " overflow: auto;
                          WIDTH: 100%;
                          display: block;
                          text-align: center;">
                        <a href="{{route('post.show', ['post' => $post->id])}}">{{$post->countVotes()}}</a>
                        </br>
                        Votes</span>
                </div>

                <div class="col-sm-1">
                    <span class = "nb-of-Comments-Block "style=   " overflow: auto;
                          WIDTH: 100%;
                          display: block;
                          text-align: center;">
                        <a href="{{route('post.show', ['post' => $post->id])}}">{{$numberOfViews }}</a>
                        </br>
                        Views</span>
                </div>

                <div class="col-sm-9" >
                    <span style=   " overflow: auto;
                          WIDTH: 100%;
                          display: block;
                          text-align: center;">

                    <a href="{{route('post.show', ['post' => $post->id])}}">{{ $post->title }}</a>
                    <p>Last Edit: {{mb_substr($post->updated_at, 0, 10)}}</p>
                        </span>
                </div>

            </div>

    @endforeach

</div>
@endsection