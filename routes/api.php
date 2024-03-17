<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\Brands;
use App\Models\Order;

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
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::controller(BrandsController::class)->group(function(){

Route::get('index','index');
Route::get('show/{id}','show');
Route::post('store','store');
Route::put('update_brand/{id}','update_brand');
Route::delete('delete_brand/{id}','delete');

});

// Route::prefix('user')->name('user.')->group(function(){
//      Route::resource('category', CategoryController::class);
// //     Route::resource('option', OptionController::class)->except(['show']);
//  });

Route::controller(CategoryController::class)->group(function(){

    Route::get('index','index');
    Route::get('show/{id}','show');
    Route::post('store','store');
    Route::put('update/{id}','update');
    Route::delete('delete/{id}','delete');

    });

    Route::controller(ProductController::class)->group(function(){
        Route::get('index','index');
        Route::get('show/{id}','show');
        Route::post('store','store');
        Route::put('update/{id}','update');
        Route::delete('destroy/{id}','destroy');
        });

Route::controller(OrderController::class)->group(function(){
    Route::get('index','index');
    Route::get('show/{id}','show');
    Route::post('store','store');
    Route::get('get_order_items/{id}','get_order_items');
    Route::get('get_user_order/{id}','get_user_order');
    Route::post('change_order_status/{id}','change_order_status');
});
