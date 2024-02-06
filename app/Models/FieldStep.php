<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class FieldStep extends Pivot implements Sortable
{
    use HasFactory;
    use HasUuids;

    use SortableTrait;
    use HasUuids;

    protected $table = 'field_step';

    public array $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    public function buildSortQuery()
    {
        return static::query()->where('step_id', $this->step_id);
    }

    public function steps()
    {
        return $this->belongsTo(Step::class,'step_id')->orderByPivot('order');
    }

    public function fields()
    {
        return $this->belongsTo(Field::class,'field_id')->orderByPivot('order');
    }


}
