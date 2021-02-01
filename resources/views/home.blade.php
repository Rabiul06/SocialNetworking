<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>LaraBook</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="https://use.fontawesome.com/595a5020bd.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

        <style>
            html, body {
                background-color: #ddd;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                margin: 0;
            }
            .top_bar{
              position:relative; width:99%; top:0; padding:5px; margin:0 5
            }
            .full-height {
              margin-top:50px
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
                right:5px; top:15px
            }
            .top-left {
                position: absolute;
                width:40%

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
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .m-b-md {
                margin-bottom: 30px0;
            }
            .head_har{
              background-color: #f6f7f9;
                    border-bottom: 1px solid #dddfe2;
                    border-radius: 2px 2px 0 0;
                    font-weight: bold;
                    padding: 8px 6px;

            }
            .left-sidebar, .right-sidebar{
              background-color:#fff;
              height:600px;

            }
            .posts_div{margin-bottom:10px !important;}
            .posts_div h3{
              margin-top:4px !important;

            }
            #postText{
              border:none;
              height:100px
            }
            .likeBtn{
              color: #4b4f56; font-weight:bold; cursor: pointer;
            }
            .left-sidebar li { padding:10px;
              border-bottom:1px solid #ddd;
            list-style:none; margin-left:-20px}
            .dropdown-menu{min-width:120px; left:-30px}
            .dropdown-menu a{ cursor: pointer;}
            .dropdown-divider {
              height: 1px;
              margin: .5rem 0;
              overflow: hidden;
              background-color: #eceeef;}
              .user_name{font-size:18px;
               font-weight:bold; text-transform:capitalize; margin:3px}
              .all_posts{background-color:#fff; padding:5px;
               margin-bottom:15px; border-radius:5px;
                -webkit-box-shadow: 0 8px 6px -6px #666;
                -moz-box-shadow: 0 8px 6px -6px #666;
                 box-shadow: 0 8px 6px -6px #666;}
                #commentBox{
                  background-color:#ddd;
                  padding:10px;
                  width:99%; margin:0 auto;
                  background-color:#F6F7F9;
                  padding:10px;
                  margin-bottom:10px
                }
                #commentBox li { list-style:none; padding:10px; border-bottom:1px solid #ddd}
                .commet_form{ padding:10px; margin-bottom:10px}
                .commentHand{color:blue}
                .commentHand:hover{cursor:pointer}
                .upload_wrap{
                  position:relative;
                  display:inline-block;
                  width:100%
                }
                .center-con{
                  max-height:600px;
                  position: absolute;
                  left:calc(25%);
                  overflow-y: scroll;
                }
                @media (min-width: 268px) and (max-width: 768px) {

                  .center-con{
                    max-height:600px;
                    position: relative;
                    left:0px;
                    overflow-y: scroll;
                  }
                }


        </style>

    </head>
    <body>
<div id="app">
<div class="top_bar" >

      <div class="top-left links" style="float:left">
          <p v-for="result in results">
            <a :href="'{{url('profile')}}/' +  result.slug">
              <b>@{{result.name}} </b>
            </a>
          </p>
        </div>
      </div>

          <div class="top-right links" style="float:right">

              @if (Auth::check())
              
                  <a href="{{ url('/home') }}">Dashboard
                (<span style="text-transform:capitalize;font-size:18px;
                color:green">{{ucwords(Auth::user()->name)}}</span>)</a>
              @endif
          </div>

    </div>

<div class="flex-center position-ref full-height">



  <div class="col-md-12 "  >
@if(Auth::check())
    <!-- left side start -->
    <div class="col-md-3 left-sidebar hidden-xs hidden-sm" style="position:fixed; left:10px">

     <ul>
       <li>
         <a href="{{ url('/profile') }}/{{Auth::user()->slug}}"> <img src="image/{{Auth::user()->pic}}"
         width="32" style="margin:5px"  />
         {{Auth::user()->name}}</a>
       </li>
       <li>
         <a href="{{url('/')}}"> <img src="/img/news_feed.png"
         width="32" style="margin:5px"  />
         News Feed</a>
       </li>
       <li>
         <a href="{{ url('/requests')}}/{{Auth::user()->slug}}"> <img src="/img/friends.png"
         width="32" style="margin:5px"  />
         My request ({{App\friendships::where('status', Null)
                                                  ->where('user_requested', Auth::user()->id)
                                                  ->count()}})</span> </a>
       </li>
       <li>
         <a href="{{url('/massage')}}"> <img src="img/msg.png"
         width="32" style="margin:5px"  />
        Messages</a>
       </li>
       <li>
         <a href="{{ url('/findfriends')}}/{{Auth::user()->slug}}"> <img src="img/friends.png"
         width="32" style="margin:5px"  />
        Find Friends</a>
       </li>

       <li>
         <a href="{{url('/jobs')}}"> <img src="/img/jobs.png"
         width="32" style="margin:5px"  />
        Find Jobs</a>
       </li>
     </ul>


    </div>
    <!-- left side end -->

    <!-- center content start -->
    <div class="col-md-6 col-sm-12 col-xs-12 center-con">

        <div class="posts_div">
           <div class="head_har">
          <i class="fa fa-edit"></i> Make a post
           @if ( session()->has('msg') )
           <p class="alert alert-success" align="center">
            {{ session()->get('msg') }}
             </p>
            @endif

            </div>

            <div style="background-color:#fff; padding:10px">
              <div class="row">
                <div class="col-md-1 col-sm-2 pull-left">
                  <img src="image/{{Auth::user()->pic}}"
                   style="width:50px; margin:5px;  border-radius:100%">
                </div>
                <div class="col-md-11 col-sm-10 pull-right">
              
                  <form method="post" enctype="multipart/form-data" action="{{url('/addPost')}}" > {{ csrf_field() }}
                  <textarea  name="content" class="form-control"
                  placeholder="what's on your mind ?"></textarea>
                  <button type="submit" class="btn btn-sm btn-primary
                   pull-right" style="margin:10px; padding:5 15 5 15; background-color:#4267b2" name="post">Post</button>
                  </form>
                  

               


                </div>
              </div>
            </div>
        </div>

            <div>
               <!--<div class="head_har">  Posts</div> -->

               <div  >
                @foreach($datas as $data) 
                <div class="col-md-12 all_posts">

                    <div class="col-md-1 pull-left">
                      <img src="/image/{{$data->pic}}"
                      style="width:50px; border-radius:100%">
                    </div>

                <div class="col-md-10" style="margin-left:10px;">

                <div class="row">
                 <div class="col-md-11">

                   <p><a class="user_name">{{$data->name}}</a> <br>
                   <span style="color:#AAADB3">  {{ $data->created_at}}
                   <i class="fa fa-globe"></i></span></p>
                 </div>
                 <div class="col-md-1 pull-right">
                 
                    <!-- delete button goes here -->
                    <a href="" data-toggle="dropdown"
                    style="font-size:30px; color:#ccc; left:-15px"
                     aria-haspopup="true">...</a>
                    <div class="dropdown-menu">
                      <li><a href="{{url('/updatePost')}}">
                          <i class="fa fa-trash"></i>Edit</a></li>
                      <div class="dropdown-divider"></div>
                      <li>
                        <a href="{{url('/deletePost')}}/{{$data->id}}">
                          <i class="fa fa-trash"></i> Delete</a>
                        </li>
                    </div>

                 </div>
                </div>
                    </div>

                     <p class="col-md-12" style="color:#000; margin-top:15px; font-family:inherit">
                        {{$data->content}}
                       <br>
                       <img
                       src="/image/{{$data->pic}}"
                       style="width:100%;height: 100%"/>
                     </p>
                  </div>
               @endforeach
              </div>
            </div>
        </div>

    <!-- center content end -->

    <!-- right side start -->
    <div class="col-md-3 right-sidebar hidden-sm hidden-xs" style="position:fixed; right:10px">
        <h3 align="center">Right Sidebar</h3>


    </div>

    <!-- right side end -->
    @else
    <h1 align="center">Please login</h1>
@endif
  </div>

</div>
</div>

 <script src="{{ asset('js/app.js') }}"></script>


<script>
$(document).ready(function(){

$('#postBtn').hide();

  $("#postText").hover(function() {
  $('#postBtn').show();
 });

});

</script>

    </body>
</html>
