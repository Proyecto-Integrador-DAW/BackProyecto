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
        Schema::create('contact_patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patientId');
            $table->unsignedBigInteger('contactId');
            $table->string('relationship');
            $table->timestamps();

            $table->foreign('patientId')->references('id')->on('patients');
            $table->foreign('contactId')->references('id')->on('contacts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_patients');
    }
};
