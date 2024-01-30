<?php

declare(strict_types=1);

namespace App\Admin\Controllers;

use App\Models\Field;
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
                    'url' => route('admin.fields.index')
                ])->body($this->grid());
    }

    protected function grid(): Grid
    {
        $grid = new Grid(new \App\Models\Field());
        $grid->column('name','Название поля');
        $grid->column('created_at', 'Дата создания')->display(function ($date) {
            return Carbon::parse($date)->format('d-m-Y');
        });
        $grid->disableCreateButton(false);
        return $grid;
    }

    protected function form(): Form
    {
        $form = new Form(new Field());
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
