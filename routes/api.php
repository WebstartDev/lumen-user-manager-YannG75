<?php

$router->get('/api/users', 'Api\ApiController@index');
$router->get('/api/users/{id}', 'Api\ApiController@getUser');
$router->post('/api/users/create', 'Api\ApiController@creating');
$router->put('/api/users/{id}/edit', 'Api\ApiController@update');
$router->delete('/api/users/{id}/destroy', 'Api\ApiController@destroy');
