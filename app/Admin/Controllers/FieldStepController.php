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


class FieldStepController extends AdminController
{
    public function index(Content $content): Content
    {
        $step = Step::findOrFail(request()->step);
        return $content
            ->title($step->name)
            ->breadcrumb(
                [
                    'text' => 'Шаги',
                    'url' => route('admin.steps.index')
                ])->body($this->grid());
    }

    protected function grid(): Grid
    {
        $grid = new Grid(new \App\Models\FieldStep());
        $grid->sortable();
        $grid->actions(function ($action) {
            $action->disableEdit();
            $action->disableView();
            $action->disableDelete();
        });
        $grid->model()->where('step_id',request()->step);
        $grid->column('field_id','Название')->display(function (){
            return $this->getModel()->fields->name;
        });
        $grid->column('type','Тип поля')->display(function (){
            return $this->getModel()->fields->type;
        });
        $grid->column('created_at', 'Дата создания')->display(function ($date) {
            return Carbon::parse($date)->format('d-m-Y');
        });
        $grid->disableCreateButton(false);
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
