<?php

use Illuminate\Http\Request;
use App\Video;
use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::get('user/{username}/size', function (Request $request, $username) {
	
    $user=User::where('username', $username)
					->with('videos')
					->firstOrFail();
					
	return $user
			->videos
			->sum('video_size');
		
});


Route::get('video/{id}', function (Request $request, $id) {
	
    $video=Video::where('id', $id)
					->select('viewers','video_size', 'user_id')
					->with('user')
					->firstOrFail()
					->toArray();
					

	return [ 'created_by' =>  $video['user']['username'], 
			  'viewers' => $video['viewers'],
			  'video_size' => $video['video_size'] ];

});

Route::patch('video', function (Request $request) {
	
	$video=Video::where('id', $request->id);
    return ['Success' => 'VideoID' . $request->id . ' was updated'];
});
