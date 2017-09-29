<?php

use Illuminate\Http\Request;
use App\Category;

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

Route::post('/register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth:api'], function() {
	// Route::get('category', 'CategoryController@index');
	// Route::get('category/{id}', 'CategoryController@show');
	// Route::get('category/name/{name}', 'CategoryController@showByName');
	// Route::get('category/subcategory/{id}', 'CategoryController@showSubcategory');
	// Route::post('category', 'CategoryController@store');
	// Route::put('category/{id}', 'CategoryController@update');
	// Route::delete('category/{id}', 'CategoryController@delete');
});

Route::get('category', 'CategoryController@index');
Route::get('category/{category}', 'CategoryController@show');
Route::get('category/name/{name}', 'CategoryController@showByName');
Route::get('category/subcategory/{id}', 'CategoryController@showSubcategory');
Route::post('category', 'CategoryController@store');
Route::put('category/{category}', 'CategoryController@update');
Route::delete('category/{category}', 'CategoryController@delete');
Route::post('/register', 'Auth\RegisterController@register');