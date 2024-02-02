<?php

declare(strict_types=1);

namespace App\Admin\Controllers;

use App\Models\Step;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class FormController extends AdminController
{
    public function index(Content $content): Content
    {
        return $content
            ->title('Формы')
            ->breadcrumb(
                [
                    'text' => 'Поля',
                    'url' => route('admin.forms.index')
                ])->body($this->grid());
    }

    protected function grid(): Grid
    {
        $grid = new Grid(new \App\Models\Form());
        $grid->column('name','Название')->display(function (){
            return "<a href=" . route('admin.form.steps.index', ['form' => $this->id]) . ">$this->name</a>";
        });
        $grid->column('created_at', 'Дата создания')->display(function ($date) {
            return Carbon::parse($date)->format('d-m-Y');
        });
        $grid->disableCreateButton(false);
        return $grid;
    }

    protected function form(): Form
    {
        $form = new Form(new \App\Models\Form());
        $form->text('name','Название');
        $form->multipleSelect('steps','Шаги')->options(Step::all()->pluck('name','id'));
        return $form;
    }

    public function create(Content $content): Content
    {
        $content->breadcrumb(
            ['text' => 'Формы', 'url' => route('admin.forms.index')],
            ['text' => 'Создание', 'url' => '/']
        );
        return $content->body($this->form());
    }

    public function edit($id, Content $content): Content
    {
        $form = \App\Models\Form::findOrFail($id);
        $content->breadcrumb(
            ['text' => 'Формы', 'url' => route('admin.forms.index')],
            ['text' => $form->name, 'url' => '/']
        );
        return $content->body($this->form()->edit($id));
    }
}
{

}
