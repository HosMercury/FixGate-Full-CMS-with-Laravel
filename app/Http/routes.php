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

Route::get('test', function () {
    dd(Carbon\Carbon::createFromFormat('Y-m-d', '1017-02-31')->toDateTimeString());
    return view('test');
});

Route::get('test2', function () {
    return \App\User::all();
});

Route::post('test2', function () {
    if (Request::ajax()) {
        $data = Request::all();
        return $data;
    }
});

Route::group(['middleware' => ['web']], function () {

    //Auth routes
    Route::group(['prefix' => 'auth'], function () {
        Route::auth();
    });

    Route::group(['middleware' => 'auth'], function () {

        Route::get('/', 'OrderController@index');
        //Ajax
        Route::get('/orders/data', 'OrderController@data');
        Route::post('/orders/{order}/close', 'OrderController@close');
        Route::get('/materials/data', 'MaterialController@data');
        Route::get('/types/data', 'TypeController@data');
        Route::get('/locations/data', 'LocationController@data');
        Route::get('/users/data', 'UserController@data');
        Route::get('/roles/data', 'RoleController@data');
        Route::get('/permissions/data', 'PermissionController@data');


        //Resources
        Route::get('orders', 'OrderController@index');
        Route::post('orders', 'OrderController@store');
        Route::get('orders/create', 'OrderController@create');
        Route::get('orders/{location}/{number}', 'OrderController@show');

        Route::resource('locations', 'LocationController');
        Route::resource('types', 'TypeController');
        Route::resource('materials', 'MaterialController');

        //Financial
        Route::get('/financial/costs/data', 'FinancialCostsController@data');
        Route::get('/financial/materials/data2', 'FinancialCostsController@data2');
        Route::get('/financial', 'FinancialCostsController@index');
        Route::get('/financial/orders/{order}/costs', 'FinancialCostsController@showCost');
        Route::get('/financial/orders/{order}/costs', 'FinancialCostsController@showCost');
        Route::get('/financial/{id}/material/{material}/order/{order}', 'FinancialCostsController@showMaterial');

        Route::resource('/users/workers', 'WorkerController');
        Route::resource('/users', 'UserController');
        Route::post('/users/{user}/roles', 'UserController@assignRole');
        Route::delete('/users/{user}/roles/{role}', 'UserController@deleteRole');

        Route::post('/roles/{role}/permissions', 'RoleController@assignPermission');
        Route::delete('/roles/{role}/permissions/{permission}', 'RoleController@deletePermission');
        Route::resource('/roles', 'RoleController');

        Route::resource('/permissions', 'PermissionController');
        Route::get('permissions','PermissionController@assign');
        Route::post('permissions','PermissionController@storeassign');
    });

    Route::group(['prefix' => 'orders', 'midleware' => 'auth'], function () {
        //try combine these
        Route::post('/{order}/assignments/', 'OrderAssignmentController@store');
        Route::patch('/{order}/assignments/{assignment}/', 'OrderAssignmentController@update');
        Route::delete('/{order}/assignments/{assignment}/workers/{user}/delete/', 'OrderAssignmentController@destroy');
        Route::delete('/{order}/assignments/{assignment}/delete/', 'OrderAssignmentController@destroy');

        Route::resource('/{order}/materials', 'OrderMaterialController');
        Route::resource('/{order}/costs', 'OrderCostController');
        Route::resource('/{order}/bills', 'OrderBillController');

    });
});


