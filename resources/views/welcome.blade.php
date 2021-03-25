@extends('layouts.main') @section('content')
<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>StackUnderflow</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">


</head>

<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">

        </div>
        @endif

        <div class="content">
            <div class="welcome-message col-sm-4" >
                @auth
                <h2><b>Welcome {{Auth::user()->fullName()}}, get answers to questions you didn't know you had.</b></h2>
                <p>StackUnderflow provides motivated web designers with a platform to share their
                  knowledge and experience.</p>


                  @else
                  <h2><b>Welcome, get answers to questions you didn't know you had.</b></h2>
                  <p>StackUnderflow provides motivated web designers with a platform to share their
                    knowledge and experience.</p>

                  </br><a href= '{{ route('register') }}'><button class = "btn btn-conu">
                    Register Here</button></a>

                  <p class = "links"><a href= '{{ route('login') }}'> login </a></p>
                  @endauth
                </div>


                <div class="col-sm-4">
                  <img src="http://www.bluebison.net/sketchbook/2006/0506/monkey_snake_swimming.jpg"
                  class="image_water" alt="waterfall">
                </div>

                </div>
              </div>
            </div>
          </body>

</html>
@endsection
