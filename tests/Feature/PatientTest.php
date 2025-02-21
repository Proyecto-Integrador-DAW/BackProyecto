<?php

use Illuminate\Support\Facades\Config;
use App\Models\Zone;
use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('puede crear un paciente correctamente', function () {
    app()->make('config')->set('app.debug', true);
    // Arrange: Crear una zona primero
    $zone = Zone::create([
        'name' => 'Zona Centro',
    ]);

    // Act: Crear un paciente
    $patient = Patient::create([
        'dni' => '12345678A',
        'name' => 'Juan Pérez',
        'birth_date' => '1990-05-15',
        'address' => 'Calle Falsa 123',
        'phone_number' => '123456789',
        'health_card' => '9876543210',
        'email' => 'juan@example.com',
        'zone_id' => $zone->id,
        'personal_situation' => 'Soltero',
        'health_situation' => 'Sano',
        'housing_situation' => 'Casa propia',
        'economic_situation' => 'Estable',
        'autonomy' => 'Independiente',
    ]);

    // Assert: Comprobar que se guardó en la BD
    expect($patient)->toBeInstanceOf(Patient::class);
    $this->assertDatabaseHas('patients', [
        'dni' => '12345678A',
        'name' => 'Juan Pérez',
    ]);
});

test('puede listar los pacientes', function () {
    // Arrange: Crear pacientes
    Patient::create([
        'dni' => '11111111B',
        'name' => 'María López',
        'birth_date' => '1985-08-10',
        'zone_id' => 1,
    ]);
    Patient::create([
        'dni' => '22222222C',
        'name' => 'Carlos Gómez',
        'birth_date' => '1992-12-20',
        'zone_id' => 1,
    ]);

    // Act: Obtener todos los pacientes
    $patients = Patient::all();

    // Assert: Verificar que se crearon correctamente
    expect($patients)->toHaveCount(2);
    expect($patients->pluck('name'))->toContain('María López', 'Carlos Gómez');
});

test('puede actualizar un paciente', function () {
    // Arrange: Crear un paciente
    $patient = Patient::create([
        'dni' => '33333333D',
        'name' => 'Ana Torres',
        'birth_date' => '2000-07-25',
        'zone_id' => 1,
    ]);

    // Act: Actualizar el nombre
    $patient->update(['name' => 'Ana Gutiérrez']);

    // Assert: Comprobar que se actualizó en la BD
    $this->assertDatabaseHas('patients', [
        'dni' => '33333333D',
        'name' => 'Ana Gutiérrez',
    ]);
});

test('puede eliminar un paciente', function () {
    // Arrange: Crear un paciente
    $patient = Patient::create([
        'dni' => '44444444E',
        'name' => 'Pedro Martínez',
        'birth_date' => '1980-03-18',
        'zone_id' => 1,
    ]);

    // Act: Eliminar el paciente
    $patient->delete();

    // Assert: Comprobar que ya no existe en la BD
    $this->assertDatabaseMissing('patients', [
        'dni' => '44444444E',
        'name' => 'Pedro Martínez',
    ]);
});

test('no se puede crear un paciente sin nombre', function () {
    // Esperar una excepción por restricción de la base de datos
    $this->expectException(\Illuminate\Database\QueryException::class);

    // Act: Intentar crear un paciente sin nombre
    Patient::create([
        'dni' => '55555555F',
        'birth_date' => '1995-11-30',
        'zone_id' => 1,
    ]);
});
