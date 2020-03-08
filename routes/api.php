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
    Route::delete('/delete/userroles', 'UserRoleController@delete')->name('deleteUserRoles');

    //expense category
    Route::get('/get/expensecategory', 'ExpenseCategoryController@get')->name('getExpenseCategory');
    Route::post('/insert/expensecategory', 'ExpenseCategoryController@insert')->name('insertExpenseCategory');
    Route::put('/update/expensecategory', 'ExpenseCategoryController@update')->name('updateExpenseCategory');
    Route::delete('/delete/expensecategory', 'ExpenseCategoryController@delete')->name('deleteExpenseCategory');

  

});

Route::group(['middleware' => 'auth:api', ['auth:web','hasAdminPermission']], function(){
    
    //expense category
    Route::get('/get/expense/', 'ExpenseController@get')->name('getExpense');
    Route::get('/show/expense/{id}', 'ExpenseController@show')->name('showExpense');
    Route::post('/insert/expense', 'ExpenseController@insert')->name('insertExpense');
    Route::put('/update/expense', 'ExpenseController@update')->name('updateExpense');
    Route::delete('/delete/expense', 'ExpenseController@delete')->name('deleteExpense');


    Route::get('users/{id}', 'UserController@show');
});






//public urls
Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');


    Route::group(['middleware' => 'auth:api'], function(){
        Route::put('changepassword', 'UserController@changePassword');
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});
