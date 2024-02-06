<?php

namespace App\Observers;

use App\Enums\FieldEnum;
use App\Models\Field;
use App\Models\Radio;

class RadioObserver
{

    public function creating(Radio $radio): void
    {
        $field = new Field();
        $field->type = FieldEnum::RADIO->value;
        $field->name = $radio->system_name;
        $field->save();
        $radio->field_id = $field->id;
    }
    /**
     * Handle the Radio "created" event.
     */
    public function created(Radio $radio): void
    {
        //
    }

    /**
     * Handle the Radio "updated" event.
     */
    public function updated(Radio $radio): void
    {
        //
    }

    /**
     * Handle the Radio "deleted" event.
     */
    public function deleted(Radio $radio): void
    {
        //
    }

    /**
     * Handle the Radio "restored" event.
     */
    public function restored(Radio $radio): void
    {
        //
    }

    /**
     * Handle the Radio "force deleted" event.
     */
    public function forceDeleted(Radio $radio): void
    {
        //
    }
}
