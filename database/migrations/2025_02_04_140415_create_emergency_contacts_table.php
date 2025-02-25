<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {

        /**
         * Run the migrations.
         */
        public function up(): void {
            Schema::create('emergency_contacts', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('phone_number')->unique();
                $table->string('relationship');
                $table->unsignedBigInteger('created_by')->nullable();
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('created_by')->references('id')->on('teleoperators')->onDelete('set null');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void {
            Schema::dropIfExists('emergency_contacts');
        }
    };
?>