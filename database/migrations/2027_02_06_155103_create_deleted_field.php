<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Obtenemos las tablas de la base de datos
        $tables = DB::select('SHOW TABLES');

        // Iteramos por todas las tablas
        foreach ($tables as $table) {
            $tableName = $table->{'Tables_in_' . env('DB_DATABASE')}; // Extrae el nombre de la tabla

            // Añadimos softDeletes a las tablas que no tienen la columna 'deleted_at'
            Schema::table($tableName, function (Blueprint $table) {
                if (!Schema::hasColumn($table->getTable(), 'deleted')) {
                    $table->softDeletes();
                }
            });
        }
    }

    public function down()
    {
        // Obtenemos las tablas de la base de datos
        $tables = DB::select('SHOW TABLES');

        // Iteramos por todas las tablas
        foreach ($tables as $table) {
            $tableName = $table->{'Tables_in_' . env('DB_DATABASE')}; // Extrae el nombre de la tabla

            // Eliminamos la columna 'deleted_at' en las tablas que la tienen
            Schema::table($tableName, function (Blueprint $table) {
                if (Schema::hasColumn($table->getTable(), 'deleted')) {
                    $table->dropSoftDeletes();
                }
            });
        }
    }
};
