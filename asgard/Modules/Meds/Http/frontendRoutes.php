<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->group(['priority' => -10], function (Router $router) {
//    $locale = LaravelLocalization::setLocale() ?: App::getLocale();
	$router->get('/', ['as' => 'public.home', 'uses' => 'PublicController@index']);
	$router->get('/anunt', ['as' => 'public.cerere', 'uses' => 'PublicController@newRequest']);
	$router->post('/anunt', ['as' => 'public.cerere.post', 'uses' => 'PublicController@postRequest']);

	$router->get('/neeligibil', ['as' => 'public.respinse', 'uses' => 'PublicController@falseReports']);
	
	$router->get('/test-mail', ['as' => 'public.test1', 'uses' => 'PublicController@test1']);
});

