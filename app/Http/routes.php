<?php
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::group(['prefix'=>'auth'],function(){
        Route::auth();
    });

    Route::group(['middleware'=>'auth'],function(){
        Route::get('/', 'OrderController@index');
        Route::resource('/orders', 'OrderController');
        Route::resource('/locations', 'LocationController');
        Route::resource('/types', 'TypeController');
        Route::resource('/materials', 'MaterialController');
        Route::resource('/users/workers', 'WorkerController');

        Route::resource('/users', 'UserController');
        Route::post('/users/{user}/roles', 'UserController@assignRole');
        Route::delete('/users/{user}/roles/{role}', 'UserController@deleteRole');

        Route::post('/roles/{role}/permissions', 'RoleController@assignPermission');
        Route::delete('/roles/{role}/permissions/{permission}', 'RoleController@deletePermission');

        Route::resource('/roles', 'RoleController');
        Route::resource('/permissions', 'PermissionController');
    });

    Route::group(['prefix' => 'orders','middleware'=>'auth'], function () {
        Route::get('/filter', 'OrderController@index');
        Route::post('/filter', 'OrderController@filter');

        Route::resource('/{id}/assign', 'OrderAssignmentController');
        Route::resource('/{id}/reassign', 'OrderReassignmentController');

        Route::resource('/{id}/materials', 'OrderMaterialController');
        Route::resource('/{id}/costs', 'OrderCostController');
        Route::resource('/{id}/bills', 'OrderBillController');
    });

});


