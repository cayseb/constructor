<?php

declare(strict_types=1);

namespace App\Admin\Controllers\Fields;

use App\Models\Checkbox;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class CheckboxController extends AdminController
{
    public function index(Content $content): Content
    {
        return $content
            ->title('Чекбоксы')
            ->body($this->grid());
    }

    protected function grid(): Grid
    {
        $grid = new Grid(new \App\Models\Checkbox());
        $grid->column('system_name','Название');
        $grid->column('created_at', 'Дата создания')->display(function ($date) {
            return Carbon::parse($date)->format('d-m-Y');
        });
        $grid->disableCreateButton(false);
        return $grid;
    }

    protected function form(): Form
    {
        $form = new Form(new Checkbox());
        $form->text('system_name', 'Системное название');
        $form->text('name', 'Название');
        $form->number('required_options', 'Обязательно параметров')
            ->default(1);
        $form->hasMany('options', 'Варианты',function (Form\NestedForm $form) {
            $form->text('name', 'Опция');
            $form->switch('checked', 'Выбрано по умолчанию');
        });
        return $form;
    }

    public function create(Content $content): Content
    {

        return $content->body($this->form());
    }

    public function edit($id, Content $content): Content
    {
        $checkbox = Checkbox::findOrFail($id);

        return $content->body($this->form()->edit($id));
    }
}

{

}
