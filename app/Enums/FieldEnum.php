<?php
declare(strict_types=1);

namespace App\Enums;

enum FieldEnum: string
{
    case INPUT = 'input';
    case RADIO = 'radio';
    case SELECT = 'select';
    case CHECKBOX = 'checkbox';

    /**
     * @return string
     */
    public static function getName(FieldEnum $enum): string
    {
        return $enum->value;
    }
}
