<?php

use App\Http\Controllers\API\RelationsController;
use App\Http\Controllers\API\WebsiteController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\Api\SubscribeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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




Route::group(['prefix' => '/'] , function(){
    
    Route::apiResource('/websites' , WebsiteController::class);
    Route::apiResource('/posts' , PostController::class);
    Route::apiResource('/subscribers' , SubscribeController::class);
    Route::get('/websites/{id}/posts' , [RelationsController::class , 'websitePosts']);

});