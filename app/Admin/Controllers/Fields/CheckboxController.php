<?php

declare(strict_types=1);

namespace App\Admin\Controllers\Fields;

use App\Enums\FieldEnum;
use App\Enums\InputTypeEnum;
use App\Models\Checkbox;
use App\Models\Field;
use App\Models\Input;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class CheckboxController extends AdminController
{
    public function index(Content $content): Content
    {
        return $content
            ->title('Чекбокс')
            ->body($this->grid());
    }

    protected function grid(): Grid
    {
        $grid = new Grid(new \App\Models\Checkbox());
        $grid->model()->where('field_id', request()->field);
        $grid->column('system_name','Название');
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
        $form->hidden('field_id')->value(request()->field);
        $form->hasMany('options', 'Варианты',function (Form\NestedForm $form) {
            $form->text('name', 'Опция');
        });
        return $form;
    }

    public function create(Content $content): Content
    {

        return $content->body($this->form());
    }

    public function edit($id, Content $content): Content
    {
        $checkbox = Checkbox::findOrFail(request()->checkbox);

        return $content->body($this->form()->edit(request()->checkbox));
    }
}

{

}
