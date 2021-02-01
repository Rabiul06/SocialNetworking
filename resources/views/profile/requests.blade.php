@extends('layouts.app')


@section('content')
<div class="container" style="font-size:15px">
    <div class="row">

        <div class="col-md-9">
            <div class="panel panel-default">
                

                <div class="panel-body">
                    <div class="col-sm-12 col-md-12">
                         @if ( session()->has('msg') )
                         <p class="alert alert-success">
                                      {{ session()->get('msg') }} 
                                   </p>
                                @endif
                        @foreach($FriendRequests as $uList)

                        <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:15px">
                            <div class="col-md-2 pull-left">
                                <img src="{{url('../')}}/image/{{$uList->pic}}" width="80px" height="80px" class="img-rounded"/>
                            </div>

                            <div class="col-md-7 pull-left">
                                <h3 style="margin:0px;"><a href="{{url('/profile')}}/{{$uList->slug}}">{{ucwords($uList->name)}}</a></h3>

                                <p><b>Gender:</b> {{$uList->gender}}</p>
                                   <p><b>Email:</b> {{$uList->email}}</p>

                            </div>

                            <div class="col-md-3 pull-right">

                                     <p>
                                        <a href="{{url('/accept')}}/{{$uList->name}}/{{$uList->id}}"  class="btn btn-info btn-sm" style="font-size:15px">Confirm</a>

                                         <a href="{{url('/requestRemove')}}/{{$uList->id}}"  class="btn btn-info btn-sm" style="font-size:15px">Remove</a>

                                     </p>

                            </div>

                        </div>
                        @endforeach
                    </div>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection