<?php
declare(strict_types=1);

namespace App\Enums;

enum InputTypeEnum: string
{
    case DATE = 'date';
    case DATETIME_LOCAL = 'datetime-local';
    case NUMBER = 'number';
    case TEXT = 'text';
    case TEL = 'tel';
    case EMAIL = 'email';


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->value;
    }
}
