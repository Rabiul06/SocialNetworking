<?php

use Illuminate\Support\Facades\Route;
Route::get('/anything', function () {
    return Auth::user()->test();
});

// Route::get('/', function () {
//     $posts=DB::table('posts')
//     ->Join('profiles','profiles.user_id','posts.user_id')
//     ->Join('users','users.id','posts.user_id')
//     ->get();
// 	return view('welcome',compact('posts'));
// });


Route::get('/', function(){
	$posts = DB::table('posts')
	->leftJoin('profiles','profiles.user_id','posts.user_id')
	->leftJoin('users','posts.user_id','users.id')
	->orderBy('posts.created_at','desc')->take(2)
	->get();
	return view('welcome',compact('posts'));
});



Auth::routes();

Route::group(['middleware' => 'auth'], function () {
 Route::get('/home', 'HomeController@index');
Route::get('/profile/{slug}','profileController@index')->name('profile');
Route::get('/addpic','profilecontroller@addpic');
Route::post('/uploadphoto', 'profileController@uploadphoto');  
Route::get('/editprofile', 'profileController@editprofile');  
Route::get('/test', 'profileController@test');
Route::post('/updateProfile', 'profileController@updateinfo');  
Route::get('/findfriends/{slug}', 'profileController@findFriends')->name('findfriends');
Route::get('/addFriend/{id}', 'ProfileController@sendRequest');
Route::get('/requests/{slug}', 'ProfileController@requests')->name('requests');
Route::get('/accept/{name}/{id}', 'ProfileController@accept');
Route::get('requestRemove/{id}', 'ProfileController@requestRemove');
Route::post('/addPost', 'ProfileController@addPost');
Route::get('/massage', 'ProfileController@massage');
Route::get('/home', function(){
	$datas = DB::table('posts')
	->leftJoin('profiles','profiles.user_id','posts.user_id')
	->leftJoin('users','posts.user_id','users.id')
	->orderBy('posts.created_at','desc')->take(3)
	->get();
	return view('home',compact('datas'));
});
Route::get('/deletePost/{id}','ProfileController@deletePost');
Route::post('editpost/{id}', 'ProfileController@editpost');
Route::get('/massage','ProfileController@massage');
Route::get('/getMassage',function(){
$allUser = DB::table('users')
->join('conversion','users.id','conversion.user_one')
->where('conversion.user_two',Auth::user()->id)->get();
//return $allUser;

$allUser1 = DB::table('users')
->join('conversion','users.id','conversion.user_two')
->where('conversion.user_one',Auth::user()->id)->get();
return array_merge($allUser->toArray(),$allUser1->toArray());
});
Route::get('/getMassage/{id}',function($id){
// 	$checkCon=DB::table('conversion')->where('user_one',Auth::user()->id)
// 	->where('user_two',$id)->get();
// if(count($checkCon)!=0){
	
// 	$userMsg=DB::table('message')->where('message.conversion_id',$checkCon[0]->id)->get();
// 	return $userMsg;
// }else{
// 	echo "no msg";
// }
	$userMsg=DB::table('message')
	->join('users','users.id','message.user_from')
	->where('message.conversion_id',$id)->get();
 	return $userMsg;
});
 Route::post('/sendMassage','ProfileController@sendMassage');
});
    