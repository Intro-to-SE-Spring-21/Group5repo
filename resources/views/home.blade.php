@extends('layouts.main')
<style type = "text/css">
    .avatar{
            border-radius: 50%;
            max-width:50px;
            }
</style>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">



        @if(count($errors)>0)
           @foreach($errors->all() as $error)
          <div class = "alert alert-danger">{{$error}}</div>
           @endforeach
        @endif
        @if(session('response'))
          <div class ="alert alert-success">
            {{session('response')}}
          </div>
        @endif



            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class ="col-md-4">
                        @if(!empty($user->profile_pic))
                        <img src ="{{$user->profile_pic}}" class = "avatar" alt="">
                        @else
                        <img src ="{{url('images/avatar.jpg')}}" class = "avatar" alt="">
                        @endif
                    </div>
                    <div class ="col-md-8">
                    @if (session('status'))
                        <div class="alert alert-success">
                        {{ session('status') }}
                        </div>
                    @endif


                    {{ $user->fullName() }} logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
