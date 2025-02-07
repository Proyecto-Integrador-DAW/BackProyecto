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
            $table->timestamp('dateTime');
            $table->unsignedBigInteger('operatorId');
            $table->unsignedBigInteger('patientId');
            $table->string('description');
            $table->unsignedBigInteger('callType');
            $table->string('type');
            $table->unsignedBigInteger('warningId')->nullable();
            $table->timestamps();

            $table->foreign('operatorId')->references('id')->on('teleoperators');
            $table->foreign('patientId')->references('id')->on('patients');
            $table->foreign('callType')->references('id')->on('call_types');
            $table->foreign('warningId')->references('id')->on('warnings');
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
