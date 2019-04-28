<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    //商品管理
    $router->resource('goods', GoodsController::class);
    //订单管理
    $router->resource('order', OrderController::class);
    //微信用户管理
    $router->resource('user', UserController::class);
    //素材管理
    $router->resource('sulist', SuController::class);
    //素材添加
    $router->post('add', 'SuController@add')->name('admin.home');
    //消息群发
    $router->resource('all', SendController::class);
    //qunfa
    $router->post('send', 'SendController@send')->name('admin.home');
});
