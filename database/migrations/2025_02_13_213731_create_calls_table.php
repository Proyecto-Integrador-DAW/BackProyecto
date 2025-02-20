<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {

        /**
         * Run the migrations.
         */
        public function up() {
            Schema::create('calls', function (Blueprint $table) {
                $table->id();
                $table->foreignId('teleoperator_id')->constrained('teleoperators');
                $table->foreignId('patient_id')->constrained('patients');
                $table->enum('call_type', ['Entrante', 'Saliente']);
                $table->enum('type', [
                    'Emergencia social', 
                    'Emergencia sanitaria', 
                    'Crisis soledad', 
                    'Alarma sin respuesta', 
                    'Comunicacion no urgente',
                    'Notificar absencia', 
                    'Modificar datos personales', 
                    'Llamada accidental', 
                    'Peticion informacion',
                    'Sugerencia queja reclamacion', 
                    'Llamada social', 
                    'Registrar cita medica',
                    'Planificada',
                    'No planificada',
                    'Otros'
                ]);
                $table->timestamp('call_time');
                $table->text('description')->nullable();
                $table->foreignId('alert_id')->nullable()->constrained('alerts');
                $table->timestamps();
                $table->softDeletes();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void {
            Schema::dropIfExists('calls');
        }
    };
?>