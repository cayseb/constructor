<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Stepable extends MorphPivot implements Sortable
{
    use SortableTrait;
    use HasUuids;

    protected $table = 'stepables';

    public array $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    public function buildSortQuery()
    {
        return static::query()->where('step_id', $this->step_id);
    }

    public function step()
    {
        return $this->belongsTo(Step::class, 'step_id');
    }

    public function stepables()
    {
        return $this->hasMany(Step::class, 'step_id');
    }

    public function getModel()
    {
        return match ($this->stepable_type){
          Input::class => Input::findOrFail($this->stepable_id),
          Select::class => Select::findOrFail($this->stepable_id),
          Checkbox::class => Checkbox::findOrFail($this->stepable_id),
          Radio::class => Radio::findOrFail($this->stepable_id),
        };
    }
}
