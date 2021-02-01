<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\post;
use App\comments;
use App\user;
use DB;
class PostsController extends Controller
{

 

   
    public function addPost(Request $request){

        $data=array();
        $data["content"]=$request->content;
        $data["status"] =0;
        $data['user_id']= Auth::user()->id;
        
        $catagory = DB::table('posts')->insert($data);
     return back()->with('msg', 'Your post is shear');  
    }

    public function deletePost($id){
      $deletePost = DB::table('posts')->where('id',$id)->delete();
     
    }

    public function updatePost($id, Request $request){
      $updatePost = DB::table('posts')->where('id',$id)->update([
        'content' => $request->updatedContent,
      ]);
     
    }

   






}
