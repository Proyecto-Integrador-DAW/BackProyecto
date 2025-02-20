<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {

        /**
         * Run the migrations.
         */
        public function up(): void {
            Schema::create('alert_subtypes', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('alert_type_id');
                $table->string('name');
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('alert_type_id')->references('id')->on('alert_types')->onDelete('cascade');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void {
            Schema::dropIfExists('alert_subtypes');
        }
    };
?>