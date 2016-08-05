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

    Route::auth();

    Route::get('/', 'OrdersController@index')->middleware('auth');

    Route::group(['middleware'=>'auth','prefix' => 'orders'], function () {
        Route::get('/', 'OrdersController@index');
        Route::post('/', 'OrdersController@indexByDate');
        Route::get('/{order}', 'OrdersController@show');
        Route::post('/{order}', 'OrdersController@update');
        Route::post('/{order}', 'OrdersController@delete');
        Route::post('/{order}/edit', 'OrdersController@edit');
        Route::resource('/{id}/assign', 'OrderAssignmentController');
        Route::resource('/{id}/reassign', 'OrderReassignmentController');
        Route::resource('/{id}/materials', 'OrderMaterialController');
        Route::resource('/{id}/costs', 'OrderCostController');
        Route::resource('/{id}/bills', 'OrderBillController');
    });

});


