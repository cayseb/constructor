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
    $router->resource('fields', \App\Admin\Controllers\FieldController::class);
    $router->resource('forms', \App\Admin\Controllers\FormController::class);
    $router->resource('steps', \App\Admin\Controllers\StepController::class);

});
