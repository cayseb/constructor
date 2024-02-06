<?php

declare(strict_types=1);

namespace App\Admin\Controllers;

use App\Models\Checkbox;
use App\Models\Input;
use App\Models\Step;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;


class FormStepController extends AdminController
{
    public function index(Content $content): Content
    {
        $form = \App\Models\Form::findOrFail(request()->form);
        return $content
            ->title($form->name)
            ->breadcrumb(
                [
                    'text' => 'Шаги',
                    'url' => route('admin.steps.index')
                ])->body($this->grid());
    }

    protected function grid(): Grid
    {
        $grid = new Grid(new \App\Models\FormStep());
        $grid->sortable();
        $grid->actions(function ($action) {
            $action->disableEdit();
            $action->disableView();
            $action->disableDelete();
        });
        $grid->model()->where('form_id',request()->form);
        $grid->column('step_id','Название')
            ->display(fn ():string => $this->steps->name);

        return $grid;
    }

    protected function form(): Form
    {
        $form = new Form(new Step());
        $form->text('name','Название');
        $form->multipleSelect('inputs','inputs')->options(Input::pluck('system_name','id')->toArray());
        $form->multipleSelect('checkboxes','inputs')->options(Checkbox::pluck('system_name','id')->toArray());
        return $form;
    }

    public function create(Content $content): Content
    {
        $content->breadcrumb(
            ['text' => 'Шаги', 'url' => route('admin.steps.index')],
            ['text' => 'Создание', 'url' => '/']
        );
        return $content->body($this->form());
    }

    public function edit($id, Content $content): Content
    {
        $step = Step::findOrFail($id);
        $content->breadcrumb(
            ['text' => 'Поля', 'url' => route('admin.steps.index')],
            ['text' => $step->name, 'url' => '/']
        );
        return $content->body($this->form()->edit($id));
    }
}
{

}
