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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('user/profile','Api\UserController@profile');
Route::put('user/profile','Api\UserController@updateProfile');
Route::apiResource('user','Api\UserController');
Route::apiResource('menu','Api\MenuController');
Route::apiResource('permission','Api\PermissionController');
Route::apiResource('role','Api\RoleController');
