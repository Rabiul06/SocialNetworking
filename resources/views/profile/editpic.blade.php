@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
      
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{Auth::user()->name}}</div>
                <div class="card-body">
               
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   <img src="image/{{Auth::user()->pic}}" width="80px" height="80px"  accept = 'image/jpeg , image/jpg, image/gif, image/png'><br>
               <br>
               <hr>
               <form action="{{url('/')}}/uploadphoto" method="post" enctype="multipart/form-data">
               	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
               	<input type="file" name="pic" class="form controll"/>
               	<input type="submit" class="btn btn-success" name="submit"/>
               </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection