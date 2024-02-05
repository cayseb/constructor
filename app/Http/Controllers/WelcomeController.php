<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Form;

class WelcomeController
{
    public function __invoke()
    {
        $form = Form::with(
            'steps.inputs',
            'steps.selects.options',
            'steps.checkboxes.options',
            'steps.radios.options',
            'steps.stepables'
        )->first();
        return view('welcome',compact('form'));
    }
}
