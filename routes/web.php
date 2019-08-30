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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'v1'], function () use ($router) {
    // User account.
    $router->post('/account/register', 'UserRegisterController@register');
    $router->post('/account/verify', ['middleware' => 'UserVerify', 'uses' => 'UserRegisterController@verifyAccount']);
    $router->post('/account/forgot', ['middleware' => 'UserForgot', 'uses' => 'UserRegisterController@forgotAccount']);
    $router->post('/account/reset', ['middleware' => 'UserResetPassword', 'uses' => 'UserRegisterController@resetAccount']);

    // Authentication.
    $router->post('/authorize', 'AuthController@login');

    $router->group(['middleware' => 'auth'], function ($router) {
        // User profile.
        $router->get('/account/profile', 'UserProfileController@showProfile');
        $router->put('/account/profile', 'UserProfileController@updateProfile');
        $router->put('/account/password', 'UserProfileController@updatePassword');

        // Orders
        $router->get('/order', 'OrderController@getOrders');
        $router->get('/order/{order}', ['middleware' => 'UserOrder', 'uses' => 'OrderController@getSingleOrder']);
    });
});