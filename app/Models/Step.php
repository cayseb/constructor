<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Step extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;
    use HasUuids;

    public array $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    public function forms(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Form::class)->using(FormStep::class);
    }

    public function inputs()
    {
        return $this->morphedByMany(Input::class, 'stepable')->using(Stepable::class);
    }

    public function checkboxes()
    {
        return $this->morphedByMany(Checkbox::class, 'stepable')->using(Stepable::class);
    }

    public function selects()
    {
        return $this->morphedByMany(Select::class, 'stepable')->using(Stepable::class);
    }

    public function radios()
    {
        return $this->morphedByMany(Radio::class, 'stepable')->using(Stepable::class);
    }

    public function stepables()
    {
        return $this->belongsTo(Stepable::class, 'step_id');
    }



}
