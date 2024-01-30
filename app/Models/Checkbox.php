<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Checkbox extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = ['name'];

    public function field(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Field::class);
    }

    public function options(): MorphMany
    {
        return $this->morphMany(Option::class, 'optionable');
    }
}
