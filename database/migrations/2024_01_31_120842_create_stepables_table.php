<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stepables', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('step_id')
                ->references('id')
                ->on('steps')
            ->cascadeOnDelete();
            $table->uuid('stepable_id');
            $table->string('stepable_type');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stepables');
    }
};
