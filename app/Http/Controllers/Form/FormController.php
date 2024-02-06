<?php

declare(strict_types=1);

namespace App\Http\Controllers\Form;

use App\Models\Form;
use App\Services\CreateCustomTable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class FormController
{
    public function index(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $form = Form::with(
            'steps.fields.input',
            'steps.fields.checkbox.options',
            'steps.fields.select.options',
            'steps.fields.radio.options',
        )->first();
        return view('welcome', compact('form'));
    }

    public function store(\App\Http\Controllers\Form\Request $request)
    {
        dd($request->all());
        $c = new CreateCustomTable();
        $c->index($request->get('form'));
//        dd($request->all());
    }

    public function preparingTable()
    {

    }
}
