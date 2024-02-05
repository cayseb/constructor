<?php

namespace App\Admin\Forms;

use App\Models\Checkbox;
use App\Models\Field;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class CheckboxForm extends Form
{

    public function __construct($data = [])
    {
        parent::__construct($data);

    }

    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Чекбокс';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        $checkbox = new Checkbox();
        $checkbox->name = request()->get('name');
        $checkbox->required_options = request()->get('required_options');
        $checkbox->field_id = request()->get('field_id');
        $checkbox->save();

        admin_success('Processed successfully.');

//        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {

        $this->text('name','Название')->rules('required');
        $this->number('required_options','Обязательно параметров')->default(1);
        $this->text('field_id')->value($this->attributes['field_id']);
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {

        return [
            'name'=>'asd',
            'required_options'=>'zxc',
        ];
    }
}
