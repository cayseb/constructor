<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class RadioOption extends Model implements Sortable
{
    use HasFactory;
    use HasUuids;
    use SortableTrait;

    protected $guarded = [];

    public array $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    public function buildSortQuery()
    {
        return static::query()->where('radio_id', $this->radio_id);
    }

    public function checkbox(): BelongsTo
    {
        return $this->belongsTo(Radio::class);
    }
}
