<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
         
        <!-- Styles -->
        <style>
            html, body {
                background-color: #ddd;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                         <a href="{{ url('/profile')}}/{{Auth::user()->slug}}">Profile</a>
                    @else
                        <a  style="color:blue" href="{{ route('login')}}">Login</a>

                        @if (Route::has('register'))
                            <a style="color:blue" href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
                       
            <div class="container">
                <div id="app">
                   <!-- <h1 align="center">All post are view here</h1> -->
                   <img src="/image/home.jpg" style="width:1200px; height:400px margin: 100px">
              
            </div> 
            <br>
            <!--   @foreach($posts as $post)  
               <div class="col-md-12" style="background-color:#fff;width:800px">
                    <div class="col-md-2 pull-left">
                     <img src="/image/{{$post->pic}}" style="width:100px; margin: 10px">
                    </div>
                    <div class="col-md-6">
                        <h3>{{$post->name}}</h3>
                        <p>{{$post->city}}|{{$post->country}}</p>
                    </div>
                    <div><p class="col-md-12" style="color:red ">{{$post->content}}</p></div>
                   @endforeach
                 
                </div>
 -->
            </div>
            
       
        </div>
      <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
