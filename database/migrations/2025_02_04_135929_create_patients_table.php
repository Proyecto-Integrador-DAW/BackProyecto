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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('DNI')->unique();
            $table->string('name');
            $table->string('adress');
            $table->integer('phoneNumber')->unique();
            $table->string('healthCard')->unique();
            $table->string('email')->unique();
            $table->unsignedBigInteger('zoneId');
            $table->string('personalSituation');
            $table->string('healthSituation');
            $table->string('housingSituation');
            $table->string('economicSituation');
            $table->string('autonomy');
            $table->timestamps();

            $table->foreign('zoneId')->references('id')->on('zones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
