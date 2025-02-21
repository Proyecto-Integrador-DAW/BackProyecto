<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Call;
use App\Models\Patient;
use App\Models\User;
use App\Models\Zone;
use App\Models\Teleoperator;
use Illuminate\Foundation\Testing\WithFaker;

class CallTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $patient;
    protected $teleoperator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'), // Asegúrate de encriptar la contraseña
        ]);
        $this->token = JWTAuth::fromUser($this->user);
    
        // Crear una zona antes de asignarla a un teleoperador
        $zone = Zone::create([
            'city' => 'city1',
            'zone' => 'zone1',  // Ajusta según los campos de la tabla `zones`
        ]);
    
        // Crear un teleoperador
        $this->teleoperator = Teleoperator::create([
            'name' => 'Operador 1',
            'email' => 'operador1@example.com',
            'password' => bcrypt('password123'),
            'prefix' => '+34',
            'phone_number' => '987654321',
            'zone_id' => $zone->id, // Asigna la zona creada
            'hiring_date' => now(),
        ]);
    
        // Crear un paciente
        $this->patient = Patient::create([
            'name' => 'John Doe',
            'address' => '123 Main St',
            'phone_number' => '123456789',
            'health_card' => 'HC123456789',
            'email' => 'john.doe@example.com',
            'dni' => '12345678A',
            'birth_date' => '1990-01-01',
            'zone_id' => $zone->id, // Asigna la misma zona creada
            'associated_teleoperator_id' => $this->teleoperator->id,
            'personal_situation' => 'Stable',
            'health_situation' => 'Good',
            'housing_situation' => 'Apartment',
            'economic_situation' => 'Stable',
            'autonomy' => 'Independent',
        ]);
    }

    // Test para listar las llamadas
    public function test_can_list_calls()
    {
        // Crear una llamada
        $call = Call::create([
            'teleoperator_id' => $this->teleoperator->id,
            'patient_id' => $this->patient->id,
            'call_type' => 'Entrante',
            'type' => 'Emergencia sanitaria',
            'call_time' => now(),
            'title' => 'Llamada de prueba',
            'description' => 'Test call',
        ]);

        // Realizar la petición
        $response = $this->getJson('/api/calls', [
            'Authorization' => 'Bearer ' . $this->token
        ]);
        $response->assertStatus(200)
                 ->assertJsonCount(1, 'data') // Asegurar que haya una llamada
                 ->assertJsonFragment(['title' => $call->title]); // Verificar el contenido de la llamada
    }

    // Test para crear una llamada
    public function test_can_create_call()
    {
        // Crear datos para la llamada
        $data = [
            'patient_id' => $this->patient->id,
            'teleoperator_id' => $this->teleoperator->id,
            'call_type' => 'Saliente',
            'type' => 'Llamada social',
            'call_time' => now(),
            'title' => 'Nueva llamada',
            'description' => 'Emergency call',
        ];

        // Realizar la petición
        $response = $this->postJson('/api/calls', $data,[
            'Authorization' => 'Bearer ' . $this->token
        ]);

        // Verificar respuesta y estructura
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data' => ['id', 'patient_id', 'teleoperator_id', 'title', 'description'],
                 ])
                 ->assertJsonFragment(['title' => 'Nueva llamada']);
    }

    // Test para ver una llamada individual
    public function test_can_view_single_call()
    {
        // Crear una llamada
        $call = Call::create([
            'teleoperator_id' => $this->teleoperator->id,
            'patient_id' => $this->patient->id,
            'call_type' => 'Entrante',
            'type' => 'Emergencia social',
            'call_time' => now(),
            'title' => 'Llamada individual',
            'description' => 'Test call',
        ]);

        // Realizar la petición
        $response = $this->getJson("/api/calls/{$call->id}");

        // Verificar la respuesta
        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $call->id, 'title' => $call->title]);
    }

    // Test para actualizar una llamada
    public function test_can_update_call()
    {
        // Crear una llamada
        $call = Call::create([
            'teleoperator_id' => $this->teleoperator->id,
            'patient_id' => $this->patient->id,
            'call_type' => 'Entrante',
            'type' => 'Emergencia sanitaria',
            'call_time' => now(),
            'title' => 'Llamada previa',
            'description' => 'Old description',
        ]);

        // Datos para actualizar la llamada
        $updatedData = ['description' => 'Updated description'];

        // Realizar la petición de actualización
        $response = $this->putJson("/api/calls/{$call->id}", $updatedData,[
            'Authorization' => 'Bearer ' . $this->token
        ]);

        // Verificar respuesta
        $response->assertStatus(200)
                 ->assertJsonFragment(['description' => 'Updated description']);
    }

    // Test para eliminar una llamada
    public function test_can_delete_call()
    {
        // Crear una llamada
        $call = Call::create([
            'teleoperator_id' => $this->teleoperator->id,
            'patient_id' => $this->patient->id,
            'call_type' => 'Saliente',
            'type' => 'Llamada social',
            'call_time' => now(),
            'title' => 'Llamada para eliminar',
            'description' => 'Test call',
        ]);

        // Eliminar la llamada
        $response = $this->deleteJson("/api/calls/{$call->id}");
        $response->assertStatus(204);

        // Verificar que el registro esté "borrado" (softDeletes)
        $this->assertSoftDeleted('calls', ['id' => $call->id]);
    }
}
