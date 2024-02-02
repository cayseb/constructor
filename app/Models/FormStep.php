<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class FormStep extends Pivot implements Sortable
{
    use SortableTrait;
    use HasUuids;

    protected $table = 'form_step';

    public array $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    public function buildSortQuery()
    {
        return static::query()->where('form_id', $this->form_id);
    }

    public function steps()
    {
        return $this->belongsTo(Step::class,'step_id');
    }

}
