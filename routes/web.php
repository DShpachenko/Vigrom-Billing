<?php

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

$router->group(['namespace' => 'Billing', 'prefix' => 'billing'], static function ($router) {

    $router->group(['prefix' => 'balance'], static function ($router) {

        $router->get('show', 'BalanceController@show');

        $router->post('update', 'BalanceController@update');

    });

});
