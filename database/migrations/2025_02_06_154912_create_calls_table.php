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
        Schema::create('calls', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date_time');
            $table->unsignedBigInteger('operator_id');
            $table->unsignedBigInteger('patient_id');
            $table->string('description');
            $table->unsignedBigInteger('call_type');
            $table->string('type');
            $table->unsignedBigInteger('warning_id')->nullable();
            $table->timestamps();

            $table->foreign('operator_id')->references('id')->on('teleoperators');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('call_type')->references('id')->on('call_types');
            $table->foreign('warning_id')->references('id')->on('warnings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calls');
    }
};
