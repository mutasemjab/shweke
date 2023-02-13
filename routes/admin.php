<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\OrderController;




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

define('PAGINATION_COUNT',11);

 Route::group(['prefix'=>'admin','middleware'=>'auth:admin'],function(){
 Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard');
 Route::get('logout',[LoginController::class,'logout'])->name('admin.logout');



/*         start  customer                */
Route::get('/driver/index',[DriverController::class,'index'])->name('admin.driver.index');
Route::get('/driver/create',[DriverController::class,'create'])->name('admin.driver.create');
Route::post('/driver/store',[DriverController::class,'store'])->name('admin.driver.store');
Route::get('/driver/edit/{id}',[DriverController::class,'edit'])->name('admin.driver.edit');
Route::post('/driver/update/{id}',[DriverController::class,'update'])->name('admin.driver.update');
Route::get('/driver/delete/{id}',[DriverController::class,'delete'])->name('admin.driver.delete');
Route::post('/driver/ajax_search',[DriverController::class,'ajax_search'])->name('admin.driver.ajax_search');


/*           end customer                */






/*           start code                */
Route::get('/order/index',[OrderController::class,'index'])->name('admin.order.index');
Route::get('/order/create',[OrderController::class,'create'])->name('admin.order.create');
Route::post('/order/store',[OrderController::class,'store'])->name('admin.order.store');
Route::get('/order/edit/{id}',[OrderController::class,'edit'])->name('admin.order.edit');
Route::post('/order/update/{id}',[OrderController::class,'update'])->name('admin.order.update');
Route::get('/order/delete/{id}',[OrderController::class,'delete'])->name('admin.order.delete');
/*           end code                */

});




Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>'guest:admin'],function(){
Route::get('login',[LoginController::class,'show_login_view'])->name('admin.showlogin');
Route::post('login',[LoginController::class,'login'])->name('admin.login');

});







