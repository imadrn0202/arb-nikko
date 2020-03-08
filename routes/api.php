<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api', ['auth:web','checkAdmin']], function(){
    // Users
    Route::get('users', 'UserController@index');
    
    //Roles
    Route::get('/get/roles', 'RoleController@get')->name('getRoles');
    Route::post('/insert/roles', 'RoleController@insert')->name('insertRoles');
    Route::put('/update/roles', 'RoleController@update')->name('updateRoles');
    Route::delete('/delete/roles', 'RoleController@delete')->name('deleteRoles');

    //User Roles
    Route::get('/get/userroles', 'UserRoleController@get')->name('getUserRoles');
    Route::post('/insert/userroles', 'UserRoleController@insert')->name('insertUserRoles');
    Route::put('/update/userroles', 'UserRoleController@update')->name('updateUserRoles');
    Route::delete('/delete/userroles', 'UserRoleController@delete')->name('deleteRoles');

});

Route::group(['middleware' => 'auth:api', ['auth:web','hasAdminPermission']], function(){
    // Users
    Route::get('users/{id}', 'UserController@show');
});






//public urls
Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');


    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});
