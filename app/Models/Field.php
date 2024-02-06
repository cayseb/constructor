<?php

namespace App\Models;

use App\Enums\FieldEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function steps(): BelongsToMany
    {
        return $this->belongsToMany(Step::class)->orderByPivot('order')->using(FieldStep::class);
    }

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

    public function getBelongsModel()
    {
        return match (FieldEnum::from($this->type)){
            FieldEnum::INPUT => $this->input,
            FieldEnum::SELECT => $this->select,
            FieldEnum::CHECKBOX => $this->checkbox,
            FieldEnum::RADIO => $this->radio,
        };
    }
}
