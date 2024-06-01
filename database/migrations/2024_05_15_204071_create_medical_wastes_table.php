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
        Schema::create('medical_wastes', function (Blueprint $table) {
            $table->id();
            $table->morphs('created_by');
            $table->string('waste_type');
            $table->bigInteger('waste_quantity');
            $table->string('status')->default('Toplanmadı');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_wastes');
    }
};
