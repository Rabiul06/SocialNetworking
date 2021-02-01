<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Redirect;
use App\User;
use App\profile;
use App\friendships;
use App\notifcations;
class profilecontroller extends Controller
{
    public function index($slug){
      $Data = DB::table('users')
      ->leftJoin('profiles', 'profiles.user_id','users.id')
      ->where('users.id',Auth::user()->id)
      ->get();
    return view('profile.index')->with('Data', $Data);
     }


      public function addpic(){
      return view('profile.editpic');
      }



      public function uploadphoto(Request $request){
    	$file=$request->file('pic');
    	$filename=$file->getClientOriginalName();
    	$path = 'image';
    	$file->move($path, $filename);
    	$user_id=Auth::user()->id;

    	DB::table('users')->where('id' ,$user_id)->update(['pic'=>$filename]);
    	//return view('profile.editpic');
    	//return redirect()->url('profile.index');
     return redirect()->back();
    	
    }



       public function editprofile(){
     //return view('profile.editinfo')->with('data', Auth::user()->profile);
      $userData = DB::table('users')
      ->leftJoin('profiles', 'profiles.user_id','users.id')
      ->where('users.id',Auth::user()->id)
      ->get();
     return view('profile.editinfo')->with('userData', $userData);
}

    public function test(){
    return view('profile.index');
    }


       public function updateinfo(Request $request){
        $user_id = Auth::user()->id;
        DB::table('profiles')->where('user_id', $user_id )->update($request->except('_token'));
        return back();  
    } 



        public function findFriends() {
        $uid = Auth::user()->id;
        $allUsers = DB::table('profiles')
        ->leftJoin('users', 'users.id', '=', 'profiles.user_id')
        ->where('users.id', '!=', $uid)->get();
        return view('profile.findfriends', compact('allUsers'));
    }


     public function sendRequest($id) {

     Auth::user()->addFriend($id);
     return back();
    }


    public function requests() {
        $uid = Auth::user()->id;

        $FriendRequests = DB::table('friendships')
                        ->rightJoin('users', 'users.id', '=', 'friendships.requester')
                        ->where('status', '=', Null)
                        ->where('friendships.user_requested', '=', $uid)->get();


        return view('profile.requests', compact('FriendRequests'));
    }


     public function accept($name, $id) {

        $uid = Auth::user()->id;
        $checkRequest = friendships::where('requester', $id)
                ->where('user_requested', $uid)
                ->first();
        if ($checkRequest) {
            // echo "yes, update here";

            $updateFriendship = DB::table('friendships')
                    ->where('user_requested', $uid)
                    ->where('requester', $id)
                    ->update(['status' => 1]);

             // $notifcations = new notifcations;
  
             // $notifcations->user_hero = $id; // who is accepting my request
             // $notifcations->user_logged = Auth::user()->id; // me
             // $notifcations->status = '1'; // unread notifications
             // $notifcations->save();


            if ($updateFriendship) {

                return back()->with('msg', 'You are now Friend with ' . $name);
            }
        } else {
            return back()->with('msg', 'You are now Friend with this user');
        }
    }

    public function requestRemove($id) {

        DB::table('friendships')
                ->where('user_requested', Auth::user()->id)
                ->where('requester', $id)
                ->delete();

        return back()->with('msg', 'Request has been deleted');
    }

    public function addPost(Request $request){

        $data=array();
        $data["content"]=$request->content;
        $data["status"] =0;
        $data['user_id']= Auth::user()->id;
        
        $catagory = DB::table('posts')->insert($data);
     return back()->with('msg', 'Your post is shear');  
    }


    public function deletePost($id){
      $id = Auth::user()->id;
      $deletePost = DB::table('posts')
      ->where('user_id', Auth::user()->id)
      ->delete();
      return back()->with('msg', 'Your post is deleted') ;
    
    }

      public function editpost($id, Request $request){
      $updatePost = DB::table('posts')
      ->where('user_id', Auth::user()->id)
      ->update();
     
    }

    public function massage(){
      return view('profile.massage');
    }
    
public function sendMassage(Request $request){
   $conID = $request->conID;
   $msg = $request->msg;

   $face_userTo=DB::table('message')->where('conversion_id',$conID)
   ->where('user_to','!=',Auth::user()->id)
   ->get();
   $userTo =$face_userTo[0]->user_to;

   $sendM = DB::table('message')->insert([
   'user_to'=>$userTo,
   'user_from'=>Auth::user()->id,
   'message'=>$msg,
   'status'=>1,
   'conversion_id'=>$conID
   ]);
   if($sendM){
    $userMsg=DB::table('message')
  ->join('users','users.id','message.user_from')
  ->where('message.conversion_id',$conID)->get();
  return $userMsg;
   }
 }


       
}



  