<?php

use Illuminate\Http\Request;

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

    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::get('foods', 'FoodController@index');
    Route::get('drinks', 'DrinkController@index');
});

// Do not erase
Route::middleware('auth:api')->get('/user', function (Request $request) {
    $user = json_decode($request->user(), true);
    if ($user["role"] == "Manager"){
        return $request->user();
    }
    elseif($user["role"] == "Barista"){
        return null;
    }
    else {
        return null;
    }
});

Route::resource('carts', 'CartController')/*->except(['index'])*/;
Route::patch('admin', 'UsersController@adminUpdateUser');
Route::resource('foods', 'FoodController');
Route::resource('drinks', 'DrinkController');
Route::resource('items', 'ItemController');
Route::resource('ordered_items', 'OrderedItemController');
Route::resource('order_lists', 'OrderListController');
Route::resource('users', 'UsersController');