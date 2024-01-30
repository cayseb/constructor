<?php
declare(strict_types=1);

namespace App\Enums;

enum InputTypeEnum: string
{
    case DATE = 'date';
    case DATE_TIME = 'date_time';
    case NUMBER = 'number';
    case TEXT = 'text';
}
