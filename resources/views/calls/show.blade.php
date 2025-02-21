@extends('layouts.app')

@section('title', "Detalle de la Llamada")

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100 text-center space-y-6">
                <h2 class="text-4xl font-bold text-gray-800 dark:text-white">{{ $call->title ?? 'No disponible'}}</h2>

                <div class="text-left space-y-2">
                <p><strong>Teleoperador:</strong> {{ $call->teleoperator->name ?? 'No disponible' }}</p>
                <p><strong>Paciente:</strong> {{ $call->patient->name ?? 'No disponible' }}</p>
                <p><strong>Tipo de llamada:</strong> {{ $call->call_type }}</p>
                <p><strong>Categoría:</strong> {{ $call->type }}</p>
                <p><strong>Fecha y hora:</strong> {{ \Carbon\Carbon::parse($call->call_time)->format('d/m/Y H:i') }}</p>
    
                <p><strong>Descripción:</strong></p>
                <p class="bg-gray-100 p-2 rounded-md">{{ $call->description ?? 'No disponible' }}</p>

                <p><strong>Alerta Asociada:</strong> {{ $call->alert->description ?? 'Ninguna' }}</p>

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