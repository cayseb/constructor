<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\InputTypeEnum;
use App\Models\Checkbox;
use App\Models\Form;
use App\Models\Input;
use App\Models\Radio;
use App\Models\Select;
use Illuminate\Database\Seeder;

class FieldSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Radio::destroy(Radio::all()->pluck('id'));
        Checkbox::destroy(Checkbox::all()->pluck('id'));
        Input::destroy(Input::all()->pluck('id'));
        Select::destroy(Select::all()->pluck('id'));
        Form::destroy(Form::all()->pluck('id'));

        $radio = Radio::create([
            'system_name'=>'Гендер',
            'name'=>'Гендер'
        ]);

        $radio->options()->create(['name'=>'М']);
        $radio->options()->create(['name'=>'Ж']);

        $select = Select::create([
            'system_name' =>'Какой браузер вы используете',
            'name' =>'Какой браузер вы используете',
            'multi' =>true,
        ]);
        $select->options()->create(['name'=>'Хром']);
        $select->options()->create(['name'=>'Мозила']);
        $select->options()->create(['name'=>'Яндекс']);

        $select = Select::create([
            'system_name' =>'Выберите вариант ответа',
            'name' =>'Выберите вариант ответа',
            'multi' =>false,
        ]);
        $select->options()->create(['name'=>'Вариант А']);
        $select->options()->create(['name'=>'Вариант Б']);
        $select->options()->create(['name'=>'Вариант С']);

        $checkbox = Checkbox::create([
                'system_name'=>'Сколько событий вы посетили',
                'name'=>'Сколько событий вы посетили',
                'required_options'=>'1',
        ]);

        $checkbox->options()->create(['name'=>'Одно']);
        $checkbox->options()->create(['name'=>'Два']);
        $checkbox->options()->create(['name'=>'Три']);


        Input::create([
            'system_name'=> 'ФИО',
            'name'=> 'ФИО',
            'type'=> InputTypeEnum::TEXT->value,
            'label'=> 'ФИО',
            'placeholder'=> 'ФИО',
            'required'=> true,
        ]);
        Input::create([
            'system_name'=> 'Номер телефона',
            'name'=> 'Номер телефона',
            'type'=> InputTypeEnum::TEXT->value,
            'label'=> 'Номер телефона',
            'placeholder'=> 'Номер телефона',
            'required'=> true,
        ]);
        Input::create([
            'system_name'=> 'email',
            'name'=> 'email',
            'type'=> InputTypeEnum::TEXT->value,
            'label'=> 'email',
            'placeholder'=> 'email',
            'required'=> true,
        ]);

    }
}
