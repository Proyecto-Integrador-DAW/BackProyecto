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
        Schema::create('warning_types', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->unsignedBigInteger('category');
            $table->timestamps();

            $table->foreign('category')->references('id')->on('warning_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warning_types');
    }
};
