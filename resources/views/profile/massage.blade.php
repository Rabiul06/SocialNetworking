@extends('layouts.app')
@section('content')

<div class="container">
<div class="row">
  <div class="col-md-3" style="background-color:#fff">
<h3 style="text-align:center">User List</h3><hr>
<ul v-for="privetMassage in privetMassages">
   <li @click="massage(privetMassage.id)" style="list-style-type:none;margin-top:10px;font-size:15px;background-color:#ddd "><img :src="'/image/' + privetMassage.pic"
   style="width:50px; border-radius:100%; ">
  <strong>@{{privetMassage.name}}</strong>
   <p>This is demo massage</p>
</li>
  
</ul>

  </div>

  <div class="col-md-5" style="background-color:#fff;">
<h3 style="text-align:center">Massage</h3><hr>
<div v-for="singlMsg in singlMsgs">
  <div v-if="singlMsg.user_from == <?php echo Auth::user()->id;?>">
    <div class="col-md-12" style="margin-top:10px">
        <img :src="'/image/' + singlMsg.pic"
      style="width:30px; border-radius:100%; margin-left:5px" class="pull-right">
         <div style="float:right; background-color:#0084ff; padding:5px 15px 5px 15px;
          margin-right:5px;color:#333; border-radius:10px; color:#fff;font-size:14px" >
          @{{singlMsg.message}}
        </div>
  </div>
</div>

   <div v-else>
     <div class="col-md-12 pull-right"  style="margin-top:10px">
     <img :src="'/image/' + singlMsg.pic"
      style="width:30px; border-radius:100%; margin-left:5px;" class="pull-left">
   <div style="float:left; background-color:#F0F0F0; padding:5px 15px 5px 15px;
        border-radius:10px; text-align:right; margin-left:5px;font-size:14px ">
        @{{singlMsg.message}}
  </div>
  </div>
  </div>
  </div>
   <div>
     <input type="hidden" v-model="conID">
   <textarea class="col-md-12 form-control" v-model="msgFrom" @keydown="inputHandler"
    style="margin-top:15px; border:none"></textarea>
   </div>
   
</div>
   <div  class="col-md-4" style="background-color:#fff">
<h3 style="text-align:center">Right</h3><hr>
  </div>
</div>
</div>


@endsection                        