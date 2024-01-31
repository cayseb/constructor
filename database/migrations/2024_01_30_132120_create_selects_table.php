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
        Schema::create('selects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('system_name');
            $table->string('name');
            $table->boolean('multi')->default(false);
            $table->foreignUuid('field_id')
                ->references('id')
                ->on('fields')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selects');
    }
};
