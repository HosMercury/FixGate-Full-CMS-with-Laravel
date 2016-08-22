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

//    Route::get('test', function(){
//        $t = \DB::table('orders')->whereTrade('dolor')->get();
//        dd($t);
////        $manageHouse = new App\Permission;
////        $manageHouse->name = 'manage_house';
////        $manageHouse->save();
////
////        $role = App\Role::whereName('manager')->first();
////        $role->givePermissionTo($manageHouse);
////
////        dd($role = App\Role::whereName('manager')->first());
//////        $user = App\User::first();
//////        $role = App\Role::first();
//////        dd($role->users[0]);
//        return view('welcome');
//    });

    Route::group(['prefix'=>'auth'],function(){
        Route::auth();
    });

    Route::group(['middleware'=>'auth'],function(){
        Route::get('/', 'OrderController@index');
        Route::resource('/orders', 'OrderController');
        Route::resource('/locations', 'LocationController');
        Route::resource('/types', 'TypeController');
        Route::resource('/materials', 'MaterialController');
        Route::resource('/workers', 'WorkerController');
    });

    Route::group(['prefix' => 'orders','middleware'=>'auth'], function () {
        Route::post('/dates', 'OrderController@dates');

        Route::resource('/{id}/assign', 'OrderAssignmentController');
        Route::resource('/{id}/reassign', 'OrderReassignmentController');

        Route::resource('/{id}/materials', 'OrderMaterialController');
        Route::resource('/{id}/costs', 'OrderCostController');
        Route::resource('/{id}/bills', 'OrderBillController');
    });

});


