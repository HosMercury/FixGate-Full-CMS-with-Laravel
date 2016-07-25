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
    Route::resource('/order', 'OrderController');
    Route::post('/order', 'OrderController@indexByDate');
    Route::resource('/order/{id}/assign', 'OrderAssignmentController');
    Route::resource('/order/{id}/reassign', 'OrderReassignmentController');
    Route::resource('/order/{id}/materials', 'OrderMaterialController');
    Route::resource('/order/{id}/costs', 'OrderCostController');
    Route::resource('/order/{id}/bills', 'OrderBillController');

});


