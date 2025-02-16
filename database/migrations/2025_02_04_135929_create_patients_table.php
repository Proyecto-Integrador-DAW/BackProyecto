<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {

        /**
         * Run the migrations.
         */
        public function up(): void {
            Schema::create('patients', function (Blueprint $table) {
                $table->id();
                $table->string('dni')->unique();
                $table->string('name');
                $table->date('birth_date');
                $table->string('address');
                $table->string('phone_number')->unique();
                $table->string('health_card')->unique();
                $table->string('email')->unique();
                $table->unsignedBigInteger('zone_id');
                $table->string('personal_situation');
                $table->string('health_situation');
                $table->string('housing_situation');
                $table->string('economic_situation');
                $table->string('autonomy');
                $table->timestamps();

                $table->foreign('zone_id')->references('id')->on('zones');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void {
            Schema::dropIfExists('patients');
        }
    };
?>