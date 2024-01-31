<?php

declare(strict_types=1);

namespace App\Admin\Controllers\Fields;

use App\Enums\FieldEnum;
use App\Enums\InputTypeEnum;
use App\Models\Field;
use App\Models\Input;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class RadioController extends AdminController
{
    public function index(Content $content): Content
    {
        return $content
            ->title('Инпуты')
            ->breadcrumb(
                [
                    'text' => 'Инпуты',
                    'url' => route('admin.inputs.index')
                ])->body($this->grid());
    }

    protected function grid(): Grid
    {
        $grid = new Grid(new \App\Models\Input());

//        $grid->column('type', 'Тип поля')->display(function () {
//            $nameField = FieldEnum::getName(FieldEnum::from($this->type));
//            return "<a href=" . route('admin.inputs.index') . ">$nameField</a>";
//        });
//        $grid->column('type','Тип поля')
//        ->display(fn ():string => FieldEnum::getName(FieldEnum::from($this->type)));
//        $grid->column('created_at', 'Дата создания')->display(function ($date) {
//            return Carbon::parse($date)->format('d-m-Y');
//        });
        $grid->disableCreateButton(false);
        return $grid;
    }

    protected function form(): Form
    {
        $form = new Form(new Input());
        $form->text('system_name','Системное название');
        $form->text('name','Название');
        $form->select('type','Тип поля')->options([
            InputTypeEnum::DATE->value => 'Дата',
            InputTypeEnum::DATE_TIME->value => 'Дата-время',
            InputTypeEnum::NUMBER->value => 'Число',
            InputTypeEnum::TEXT->value => 'Текст',
        ]);

        $form->text('label','Лейбл');
        $form->text('placeholder','Плейсхолдер');
        $form->switch('required','Обязательно');
        return $form;
    }

    public function create(Content $content): Content
    {
        $content->breadcrumb(
            ['text' => 'Инпуты', 'url' => route('admin.inputs.index')],
            ['text' => 'Создание', 'url' => '/']
        );
        return $content->body($this->form());
    }

    public function edit($id, Content $content): Content
    {
        $input = Input::findOrFail($id);
        $content->breadcrumb(
            ['text' => 'Инпуты', 'url' => route('admin.inputs.index')],
            ['text' => $input->system_name, 'url' => '/']
        );
        return $content->body($this->form()->edit($id));
    }
}
{

}
