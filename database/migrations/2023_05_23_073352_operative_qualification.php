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
        Schema::create('operative_qualifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('operative_id')->references('id')->on('operatives')->onDelete('cascade');
            $table->foreignId('qualification_id')->references('id')->on('qualifications')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operative_qualifications');
    }
};
