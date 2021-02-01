@extends('layouts.app')
@section('content')
<div class="container">
    
    <div class="row">
         
        <div class="col-md-8">
             <div class="card" >
                <div class="card-header">{{ Auth::user()->name }}</div>
                <div class="card-body" margin="auto">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
         <div class="card" style="width:200px;margin: auto;">
          <img class="card-img-top" src="image/{{Auth::user()->pic}}" alt="Card image">
              <div class="card-body">
              <h4 class="card-title" align="center">{{ Auth::user()->name }}</h4>
              @foreach($userData as $data)
              {{$data->city}}  - {{$data->country}}
              @endforeach
              <a href="{{url('/addpic')}}" class="btn btn-primary" align="center">Change Photo</a>
                 </div>
                 </div>
               </div>
                   
                        <form  action="{{url('/updateProfile')}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                            <div class="col-md-8">

                                <div class="input-group">
                                  City:
                                    <input type="text" class="form-control" placeholder="City Name" name="city" value="{{$data->city}}">
                                </div>
                                <br>
                                <div class="input-group">
                                  Country:
                                    <input type="text" class="form-control" placeholder="Country Name" name="country" value="{{$data->country}}">
                                </div>

                               <br>
                            </div>

                            <div class=" col-md-8">
                                <div class="input-group">
                                    About:
                                    <textarea type="text" class="form-control" name="about">{{$data->about}}</textarea>
                                </div>

                                <br>

                                <div class="input-group">

                                    <input type="submit" class="btn btn-success pull-right" >
                                </div>
                            </div>

                        </form>

                  

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

 

