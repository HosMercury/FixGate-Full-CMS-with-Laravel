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

//Route::group(['middleware' => ['web']], function () {
//
//    Route::group(['prefix' => 'auth'], function () { --ok
//        Route::auth(); --ok
//    }); --ok
//
//    Route::group(['middleware' => 'auth'], function () {
//
//        Route::get('/', 'OrderController@index'); --ok
//        //Ajax
//        Route::get('/orders/data', 'OrderController@data'); --ok
//        Route::post('/orders/{order}/close', 'OrderController@close'); --ok
//        Route::get('/materials/data', 'MaterialController@data');
//        Route::get('/types/data', 'TypeController@data');
//        Route::get('/locations/data', 'LocationController@data');
//        Route::get('/users/data', 'UserController@data');
//        Route::get('/roles/data', 'RoleController@data'); --ok
//        Route::get('/permissions/data', 'PermissionController@data'); -- No Need
//
//
//        //Resources
////        Route::get('orders', 'OrderController@index'); --ok
//        // Orders
//
//        Route::post('orders', 'OrderController@store'); --ok
//        Route::get('orders/create', 'OrderController@create'); --ok
//        Route::get('orders/{location}/{number}', 'OrderController@show'); --ok
//
//        Route::resource('locations', 'LocationController'); --part
//        Route::resource('types', 'TypeController');
//        Route::resource('materials', 'MaterialController'); --part
//
//        //Financial
//        Route::get('/financial/costs/data', 'FinancialCostsController@data'); --ok
//        Route::get('/financial/materials/data2', 'FinancialCostsController@data2'); --ok
//        Route::get('/financial', 'FinancialCostsController@index'); --ok
//        Route::get('/financial/orders/{order}/costs', 'FinancialCostsController@showCost'); --ok
//        Route::get('/financial/orders/{order}/costs', 'FinancialCostsController@showCost'); --ok
//        Route::get('/financial/{id}/material/{material}/order/{order}', 'FinancialCostsController@showMaterial'); --ok
//
//        Route::resource('/users/workers', 'WorkerController');
//        Route::resource('/users', 'UserController'); -- part
//        Route::post('/users/{user}/roles', 'UserController@assignRole');
//        Route::delete('/users/{user}/roles/{role}', 'UserController@deleteRole');
//
//        Route::post('/roles/{role}/permissions', 'RoleController@assignPermission');
//        Route::delete('/roles/{role}/permissions/{permission}', 'RoleController@deletePermission');
//        Route::resource('/roles', 'RoleController');
//
//        Route::resource('/permissions', 'PermissionController'); --No Need i think
//        Route::get('permissions', 'PermissionController@assign'); -- No Need
//        Route::post('role/{role}/permissions', 'PermissionController@assign');//ok
//    });
//
//    Route::group(['prefix' => 'orders', 'midleware' => 'auth'], function () {
//        //try combine these
//        Route::post('/{order}/assignments/', 'OrderAssignmentController@store'); --ok
//        Route::patch('/{order}/assignments/{assignment}/', 'OrderAssignmentController@update'); --ok
//        Route::delete('/{order}/assignments/{assignment}/workers/{user}/delete/', 'OrderAssignmentController@destroy'); --ok
//        Route::delete('/{order}/assignments/{assignment}/delete/', 'OrderAssignmentController@destroy'); --ok
//
//        Route::resource('/{order}/materials', 'OrderMaterialController');
//        Route::resource('/{order}/costs', 'OrderCostController');
//        Route::resource('/{order}/bills', 'OrderBillController');
//
//    });
//});


Route::group(['middleware' => ['web']], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::auth();
    });

    Route::group(['middleware' => 'auth'], function () {

        Route::get('/', 'ordercontroller@index');

        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', 'ordercontroller@index');
            Route::post('/', 'OrderController@store');
            Route::get('/create', 'OrderController@create');
            Route::get('/{location}/{number}', 'OrderController@show');
            Route::get('/data', 'OrderController@data');
            Route::post('/{order}/close', 'OrderController@close');
            Route::post('/{order}/assignments', 'OrderAssignmentController@store');
            Route::patch('/{order}/assignments/{assignment}', 'OrderAssignmentController@update');
            Route::delete('/{order}/assignments/{assignment}/workers/{user}/delete', 'OrderAssignmentController@destroy');
            Route::delete('/{order}/assignments/{assignment}/delete', 'OrderAssignmentController@destroy');
        });

        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UserController@index');
            Route::get('/data', 'UserController@data');
            Route::get('/roles', 'RoleController@index');
            Route::get('/roles/{role}', 'RoleController@show');
            Route::get('/roles/data', 'RoleController@data');
            Route::get('/roles/create', 'RoleController@create');
        });

        Route::group(['prefix' => 'locations'], function () {
            Route::get('/', 'LocationController@index');
            Route::post('/', 'LocationController@store');
            Route::get('/{location}', 'LocationController@show');
            Route::get('/create', 'LocationController@create');
            Route::get('/data', 'LocationController@data');
        });

        Route::group(['prefix' => 'materials'], function () {
            Route::get('/', 'MaterialController@index');
            Route::post('/', 'MaterialController@store');
            Route::get('/{material}', 'MaterialController@show');
            Route::get('/create', 'MaterialController@create');
            Route::get('/data', 'MaterialController@data');
        });

        Route::group(['prefix' => 'types'], function () {
            Route::get('/', 'TypeController@index');
            Route::post('/', 'TypeController@store');
            Route::get('/{type}', 'TypeController@show');
            Route::get('/create', 'TypeController@create');
            Route::get('/data', 'TypeController@data');
        });

        Route::group(['prefix' => 'financial'], function () {
            Route::get('/', 'FinancialController@index');
            Route::get('/costs/data', 'FinancialController@data');
            Route::get('/materials/data2', 'FinancialController@data2');
            Route::get('/orders/{order}/costs', 'FinancialController@showCost');
            Route::get('/orders/{order}/costs', 'FinancialController@showCost');
            Route::get('/{id}/material/{material}/order/{order}', 'FinancialController@showMaterial');
        });

    });

});

// location edit manager field have to be removed

