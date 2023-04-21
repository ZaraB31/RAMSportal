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
        Schema::create('method_tools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('method_id')->references('id')->on('methods')->onDelete('cascade');
            $table->foreignId('tool_id')->references('id')->on('tools')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('method_tools');
    }
};
