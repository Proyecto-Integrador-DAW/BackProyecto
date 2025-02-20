<?php

use App\Models\Patient;
use App\Models\Call;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

/**
 * Test: Obtener lista de pacientes
 */
test('puede obtener la lista de pacientes', function () {
    Patient::factory()->count(3)->create();

    $response = $this->getJson('/api/patients');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'zone_id', 'created_at', 'updated_at']
            ]
        ]);
});

/**
 * Test: Crear un nuevo paciente
 */
test('puede crear un paciente', function () {
    $patientData = [
        'name' => 'John Doe',
        'zone_id' => 1,
        'phone' => '123456789'
    ];

    $response = $this->postJson('/api/patients', $patientData);

    $response->assertStatus(201)
        ->assertJson([
            'success' => true,
            'data' => ['name' => 'John Doe']
        ]);

    $this->assertDatabaseHas('patients', ['name' => 'John Doe']);
});

/**
 * Test: Obtener un paciente específico
 */
test('puede obtener un paciente por su ID', function () {
    $patient = Patient::factory()->create();

    $response = $this->getJson("/api/patients/{$patient->id}");

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'data' => ['id' => $patient->id]
        ]);
});

/**
 * Test: Actualizar un paciente
 */
test('puede actualizar un paciente', function () {
    $patient = Patient::factory()->create();
    $newData = ['name' => 'Jane Doe'];

    $response = $this->putJson("/api/patients/{$patient->id}", $newData);

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'data' => ['name' => 'Jane Doe']
        ]);

    $this->assertDatabaseHas('patients', ['id' => $patient->id, 'name' => 'Jane Doe']);
});

/**
 * Test: Eliminar un paciente
 */
test('puede eliminar un paciente', function () {
    $patient = Patient::factory()->create();

    $response = $this->deleteJson("/api/patients/{$patient->id}");

    $response->assertStatus(204);
    $this->assertDatabaseMissing('patients', ['id' => $patient->id]);
});

/**
 * Test: Obtener llamadas de un paciente
 */
test('puede obtener las llamadas de un paciente', function () {
    $patient = Patient::factory()->create();
    Call::factory()->count(2)->create(['patient_id' => $patient->id]);

    $response = $this->getJson("/api/patients/{$patient->id}/calls");

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'patient_id', 'call_time', 'created_at', 'updated_at']
            ]
        ]);
});
