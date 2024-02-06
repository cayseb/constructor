<?php

namespace App\Observers;

use App\Enums\FieldEnum;
use App\Models\Field;
use App\Models\Input;

class InputObserver
{
    /**
     * Handle the Input "created" event.
     */

    public function creating(Input $input): void
    {
        $field = new Field();
        $field->type = FieldEnum::INPUT->value;
        $field->name = $input->system_name;
        $field->save();
        $input->field_id = $field->id;
    }
    public function created(Input $input): void
    {
        //
    }

    /**
     * Handle the Input "updated" event.
     */
    public function updated(Input $input): void
    {
        //
    }

    /**
     * Handle the Input "deleted" event.
     */
    public function deleted(Input $input): void
    {
        $input->field->delete();
    }

    /**
     * Handle the Input "restored" event.
     */
    public function restored(Input $input): void
    {
        //
    }

    /**
     * Handle the Input "force deleted" event.
     */
    public function forceDeleted(Input $input): void
    {
        //
    }
}
