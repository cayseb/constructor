<?php

use Encore\Admin\Facades\Admin;
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
    $router->resource('fields/{field}/inputs', \App\Admin\Controllers\Fields\InputController::class);
    $router->resource('fields/{field}/radio', \App\Admin\Controllers\Fields\RadioController::class);
    $router->resource('fields/{field}/selects', \App\Admin\Controllers\Fields\SelectController::class);
    $router->resource('fields/{field}/checkboxes', \App\Admin\Controllers\Fields\CheckboxController::class);

});
