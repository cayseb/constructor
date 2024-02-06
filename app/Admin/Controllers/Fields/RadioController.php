<?php

declare(strict_types=1);

namespace App\Admin\Controllers\Fields;

use App\Models\Radio;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class RadioController extends AdminController
{
    public function index(Content $content): Content
    {
        return $content
            ->title('Радио')
            ->breadcrumb(
                [
                    'text' => 'Радио',
                    'url' => route('admin.radios.index')
                ])->body($this->grid());
    }

    protected function grid(): Grid
    {
        $grid = new Grid(new \App\Models\Radio());
        $grid->column('system_name','Название');
        $grid->column('created_at', 'Дата создания')->display(function ($date) {
            return Carbon::parse($date)->format('d-m-Y');
        });
        $grid->disableCreateButton(false);
        return $grid;
    }

    protected function form(): Form
    {
        $form = new Form(new Radio());
        $form->text('system_name','Системное название');
        $form->text('name','Название');
        $form->hasMany('options', 'Варианты',function (Form\NestedForm $form) {
            $form->text('name', 'Опция');
            $form->switch('checked', 'Выбрано по умолчанию');
        });
        return $form;
    }

    public function create(Content $content): Content
    {
        $content->breadcrumb(
            ['text' => 'Радио', 'url' => route('admin.radios.index')],
            ['text' => 'Создание', 'url' => '/']
        );
        return $content->body($this->form());
    }

    public function edit($id, Content $content): Content
    {
        $radio = Radio::findOrFail($id);
        $content->breadcrumb(
            ['text' => 'Радио', 'url' => route('admin.radios.index')],
            ['text' => $radio->system_name, 'url' => '/']
        );
        return $content->body($this->form()->edit($id));
    }
}
{

}
