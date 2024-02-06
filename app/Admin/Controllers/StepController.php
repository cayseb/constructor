<?php

declare(strict_types=1);

namespace App\Admin\Controllers;

use App\Enums\FieldEnum;
use App\Models\Checkbox;
use App\Models\Field;
use App\Models\Input;
use App\Models\Radio;
use App\Models\Select;
use App\Models\Step;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class StepController extends AdminController
{
    public function index(Content $content): Content
    {
        return $content
            ->title('Шаги')
            ->breadcrumb(
                [
                    'text' => 'Шаги',
                    'url' => route('admin.steps.index')
                ])->body($this->grid());
    }

    protected function grid(): Grid
    {
        $grid = new Grid(new \App\Models\Step());
        $grid->column('name','Название')->display(function (){
            return "<a href=" . route('admin.step.fields.index', ['step' => $this->id]) . ">$this->name</a>";
        });
        $grid->column('created_at', 'Дата создания')->display(function ($date) {
            return Carbon::parse($date)->format('d-m-Y');
        });
        $grid->disableCreateButton(false);
        return $grid;
    }

    protected function form(): Form
    {
        $form = new Form(new Step());
        $form->text('name','Название')->required();
        $form->multipleSelect('fields','Инпуты')
            ->options(Field::whereType(FieldEnum::INPUT->value)->pluck('name','id')->toArray()
            );
        $form->multipleSelect('fields','Чекбоксы')
            ->options(Field::whereType(FieldEnum::CHECKBOX->value)->pluck('name','id')->toArray()
            );
        $form->multipleSelect('fields','Селекты')
            ->options(Field::whereType(FieldEnum::SELECT->value)->pluck('name','id')->toArray()
            );
        $form->multipleSelect('fields','Радио')
            ->options(Field::whereType(FieldEnum::RADIO->value)->pluck('name','id')->toArray()
            );
//        $form->multipleSelect('checkboxes','Чекбоксы')->options(Checkbox::pluck('system_name','id')->toArray());
//        $form->multipleSelect('selects','Селекты')->options(Select::pluck('system_name','id')->toArray());
//        $form->multipleSelect('radios','Радио')->options(Radio::pluck('system_name','id')->toArray());
        return $form;
    }

    public function create(Content $content): Content
    {
        $content->breadcrumb(
            ['text' => 'Шаги', 'url' => route('admin.steps.index')],
            ['text' => 'Создание', 'url' => '/']
        );
        return $content->body($this->form());
    }

    public function edit($id, Content $content): Content
    {
        $step = Step::findOrFail($id);
        $content->breadcrumb(
            ['text' => 'Поля', 'url' => route('admin.steps.index')],
            ['text' => $step->name, 'url' => '/']
        );
        return $content->body($this->form()->edit($id));
    }
}
{

}
