@extends('layouts.app')

@section('title', "Detalle del Contacto de Emergencia")

@section('content')
<div class="contacto-emergencia border rounded-lg shadow-md p-4 bg-white">
    <h2 class="text-xl font-bold text-blue-800">{{ $contact->name }}</h2>
    
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

    <div class="mt-4 flex space-x-4">
        <a href="{{ route('contacts.index') }}" class="text-blue-600 hover:underline">Volver al listado</a>
        @can('update', $contact)
        <a href="{{ route('contacts.edit', $contact->id) }}" class="text-yellow-600 hover:underline">Editar</a>
        @endcan
        @can('delete', $contact)
        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este contacto de emergencia?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
        </form>
        @endcan
    </div>
</div>
@endsection
