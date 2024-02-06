<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Schema;

class CreateCustomTable
{
    public function index($id)
    {
        if (!Schema::hasTable($id)) {
            Schema::create($id, function ($table) {
                $table->uuid('id')->primary();

                $table->timestamps();
            });
        }
    }
}
