<?php

declare(strict_types=1);

namespace App\Admin\Controllers\Fields;

use App\Enums\FieldEnum;
use App\Enums\InputTypeEnum;
use App\Models\Field;
use App\Models\Input;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class InputController extends AdminController
{
    public function index(Content $content): Content
    {
        return $content
            ->title('Инпуты')
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
        $form = new Form(new Input());
        $form->text('system_name','Системное название');
        $form->text('name','Название');
        $form->select('type','Тип поля')->options([
            InputTypeEnum::CHECKBOX->value => 'Чекбокс',
            InputTypeEnum::DATE->value => 'Дата',
            InputTypeEnum::DATETIME_LOCAL->value => 'Дата-время',
            InputTypeEnum::EMAIL->value => 'email',
            InputTypeEnum::NUMBER->value => 'Число',
            InputTypeEnum::RADIO->value => 'Радио',
            InputTypeEnum::TEL->value => 'Телефон',
            InputTypeEnum::TEXT->value => 'Текст',
        ])->when(InputTypeEnum::CHECKBOX->value,function (Form $form){
            $form->text('label','Лейбл');
            $form->text('label','Лейбл');
        });
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
