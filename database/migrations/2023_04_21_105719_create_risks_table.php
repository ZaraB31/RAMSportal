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
        Schema::create('risks', function (Blueprint $table) {
            $table->id();
            $table->string('hazard');
            $table->longText('effect');
            $table->integer('likelihood');
            $table->integer('severity');
            $table->longText('control');
            $table->integer('residualLikelihood');
            $table->integer('residualSeverity');
            $table->foreignId('person_id')->nullable()->constrained('people')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('type_id')->nullable()->constrained('risk_types')->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risks');
    }
};
