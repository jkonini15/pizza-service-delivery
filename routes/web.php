<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/test', function () {
//    return "Welcome to test, routes okay";
//});

    Route::group(['middleware' => 'cors'], function ($router) {
        Route::auth();

        Route::post('/login', 'API\UserController@login');
        Route::get('/logout', 'API\UserController@logout');
        Route::post('/register', 'API\UserController@register');
        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('/details', 'API\UserController@details');
            Route::post('/pizza', 'API\PizzaController@storePizza');//test route for automating pizza insertions
            Route::post('/order','API\OrderController@storeOrders');

        });
        Route::post('/order','API\OrderController@storeOrders');

        Route::get('/orders/{id}','API\OrderController@getUserOrders');
        Route::get('/pizza', 'API\PizzaController@getPizzas');
    });
