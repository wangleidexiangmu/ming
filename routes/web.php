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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//购物车
Route::get('/cart', 'CartController@index');
Route::get('/cart/add/{goods_id?}', 'CartController@add');      //添加至购物车
//订单处理
Route::get('/order/list', 'Order\IndexController@orderList');      //订单列表
Route::get('/order/create', 'Order\IndexController@create');      //生成订单
Route::get('/order/paystatus', 'Order\IndexController@payStatus');      //查询订单支付状态
//微信支付
Route::get('/pay/weixin', 'Weixin\WxPayController@pay');      //微信支付
Route::post('/weixin/pay/notify', 'Weixin\WxPayController@notify');      //微信支付通知回调
//支付

Route::get('/pay/success', 'Weixin\WxPayController@paySuccess');      //微信支付成功
//商品
Route::get('goods', 'Goods\GoodsController@goods');
Route::get('detail', 'Goods\GoodsController@goodsdetail');//商品详情
Route::get('ask', 'Goods\GoodsController@ask');//商品详情
Route::get('remb', 'Goods\GoodsController@remb');//浏览记录
//微信JSSDK
Route::get('/wx/test', 'Weixin\JsController@jstest');      //jssdk测试
Route::get('/getImg', 'Weixin\JsController@getImg');      //获取JSSDK上传的照片
Route::get('test', 'Weixin\JsController@test');      //jssdk测试
//微信
Route::get('weixin/vaild1','Weixin\WeixinController@valid');
//Route::psot('weixin/vaild1','Weixin\WeixinController@valid');
//素材
Route::any('weixin/vaild1','Weixin\WeixinController@wxEvent');
Route::any('jump','Weixin\WeixinController@goods');