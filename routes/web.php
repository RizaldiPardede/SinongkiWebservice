<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix'=>'user'], function () use ($router) {
    $router->post('/',['uses'=>'userController@create_user']);
    $router->get('/',['uses'=>'userController@getUserByEmail']);
    $router->post('/updatenama',['uses'=>'userController@updatenama']);
    $router->post('/updatepassword',['uses'=>'userController@updatepassword']);
    $router->post('/updateemail',['uses'=>'userController@updateemail']);
    $router->post('/login',['uses'=>'userController@login']);
    
});

$router->group(['prefix'=>'admin'], function () use ($router) {
    $router->post('/',['uses'=>'adminController@create_user']);
    $router->get('/',['uses'=>'adminController@getUserByEmail']);
    $router->post('/updatenama',['uses'=>'adminController@updatenama']);
    $router->post('/updatepassword',['uses'=>'adminController@updatepassword']);
    $router->post('/updateemail',['uses'=>'adminController@updateemail']);
    $router->post('/login',['uses'=>'adminController@login']);
    
});

$router->group(['prefix'=>'menu'], function () use ($router) {
    $router->get('/{id_menu}',['uses'=>'menuController@getmenubyid']);
    $router->post('/createmenu',['uses'=>'menuController@create_menu']);
    $router->post('/updatemenu',['uses'=>'menuController@updatemenu']);
    $router->delete('/deletemenu',['uses'=>'menuController@deletemenu']);
    $router->get('/',['uses'=>'menuController@getallmenu']);
    
    
});

$router->group(['prefix'=>'pemesanan'],function() use ($router) {
    $router->post('/pesan',['uses'=>'pemesananController@tambahmenu']);
    $router->post('/createantrian',['uses'=>'pemesananController@createantrian']);
    $router->post('/lepasmenu',['uses'=>'pemesananController@hapusmenu']);
    $router->delete('/deletepemesanan',['uses'=>'pemesananController@hapuspemesanan']); 
    $router->get('/',['uses'=>'pemesananController@getallpesanan']);
    $router->post('/',['uses'=>'pemesananController@getpesananuser']);

   
});