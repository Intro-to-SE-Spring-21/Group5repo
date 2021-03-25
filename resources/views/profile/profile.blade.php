@extends('layouts.main')
@section('content')

<div class="container ">
    <div class="col-sm-11">

                <div class =" user_info">
                    @if($user->id == Auth::user()->id)
                    <a href= "{{ route('editProfile') }}"id= profile>Edit Profile</a>
                    @endif


                    @if(!empty($user->profile_pic))
                    <img src ="{{$user->profile_pic}}" class = "picture" alt="" style="float:left">
                    @else
                    <img src ="{{url('images/avatar.jpg')}}" class = "picture" alt="" style= "float:left">
                    @endif


                  <ul style="list-style-type:none">
                    <li id = user_name>User name:  {{$user->user_name}}</li>
                    <li id = title>Title:  {{$user->title}}</li>
                    <li>About me:</li>
                    <li><pre id="about_me">{{$user->about_me}}</pre></li>
                 </ul></div>


                 <div class = "user_stats">
                  <p id="activity">Activity</p>
                 <ul style="list-style-type:none">
                    <li>Profile created: {{$time}}</li>
                    <li>{{$user->view_count}} profile views</li>
                    <li>Number of posts: {{count($posts)}}</li>
                    <li>Number of answers: {{count($comments)}}</li>
                 </ul>
               </div>


   </div>
</div>
  @endsection
