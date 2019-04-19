<?php

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
//Route::resources([
//    'users' => 'UsersController',
//]);

Route::get('users', 'UsersController@showAllUsers');
Route::post('users', 'UsersController@addUser');
Route::post('users/{id}', 'UsersController@updateUser');
Route::get('users/{id}', 'UsersController@showUserById');
Route::delete('users/{id}', 'UsersController@deleteUser');

Route::get('carts', 'CartController@showAllCarts');
Route::post('carts', 'CartController@addCart');
Route::post('carts/{id}', 'CartController@updateCart');
Route::get('carts/{id}', 'CartController@showCartById');
Route::delete('carts/{id}', 'CartController@deleteCart');
