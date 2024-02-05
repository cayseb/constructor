<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Field extends Model implements Sortable
{
    use HasFactory;
    use HasUuids;
    use SortableTrait;

    public array $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    public function checkbox(): HasOne
    {
        return $this->hasOne(Checkbox::class);
    }

    public function radio(): HasOne
    {
        return $this->hasOne(Radio::class);
    }

    public function select(): HasOne
    {
        return $this->hasOne(Select::class);
    }

    public function input(): HasOne
    {
        return $this->hasOne(Input::class);
    }

    public function getModel()
    {
        return match ($this->type){
            Input::class => Input::findOrFail($this->stepable_id),
            Select::class => Select::findOrFail($this->stepable_id),
            Checkbox::class => Checkbox::findOrFail($this->stepable_id),
            Radio::class => Radio::findOrFail($this->stepable_id),
        };
    }
}
