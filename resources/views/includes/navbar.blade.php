<nav class="navbar navbar-default navbar-static-top nav-background ">
    <div class="container">
        <div class="navbar-header">



            <!-- Branding Image -->
            <a class="navbar-brand  nav-title" href="{{ url('/') }}">
                <span class="function-sub ">S</span>tack<span class="function-sub">U</span>nderflow
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>
            <div class="top-middle">
                <form action="{{ route('post.search')}}" class="form-inline" method="get">
                    <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                </form>
            </div>
            <!-- Right Side Of Navbar -->
            <div class="top-right linkstwo">

                @auth
                <a href="{{ url('/post/create') }}">Create a Post</a>
                <a href="{{ url('/posts_list') }}">View Posts</a>
                <a href="{{ url( route('user.activity', ['user_id' => Auth::id()])) }}">My Posts</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>





                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>

                @else
                <a href="{{ route( 'login') }} ">Login</a>
                <a href="{{ route( 'register') }} ">Register</a> @endauth

            </div>
            <div class="top-right-pic linkstwo">
                <a href="{{url('profile', Auth::user())}}">
                    <?php $user = Auth::user();?> @if(!empty($user->profile_pic))
                    <img src="{{$user->profile_pic}}" class="avatars" alt=""> @else
                    <img src=" {{url( 'images/avatar.jpg')}} " class="avatars " alt=" "> @endif
                </a>
            </div>
        </div>
</nav>
