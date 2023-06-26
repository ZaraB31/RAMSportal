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
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->string('location');
            $table->date('start');
            $table->date('end');
            $table->string('workingHours');
            $table->integer('emergencyPhone');
            $table->foreignId('hospital_id')->nullable()->constrained('hospitals')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('supervisor_id')->nullable()->constrained('operatives')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('manager_id')->nullable()->constrained('operatives')->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details');
    }
};
