<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\ApplyJobController;


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

//Protected Routes 
Route::group(['middleware' => ['auth:sanctum']], function(){
    //Authentication
    Route::post('/logout',[AuthController::class,'logout']);
    Route::get('/users',[AuthController::class,'index']);
    Route::get('/users/show/{id}',[AuthController::class,'show']);
    Route::delete('/user/delete/{userid}',[AuthController::class,'destroy']);
    Route::put('/user/update/{id}',[AuthController::class,'update']);
    
    //Blog
    Route::get('/blog', [BlogController::class, 'index']);
    Route::post('/blog',[BlogController::class,'store']);
    Route::put('/blogs/update/{id}', [BlogController::class, 'update']);
    Route::get('/blog/show/{id}',[BlogController::class,'show']);
    Route::get('/blog/search/{name}',[BlogController::class,'searchblog']);
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy']);

    //Job Category 
    Route::post('/jobcategory',[JobCategoryController::class,'store']);
    Route::get('/jobcategory',[JobCategoryController::class,'index']);

    //JOB 
    Route::get('/jobs',[JobsController::class,'index']);
    Route::post('/job',[JobsController::class,'store']);
    Route::get('/job/search/{name}',[JobsController::class,'searchjobs']);
    Route::delete('/job/delete/{id}',[JobsController::class,'destroy']);
    Route::get('/job/show/{id}',[JobsController::class,'show']);
    Route::put('jobs/update/{id}',[JobsController::class,'update']);

    // Job Apply
    Route::post('/jobapply/{userid}/{jobid}',[ApplyJobController::class,'store']);
    // Route::get('/jobapply',[ApplyJobController::class,'index']);
    Route::get('userapplyjob/list',[ApplyJobController::class,'index']);
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
