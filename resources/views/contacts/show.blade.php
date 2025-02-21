@extends('layouts.app')

@section('title', "Detalle del Contacto de Emergencia")

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100 text-center space-y-6">
                <h2 class="text-xl font-bold text-blue-800">{{ $contact->name }}</h2>
                <div class="text-left space-y-2">
                <p><strong>Teléfono:</strong> {{ $contact->phone_number }}</p>
                <p><strong>Relación:</strong> {{ $contact->relationship }}</p>
                <p><strong>Creado por:</strong> {{ $contact->teleoperator->name ?? 'No disponible' }}</p>
    
                <p><strong>Pacientes Asociados:</strong></p>
                @if ($contact->patients->isNotEmpty())
                    <ul class="list-disc list-inside">
                        @foreach ($contact->patients as $patient)
                            <li>{{ $patient->name }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">Sin pacientes</p>
                @endif
                </div>
                <!-- Botón volver -->
                <button type="button" onclick="window.location.href='/teleoperators'"
                class="w-full mt-8 bg-gray-500 text-white font-medium py-2 px-4 rounded-lg shadow hover:bg-gray-600 focus:ring focus:ring-gray-300">
                Volver al listado
                </button>
            </div>
        </div>
    </div>
</div>
@endsection