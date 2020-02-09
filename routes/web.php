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
// generat app key
$router->get('/key',function(){
    return str_random(32);
});


// routing group
// $router->group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => ''],function() use ($router){
//     $router->get('home', function(){
//         return 'Home Admin';
//     });
//     $router->get('profile', function(){
//         return 'Profile Admin';
//     });
// });

// $router->get('/admin/home',['middleware' => 'age',function (){
//     return 'Old Enough';
// }] );

// $router->get('/fail', function(){
//     return 'Not yet mature';
// });

// $router->get('/example','ExampleController@index');
// $router->get('/tanpa','ExampleController@tanpa');


//Auth 
$router->post('/register','AuthController@register');
$router->post('/login','AuthController@login');
$router->get('/user/{id}','UserController@show');
$router->post('/user/update','UserController@update');


// Articles

$router->get('/articles', 'ArticlesController@list');
$router->post('/articles/create', 'ArticlesController@create',['middleware','auth']);
