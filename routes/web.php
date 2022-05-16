<?php

use App\Http\Controllers\FcmController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

####### TEST HTTP CLIENT ######
Route::get('/posts',[RequestController::class,'getAllPosts']);
Route::get('/new-post',[RequestController::class,'newPost']);
Route::get('/deletePost/{id}',[RequestController::class,'deletePost']);
Route::get('/getPostIfAuth',[RequestController::class,'getPostIfAuth']);
Route::get('/concurrentRequests',[RequestController::class,'concurrentRequests']);
Route::get('/getPostIfAuthByUsingMacro',[RequestController::class,'getPostIfAuthByUsingMacro']);
Route::get('/getPostsCollect',[RequestController::class,'getPostsCollect']);


Route::get('/getWeatherData',[WeatherController::class,'getWeatherData']);


########################


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');





###### To show Email Templates Before Send it Just For MAke Sure fot Testing.

Route::get('/showMail', function () {
    return (new \App\Notifications\ProductCreatedNotification())
        ->toMail('a@a.com');
});
