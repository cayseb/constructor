<?php

declare(strict_types=1);

namespace App\Admin\Controllers;

use App\Enums\FieldEnum;
use App\Models\Field;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class FieldController2 extends AdminController
{
    public function index(Content $content): Content
    {
        return $content
            ->title('Формы')
            ->breadcrumb(
                [
                    'text' => 'Поля',
                    'url' => route('admin.fields.index')
                ])->body($this->grid());
    }

    protected function grid(): Grid
    {
        $grid = new Grid(new \App\Models\Field());
        $grid->column('name','Название поля');
        $grid->column('type','Тип поля')
        ->display(fn ():string => FieldEnum::getName(FieldEnum::from($this->type)));
        $grid->column('created_at', 'Дата создания')->display(function ($date) {
            return Carbon::parse($date)->format('d-m-Y');
        });
        $grid->disableCreateButton(false);
        return $grid;
    }

    protected function form(): Form
    {
        $form = new Form(new Field());
        $form->text('name','Название поля');
        $form->radio('type','Тип поля')
            ->options([
                FieldEnum::INPUT->value =>'инпут',
                FieldEnum::CHECKBOX->value =>'чекбокс',
                FieldEnum::RADIO->value =>'радио',
                FieldEnum::SELECT->value =>'селект',
            ])->when('input', function (Form $form) {
                $form->text('label','Лейбл');
                $form->text('placeholder','placeholder');
                $form->switch('required','required');
            })->when('checkbox', function (Form $form) {
                $form->text('label','Лейбл');
                $form->switch('required','required');
                $form->hasMany('checkboxes',function (Form\NestedForm $form){
                    $form->number('required_options','Обязательных вариантов');
                });
            })->when('radio', function (Form $form) {
                $form->text('label','Лейбл');
                $form->text('placeholder','placeholder');
                $form->switch('required','required');
            })->when('select', function (Form $form) {
                $form->text('label','Лейбл');
                $form->text('placeholder','placeholder');
                $form->switch('required','required');
            });
//        $form->select('period', 'Период оплаты')
//            ->options(
//                [
//                    TariffPeriodEnum::MONTH->value => TariffPeriodEnum::getNameTranslation(TariffPeriodEnum::MONTH),
//                    TariffPeriodEnum::THREE_MONTHS->value => TariffPeriodEnum::getNameTranslation(TariffPeriodEnum::THREE_MONTHS),
//                    TariffPeriodEnum::SIX_MONTHS->value => TariffPeriodEnum::getNameTranslation(TariffPeriodEnum::SIX_MONTHS),
//                    TariffPeriodEnum::YEAR->value => TariffPeriodEnum::getNameTranslation(TariffPeriodEnum::YEAR)
//                ]);
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
