<?php
declare(strict_types=1);

namespace App\Enums;

enum InputTypeEnum: string
{
    case CHECKBOX = 'checkbox';
    case DATE = 'date';
    case DATETIME_LOCAL = 'datetime-local';
    case EMAIL = 'email';
    case NUMBER = 'number';
    case RADIO = 'radio';
    case TEL = 'tel';
    case TEXT = 'text';


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->value;
    }
}
