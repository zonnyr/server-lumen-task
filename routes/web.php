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

// API route group
$router->group(['prefix' => 'api'], function () use ($router) {

    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
    $router->post('logout', 'AuthController@logout');

    $router->get('profile', 'UserController@profile');
    $router->get('users/{id}', 'UserController@singleUser');
    $router->get('users', 'UserController@allUsers');

    $router->post('createProject', 'ProjectController@createProject');
    $router->get('getProject', 'ProjectController@getProject');
    $router->post('updateProject/{id}', 'ProjectController@updateProject');
    $router->post('deleteProject/{id}', 'ProjectController@deleteProject');
    $router->post('getSearchProject', 'ProjectController@getSearchProject');

    $router->post('createTask/{id}', 'TaskController@createTask');
    $router->post('getTask/{id}', 'TaskController@getTask');
    $router->post('updateTask/{id}', 'TaskController@updateTask');
    $router->post('deleteTask/{id}', 'TaskController@deleteTask');
    $router->post('getSearchTask/{id}', 'TaskController@getSearchTask');

});
