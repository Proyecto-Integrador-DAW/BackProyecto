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
        Schema::create('teleoperators', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('phoneNumber');
            $table->unsignedBigInteger('zoneId');
            $table->string('motherTongue');
            $table->date('hiringDate');
            $table->string('code')->unique();
            $table->string('password')->hash();
            $table->date('firingDate')->nullable();
            $table->timestamps();

            $table->foreign('zoneId')->references('id')->on('zones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teleoperators');
    }
};
