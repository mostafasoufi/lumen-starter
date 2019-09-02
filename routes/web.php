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
    $router->post('/user/register', 'UserRegisterController@register');
    $router->post('/user/verify', 'UserVerifyController@verify');
    $router->post('/user/forgot', 'UserForgotController@forgot');
    $router->post('/user/reset', 'UserResetPasswordController@reset');

    // Authentication.
    $router->post('/authorize', 'AuthController@login');

    $router->group(['middleware' => 'auth'], function ($router) {
        // User profile.
        $router->get('/user/profile', 'UserProfileController@showProfile');
        $router->put('/user/profile', 'UserProfileController@updateProfile');
        $router->put('/user/password', 'UserProfileController@updatePassword');

        // Orders
        $router->get('/order', 'OrderController@getOrders');
        $router->get('/order/{order}', ['middleware' => 'UserOrder', 'uses' => 'OrderController@getSingleOrder']);
    });
});