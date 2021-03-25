@extends('layouts.main') @section('stylesheets') {!! Html::style('css/select2.min.css') !!} @endsection @section('content')
<div class="container wrap-rob">
    <h2 class="function-title">Create Your Post</h2>

    <form action="/post" method="post">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="" class="function-sub">Title</label>
            <input type="text" class="form-control form--width" name="title" maxlength="50" required>
        </div>
        <div class="form-group">
            <label for="tags" class="function-sub">Tags</label>
            <select class="form-control select2-multi form--width" name="tags[]" multiple="multiple">
            @foreach($tags as $tag)
            <option value="{{$tag->name}}">{{$tag->name}}</option>
            @endforeach
        </select>
        </div>




        <div class="form-group form--width">
            <label for="" class="function-sub">Category</label> @if($categories->count() != 0)
            <select class="form-control " name="Category" required>
                @foreach($categories as $category)
                <option name ="category_id" value={{$category->id}}>{{$category->name}}</option>
                @endforeach
            </select> @endif

        </div>
        <br>
        <div class="form-group">
            <label for="" class="function-sub">Description</label>
            <textarea name="body" id="" cols="30" rows="10" class="form-control" required></textarea>
        </div>

        <button class="btn btn-conu" type="submit">Create Post</button>
    </form>
</div>
@endsection @section('scripts') {!! Html::script('js/select2.min.js') !!}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="test/javascript">
    $('.select2-multi').select2();
</script>
@endsection
