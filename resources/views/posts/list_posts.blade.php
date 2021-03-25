@extends('layouts.main') @section('content')

<!-- Styles -->

<link href="{{ asset('css/style.css') }}" rel="stylesheet">


<div class="container">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <h2 class="function-title">Currently Open Posts</h2>
    </br>

    <form action="{{ route('posts.filter')}}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
          <div class = "col-sm-4">
            <label for="" class="function-sub ">Category</label> @if($categories->count() != 0)
            <select class="form-control " name="Category" required>
                    <option name ="category_id" value=All>All</option>
                    @foreach($categories as $category)
                    <option name ="category_id" value={{$category->id}}>{{$category->name}}</option>
                    @endforeach
                </select> @endif
          </div>
          <div class= "col-sm-4">
            <label for="" class="function-sub col-sm-2">Status</label>
            <select class="form-control " name="Status" required>
                <option name ="status" value='All'>All</option>
                <option name ="status" value=0>Open</option>
                <option name ="status" value=1>Closed</option>
            </select>
          </div>
        </div>
        <div>
        </br>
        <button class="btn btn-conu btn-apply" type="submit">Apply</button></div>
      </br></br>
    </form>
  <br> @foreach($posts as $post)
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
                <span class="nb-of-Comments-Block " style=" overflow: auto;
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
                    <p>Last Edit: {{mb_substr($post->updated_at, 0, 10)}}</p>
                        </span>
            </div>

        </div>

        @endforeach

</div>
@endsection