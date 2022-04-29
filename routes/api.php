<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\JobsController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Public Routes
Route::get('/test',[TestController::class,'index']);


//Authentication
Route::post('/register',[AuthController::class,'register']);
Route::post('/login/email',[AuthController::class,'loginwithemail']);
Route::post('/login/phonenumber',[AuthController::class,'loginwithphonenumber']);
Route::get('/jobs',[JobsController::class,'index']);
Route::post('/job',[JobsController::class,'store']);

//Protected Routes 
Route::group(['middleware' => ['auth:sanctum']], function(){
    //Authentication
    Route::post('/logout',[AuthController::class,'logout']);
    Route::get('/users',[AuthController::class,'index']);
    Route::get('/users/show/{id}',[AuthController::class,'show']);
    Route::delete('/user/delete/{userid}',[AuthController::class,'destroy']);
    
    //Blog
    Route::get('/blog', [BlogController::class, 'index']);
    Route::post('/blog',[BlogController::class,'store']);
    Route::put('/blogs/update/{blog}', [BlogController::class, 'update']);
    Route::get('/blog/show/{id}',[BlogController::class,'show']);
    Route::get('/blog/search/{name}',[BlogController::class,'searchblog']);
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy']);
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
