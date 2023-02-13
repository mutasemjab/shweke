<?php
namespace App\Http\Controllers\Api\v1\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\User\AuthController;
use App\Http\Controllers\Api\v1\User\HomeController;
use App\Http\Controllers\Api\v1\User\OrderController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1/user'], function () {

    //---------------- Auth --------------------//
    Route::post('/register', [AuthController::class,'register']);
    Route::post('/login', [AuthController::class,'login']);

    Route::post('/orders', [OrderController::class,'getOrders']);





    Route::group(['middleware' => ['auth:driver-api']], function () {

        Route::get('/home', [HomeController::class,'index']);

        Route::post('/change_status',[AuthController::class,'changeStatus']);
        //---------------------------- App Data -------------------------//
        //App User Data
        Route::get('/app_data/user', 'Api\v1\User\AppDataController@getAppDataWithUser');



        //---------------------- Setting ----------------------------//
        Route::post('/update_profile', 'Api\v1\User\AuthController@updateProfile');

        //----------------- Courses ------------------------------//

        Route::get('/orders/{driverId}', [OrderController::class,'index']);

        Route::post('orders/{id}/change_status',[OrderController::class,'changeOrderStatus']);




        //------------- For Testing Purpose -----------------------//
        Route::get('/test', 'Api\v1\User\TestController@test');


    });

    Route::get('/maintenance', function () {
        return response(['message' => ['Course is now online']], 200);
    });


});
