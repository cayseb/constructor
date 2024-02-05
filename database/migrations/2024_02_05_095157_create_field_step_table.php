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
        Schema::create('field_step', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('field_id')
                ->references('id')
                ->on('fields')
                ->cascadeOnDelete();
            $table->foreignUuid('step_id')
                ->references('id')
                ->on('steps')
                ->cascadeOnDelete();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('field_step');
    }
};
