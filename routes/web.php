<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\FrontEndControlller;
use App\Http\Controllers\FollowController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/',[App\Http\Controllers\FrontEndControlller::class,'index']);

Auth::routes();

Route::get('/', [App\Http\Controllers\FrontEndControlller::class, 'index'])->name('home');

Route::get('/user/profile/{id}', [App\Http\Controllers\FrontEndControlller::class, 'userprofile'])->name('userprofile')->middleware('auth');
Route::get('/user/{id}/albums/', [App\Http\Controllers\FrontEndControlller::class, 'useralbums'])->name('useralbum');
Route::get('/user/{id}',[App\Http\Controllers\FollowController::class,'userAvatar']);
Route::post('/profilepic',[App\Http\Controllers\FollowController::class,'updateProfilePic']);
Route::post('/backgroundpic',[App\Http\Controllers\FollowController::class,'updateBg']);
Route::get('/user/background/{id}',[App\Http\Controllers\FollowController::class,'backgroundUser']);

Route::get('/albums/create/',[App\Http\Controllers\AlbumController::class, 'create'])->name('album_create');

Route::get('/albums',[App\Http\Controllers\AlbumController::class, 'index'])->name('albums');
Route::get('/albums/get/',[App\Http\Controllers\AlbumController::class, 'getAlbums']);

Route::post('/albums/store',[App\Http\Controllers\AlbumController::class, 'store']);

Route::put('/albums/{id}/edit',[App\Http\Controllers\AlbumController::class,'update']);
Route::delete('album/{id}/delete',[App\Http\Controllers\AlbumController::class,'destroy']);

Route::get('/albums/{slug}/{album_id}',[App\Http\Controllers\GalleryController::class,'viewAlbum'])->name('viewalbum');

Route::get('/upload/images/{id}',[App\Http\Controllers\GalleryController::class,'create']);

Route::post('/upload/image',[App\Http\Controllers\GalleryController::class,'upload']);

Route::get('/getimages',[App\Http\Controllers\GalleryController::class,'images'])->middleware('auth');


Route::delete('/image/{image_id}/delete',[App\Http\Controllers\GalleryController::class,'destroy'])->middleware('auth');
Route::post('/follow',[App\Http\Controllers\FollowController::class,'followUnfollow']);
