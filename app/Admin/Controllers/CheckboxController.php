<?php

declare(strict_types=1);

namespace App\Admin\Controllers;

use App\Admin\Forms\CheckboxForm;
use App\Models\Field;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Layout\Content;

class CheckboxController extends AdminController
{
    public function index(Content $content): Content
    {
        $title = Field::findOrFail(request()->field);
        return $content
            ->breadcrumb()
            ->title($title->name)
            ->body(new CheckboxForm(['field'=>request()->field]));
    }
}
