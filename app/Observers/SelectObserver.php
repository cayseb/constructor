<?php

namespace App\Observers;

use App\Enums\FieldEnum;
use App\Models\Field;
use App\Models\Select;

class SelectObserver
{

    public function creating(Select $select): void
    {
        $field = new Field();
        $field->type = FieldEnum::SELECT->value;
        $field->name = $select->system_name;
        $field->save();
        $select->field_id = $field->id;
    }

    /**
     * Handle the Select "created" event.
     */
    public function created(Select $select): void
    {
        //
    }

    /**
     * Handle the Select "updated" event.
     */
    public function updated(Select $select): void
    {
        //
    }

    /**
     * Handle the Select "deleted" event.
     */
    public function deleted(Select $select): void
    {
        $select->field->delete();
    }

    /**
     * Handle the Select "restored" event.
     */
    public function restored(Select $select): void
    {
        //
    }

    /**
     * Handle the Select "force deleted" event.
     */
    public function forceDeleted(Select $select): void
    {
        //
    }
}
