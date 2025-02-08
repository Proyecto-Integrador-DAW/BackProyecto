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
            $table->string('phone_number');
            $table->unsignedBigInteger('zone_id');
            $table->string('mother_tongue');
            $table->date('hiring_date');
            $table->string('code')->unique();
            $table->string('password')->hash();
            $table->date('firing_date')->nullable();
            $table->timestamps();

            $table->foreign('zone_id')->references('id')->on('zones');
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
