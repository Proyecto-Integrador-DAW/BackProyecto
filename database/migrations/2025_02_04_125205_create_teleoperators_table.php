<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {

        /**
         * Run the migrations.
         */
        public function up(): void {

            Schema::create('teleoperators', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('prefix');
                $table->string('phone_number')->unique();
                $table->unsignedBigInteger('zone_id');
                $table->date('hiring_date');
                $table->string('code')->nullable();
                $table->string('password');
                $table->date('firing_date')->nullable();
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('zone_id')->references('id')->on('zones');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void {
            Schema::dropIfExists('teleoperators');
        }
    };
?>