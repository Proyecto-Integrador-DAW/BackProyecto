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
        Schema::create('warnings', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->unsignedBigInteger('type');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('periodicity', ['punctual', 'periodic']);
            $table->enum('week_day', ['Monday','Tuesday', 'Wednesday','Thursday','Friday','Saturday','Sunday'])->nullable();
            $table->timestamps();

            $table->foreign('type')->references('id')->on('warning_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warnings');
    }
};
