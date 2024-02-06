<?php

use App\Admin\Controllers\FieldOptions\CheckboxOptionController;
use App\Admin\Controllers\FieldOptions\RadioOptionController;
use App\Admin\Controllers\FieldOptions\SelectOptionController;
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
    $router->resource('forms/{form}/step', \App\Admin\Controllers\FormStepController::class,['as'=>'form']);
    $router->resource('steps', \App\Admin\Controllers\StepController::class);
    $router->resource('steps/{step}/fields', \App\Admin\Controllers\FieldStepController::class,['as'=>'step']);
    $router->resource('form/{form}/steps', \App\Admin\Controllers\FormStepController::class,['as' => 'form']);
    $router->resource('inputs', \App\Admin\Controllers\Fields\InputController::class);
    $router->resource('inputs', \App\Admin\Controllers\Fields\InputController::class);
    $router->resource('radios', \App\Admin\Controllers\Fields\RadioController::class);
    $router->resource('selects', \App\Admin\Controllers\Fields\SelectController::class);
    $router->resource('checkboxes', \App\Admin\Controllers\Fields\CheckboxController::class);
    $router->resource('radios/{radio}/options', RadioOptionController::class);
    $router->resource('selects/{select}/options', SelectOptionController::class);
    $router->resource('checkboxes/{checkbox}/options', CheckboxOptionController::class);

});
