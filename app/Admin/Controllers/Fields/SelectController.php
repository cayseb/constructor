<?php

declare(strict_types=1);

namespace App\Admin\Controllers\Fields;

use App\Models\Select;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class SelectController extends AdminController
{
    public function index(Content $content): Content
    {
        return $content
            ->title('Селект')
            ->body($this->grid());
    }

    protected function grid(): Grid
    {
        $grid = new Grid(new \App\Models\Input());
        $grid->column('system_name','Название');
        $grid->column('created_at', 'Дата создания')->display(function ($date) {
            return Carbon::parse($date)->format('d-m-Y');
        });
        $grid->disableCreateButton(false);
        return $grid;
    }

    protected function form(): Form
    {
        $form = new Form(new Select());
        $form->text('system_name','Системное название');
        $form->text('name','Название');
        $form->switch('multi','Мультиселект');
        $form->hasMany('options', 'Варианты',function (Form\NestedForm $form) {
            $form->text('name', 'Опция');
        });
        return $form;
    }

    public function create(Content $content): Content
    {
        $content->breadcrumb(
            ['text' => 'Селекты', 'url' => route('admin.selects.index')],
            ['text' => 'Создание', 'url' => '/']
        );
        return $content->body($this->form());
    }

    public function edit($id, Content $content): Content
    {
        $select = Select::findOrFail($id);
        $content->breadcrumb(
            ['text' => 'Селекты', 'url' => route('admin.selects.index')],
            ['text' => $select->system_name, 'url' => '/']
        );
        return $content->body($this->form()->edit($id));
    }
}
{

}
