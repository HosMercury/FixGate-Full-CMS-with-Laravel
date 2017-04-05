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
            Route::patch('/{order}', 'OrderController@update');
            Route::delete('/{order}', 'OrderController@destroy');
            Route::get('/{location}/{number}/edit', 'OrderController@edit');
            Route::get('/data', 'OrderController@data');
            Route::post('/{order}/close', 'OrderController@close');

            // Assignments ...
            Route::post('/{location}/{number}/assignments', 'OrderAssignmentController@store');
            Route::post('/{location}/{number}/assignments/vendor', 'OrderAssignmentController@vendor');
            Route::patch('/{location}/{number}/assignments/{assignment}', 'OrderAssignmentController@update');
            Route::delete('/{location}/{number}/assignments/{assignment}', 'OrderAssignmentController@destroy');
            Route::delete('/{location}/{number}/assignments/{assignment}/all', 'OrderAssignmentController@destroyAll');

            //Materials & Costs ...
            Route::post('/{location}/{number}/materials','OrderMaterialController@store');
            Route::delete('/{location}/{number}/materials','OrderMaterialController@destroy');
            Route::post('/{location}/{number}/costs','OrderCostController@store');
            Route::delete('/{location}/{number}/costs','OrderCostController@destroy');
            Route::post('/{location}/{number}/bills', 'OrderBillController@store');
            Route::delete('/{location}/{number}/bills', 'OrderBillController@destroy');
        });

        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UserController@index');
            Route::get('/data', 'UserController@data');
            Route::get('/{employee}', 'UserController@show');
            Route::patch('/{employee}', 'UserController@update');
            Route::delete('/{employee}', 'UserController@destroy');           
            Route::post('/{employee}/roles', 'UserController@assignRole');
        });

        Route::group(['prefix' => 'locations'], function () {
            Route::get('/', 'LocationController@index');
            Route::post('/', 'LocationController@store');
            Route::get('/create', 'LocationController@create');
            Route::get('/data', 'LocationController@data');
            Route::get('/{location}', 'LocationController@show');
            Route::patch('/{location}', 'LocationController@update');
            Route::get('/{location}/edit', 'LocationController@edit');
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
            Route::get('/create', 'TypeController@create');
            Route::get('/{type}/edit', 'TypeController@edit');
            Route::patch('/{type}', 'TypeController@update');
            Route::delete('/{type}', 'TypeController@destroy');
            Route::get('/data', 'TypeController@data');
            Route::get('/{type}', 'TypeController@show');

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

//problem edit location type and others that unique give error ..

// location edit manager field have to be removed

