<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Form;

class WelcomeController
{
    public function __invoke()
    {
        $form = Form::with(
            'steps.fields.input',
            'steps.fields.checkbox',
            'steps.fields.select',
            'steps.fields.radio',
        )->first();
        return view('welcome',compact('form'));
    }
}
