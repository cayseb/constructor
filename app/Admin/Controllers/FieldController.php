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
                FieldEnum::RADIO => route('admin.radio.index', ['field' => $this->id]),
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
        $form->text('name', 'Название');
        $form->radio('type', 'Кнопка')
            ->options([
                FieldEnum::INPUT->value => 'инпут',
                FieldEnum::CHECKBOX->value => 'чекбокс',
                FieldEnum::RADIO->value => 'радио',
                FieldEnum::SELECT->value => 'селект'
            ])
            ->when(FieldEnum::INPUT->value, function (Form $form) {
                $form->select('input.type', 'Тип инпута')
                    ->options([
                        InputTypeEnum::DATE->value => 'дата',
                        InputTypeEnum::DATE_TIME->value => 'дата-время',
                        InputTypeEnum::NUMBER->value => 'число',
                        InputTypeEnum::TEXT->value => 'текст',
                    ]);
                $form->text('input.name', 'Название');
                $form->text('input.label', 'Лейбл');
                $form->text('input.placeholder', 'Плейсхолдер');
                $form->switch('input.required', 'Обязательно');
            })
            ->when(FieldEnum::CHECKBOX->value, function (Form $form) {
            })
            ->when(FieldEnum::RADIO->value, function (Form $form) {
                $form->text('radio.name', 'Название');
            })
            ->when(FieldEnum::SELECT->value, function (Form $form) {
                $form->text('select.name', 'Название');
                $form->switch('select.multi', 'Мультиселект');
            });
        $form->saved(function (Form $form) {
            $route = match (FieldEnum::from($form->model()->type)) {
                FieldEnum::INPUT => route('admin.inputs.index', ['field' => $form->model()->id]),
                FieldEnum::CHECKBOX => route('admin.checkbox.form', ['field' => $form->model()->id]),
                FieldEnum::SELECT => route('admin.selects.index', ['field' => $form->model()->id]),
                FieldEnum::RADIO => route('admin.radio.index', ['field' => $form->model()->id]),
            };
            return redirect($route);

        });
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
