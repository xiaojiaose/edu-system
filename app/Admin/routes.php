<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('edu/students', 'StudentController');
    $router->resource('edu/schools', 'SchoolController');
    $router->resource('edu/users', 'UserController');
    $router->resource('edu/teachers', 'TeacherController');
});
