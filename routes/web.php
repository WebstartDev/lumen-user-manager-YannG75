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

$router->get('/users', 'UserController@index');
$router->get('/users/create', 'UserController@create');
$router->post('/users/create', 'UserController@creating');
$router->get('/users/{id}', 'UserController@getUser');
$router->get('/users/{id}/edit', 'UserController@getUser');
$router->put('/users/{id}/edit', 'UserController@update');
$router->delete('/users/{id}/destroy', 'UserController@destroy');



