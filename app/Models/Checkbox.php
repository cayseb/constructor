<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Checkbox extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = ['name'];

    protected $guarded = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(CheckboxOption::class);
    }

}
