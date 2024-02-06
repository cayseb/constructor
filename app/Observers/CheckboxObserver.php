<?php

namespace App\Observers;

use App\Enums\FieldEnum;
use App\Models\Checkbox;
use App\Models\Field;

class CheckboxObserver
{

    public function creating(Checkbox $checkbox): void
    {
        $field = new Field();
        $field->type = FieldEnum::CHECKBOX->value;
        $field->name = $checkbox->system_name;
        $field->save();
        $checkbox->field_id = $field->id;
    }


    /**
     * Handle the Checkbox "created" event.
     */
    public function created(Checkbox $checkbox): void
    {
        //
    }

    /**
     * Handle the Checkbox "updated" event.
     */
    public function updated(Checkbox $checkbox): void
    {
        //
    }

    /**
     * Handle the Checkbox "deleted" event.
     */
    public function deleted(Checkbox $checkbox): void
    {
        $checkbox->field->delete();
    }

    /**
     * Handle the Checkbox "restored" event.
     */
    public function restored(Checkbox $checkbox): void
    {
        //
    }

    /**
     * Handle the Checkbox "force deleted" event.
     */
    public function forceDeleted(Checkbox $checkbox): void
    {
        //
    }
}
