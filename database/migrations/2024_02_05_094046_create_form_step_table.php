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
        Schema::create('form_step', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('form_id')
                ->references('id')
                ->on('forms')
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
        Schema::dropIfExists('form_step');
    }
};
