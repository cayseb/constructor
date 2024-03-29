<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Option extends Model
{
    use HasFactory;
    use HasUuids;


    public function optionable(): MorphTo
    {
        return $this->morphTo();
    }
}
