<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Step extends Model
{
    use HasFactory;

    use HasUuids;


    public function forms(): BelongsToMany
    {
        return $this->belongsToMany(Form::class)->orderByPivot('order')->using(FormStep::class);
    }

    public function fields(): BelongsToMany
    {
        return $this->belongsToMany(Field::class)->orderByPivot('order')->using(FieldStep::class);
    }


}
