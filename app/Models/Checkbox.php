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

    protected $guarded = [];

    public function steps()
    {
        return $this->morphToMany(Step::class, 'stepable');
    }

    public function options(): MorphMany
    {
        return $this->morphMany(Option::class, 'optionable');
    }

    public function stepables()
    {
        return $this->belongsTo(Stepable::class, 'stepable_id');
    }
}
