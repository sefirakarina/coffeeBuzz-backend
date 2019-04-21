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
    Route::get('foods', 'FoodController@showAllFoods');
    Route::get('drinks', 'DrinkController@showAllDrinks');
});

Route::get('users', 'UsersController@showAllUsers');
Route::post('users', 'UsersController@addUser');
Route::post('users/{id}', 'UsersController@updateUser');
Route::get('users/{id}', 'UsersController@showUserById');
Route::delete('users/{id}', 'UsersController@deleteUser');

Route::resource('carts', 'CartController')/*->except(['index'])*/;

Route::get('foods', 'FoodController@showAllFoods');
Route::post('foods', 'FoodController@addFood');
Route::post('foods/{id}', 'FoodController@updateFood');
Route::get('foods/{id}', 'FoodController@showFoodById');
Route::delete('foods/{id}', 'FoodController@deleteFood');

Route::get('drinks', 'DrinkController@showAllDrinks');
Route::post('drinks', 'DrinkController@addDrink');
Route::post('drinks/{id}', 'DrinkController@updateDrink');
Route::get('drinks/{id}', 'DrinkController@showDrinkById');
Route::delete('drinks/{id}', 'DrinkController@deleteDrink');

Route::get('items', 'ItemController@showAllItems');
Route::post('items', 'ItemController@addItem');
Route::post('items/{id}', 'ItemController@updateItem');
Route::get('items/{id}', 'ItemController@showItemById');
Route::delete('items/{id}', 'ItemController@deleteItem');

Route::get('ordered_items', 'OrderedItemController@showAllOrderedItems');
Route::post('ordered_items', 'OrderedItemController@addOrderedItem');
Route::post('ordered_items/{id}', 'OrderedItemController@updateOrderedItem');
Route::get('ordered_items/{id}', 'OrderedItemController@showOrderedItemById');
Route::delete('ordered_items/{id}', 'OrderedItemController@deleteOrderedItem');

Route::get('order_lists', 'OrderListController@showAllOrderLists');
Route::post('order_lists', 'OrderListController@addOrderList');
Route::post('order_lists/{id}', 'OrderListController@updateOrderList');
Route::get('order_lists/{id}', 'OrderListController@showOrderListById');
Route::delete('order_lists/{id}', 'OrderListController@deleteOrderList');