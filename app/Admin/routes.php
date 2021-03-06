<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('categories', CategoryController::class);
    $router->resource('bills', BillController::class);
    $router->resource('billCharts', BillChartController::class);
    $router->resource('monthGrapths', MonthGrapth::class);

    $router->get('myIndex', 'MyIndexController@index');


    $router->resource('requirejs', RequireJsController::class);
    $router->resource('orders', OrderController::class);

});
