@extends('layouts.app')

@section('content')
<div class="container"style="font-size:15px">
    <div class="row justify-content-center">
       
        <div class="col-md-6">
            <div class="card">
             <div class="card-header">{{Auth::user()->name}}</div>
            <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                 <img src="/image/{{Auth::user()->pic}}" width="80px" height="80px"  accept = 'image/jpeg , image/jpg, image/gif, image/png'><br>

                       @foreach($Data as $data)
                       {{$data->city}}  - {{$data->country}} <br>
                       {{$data->about}}
                     @endforeach
                </div>
             </div>
        </div>
    </div>
</div>



@endsection

