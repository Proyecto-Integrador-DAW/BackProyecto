<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {

        /**
         * Run the migrations.
         */
        public function up(): void {
            Schema::create('alerts', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('alert_subtype_id');
                $table->string('title');
                $table->text('description');
                $table->enum('frequency', ['Puntual', 'Diaria', 'Varios días', 'Semanal', 'Mensual']);
                $table->json('days_of_week')->nullable();
                $table->unsignedBigInteger('zone_id');
                $table->timestamps();

                
                $table->foreign('zone_id')->references('id')->on('zones');
                $table->foreign('alert_subtype_id')->references('id')->on('alert_subtypes')->onDelete('cascade');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void {
            Schema::dropIfExists('alerts');
        }
    };
?>