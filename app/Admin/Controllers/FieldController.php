<?php

declare(strict_types=1);

namespace App\Admin\Controllers;

use App\Enums\FieldEnum;
use App\Enums\InputTypeEnum;
use App\Models\Field;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class FieldController extends AdminController
{
    public function index(Content $content): Content
    {
        return $content
            ->title('Поля')
            ->breadcrumb(
                [
                    'text' => 'Поля',
                    'url' => route('admin.fields.index')
                ])->body($this->grid());
    }

    protected function grid(): Grid
    {
        $grid = new Grid(new \App\Models\Field());
        $grid->column('name', 'Название поля')->display(function () {
            $route = match (FieldEnum::from($this->type)) {
                FieldEnum::INPUT => route('admin.inputs.index', ['field' => $this->id]),
                FieldEnum::CHECKBOX => route('admin.checkboxes.index', ['field' => $this->id]),
                FieldEnum::SELECT => route('admin.selects.index', ['field' => $this->id]),
                FieldEnum::RADIO => route('admin.radios.index', ['field' => $this->id]),
            };
            return "<a href=" . $route . ">$this->name</a>";
        });
        $grid->column('type', 'Тип поля')
            ->display(fn(): string => FieldEnum::getName(FieldEnum::from($this->type)));
        $grid->column('created_at', 'Дата создания')->display(function ($date) {
            return Carbon::parse($date)->format('d-m-Y');
        });
        $grid->disableCreateButton(false);
        return $grid;
    }

    protected function form(): Form
    {
        $form = new Form(new Field());
        $form->text('system_name', 'Системное название');
        $form->text('name', 'Название');
        $form->select('type', 'Тип поля')
            ->options([
                FieldEnum::INPUT->value => 'инпут',
                FieldEnum::CHECKBOX->value => 'чекбокс',
                FieldEnum::RADIO->value => 'радио',
                FieldEnum::SELECT->value => 'селект'
            ]);
//        $form->radioButton('type', 'Кнопка')
//            ->options([
//                FieldEnum::INPUT->value => 'инпут',
//                FieldEnum::CHECKBOX->value => 'чекбокс',
//                FieldEnum::RADIO->value => 'радио',
//                FieldEnum::SELECT->value => 'селект'
//            ])
//            ->when(FieldEnum::INPUT->value, function (Form $form) {
//                $form->select('input.type', 'Тип инпута')
//                    ->options([
//                        InputTypeEnum::DATE->value => 'дата',
//                        InputTypeEnum::DATE_TIME->value => 'дата-время',
//                        InputTypeEnum::NUMBER->value => 'число',
//                        InputTypeEnum::TEXT->value => 'текст',
//                    ]);
//                $form->text('input.name', 'Название');
//                $form->text('input.label', 'label');
//                $form->text('input.placeholder', 'placeholder');
//                $form->switch('input.required', 'required');
////                $form->morphMany('checkboxes.options', function (Form\NestedForm $form) {
////                    $form->text('name');
////                });
//            })->when(false, function () {
//            });

        return $form;
    }

    public function create(Content $content): Content
    {
        $content->breadcrumb(
            ['text' => 'Поля', 'url' => route('admin.fields.index')],
            ['text' => 'Создание', 'url' => '/']
        );
        return $content->body($this->form());
    }

    public function edit($id, Content $content): Content
    {
        $tariff = Field::findOrFail($id);
        $content->breadcrumb(
            ['text' => 'Поля', 'url' => route('admin.fields.index')],
            ['text' => $tariff->period, 'url' => '/']
        );
        return $content->body($this->form()->edit($id));
    }
}

{

}
