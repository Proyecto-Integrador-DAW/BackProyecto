@extends('layouts.app')

@section('title', "Detall del Pacient")

@section('content')
<div class="pacient-detall border rounded-lg shadow-md p-4 bg-white">
    <h2 class="text-xl font-bold text-blue-800">{{ $patient->name }}</h2>
    
    <p><strong>DNI:</strong> {{ $patient->dni }}</p>
    <p><strong>Data de naixement:</strong> {{ $patient->birth_date }}</p>
    <p><strong>Adreça:</strong> {{ $patient->address }}</p>
    <p><strong>Telèfon:</strong> {{ $patient->phone_number }}</p>
    <p><strong>Targeta Sanitària:</strong> {{ $patient->health_card }}</p>
    <p><strong>Email:</strong> {{ $patient->email }}</p>
    <p><strong>Zona:</strong> {{ $patient->zone->city ?? 'N/A' }}</p>
    
    <p><strong>Situació Personal:</strong> {{ $patient->personal_situation }}</p>
    <p><strong>Situació de Salut:</strong> {{ $patient->health_situation }}</p>
    <p><strong>Situació d'Habitatge:</strong> {{ $patient->housing_situation }}</p>
    <p><strong>Situació Econòmica:</strong> {{ $patient->economic_situation }}</p>
    <p><strong>Autonomia:</strong> {{ $patient->autonomy }}</p>
    
    <p><strong>Contactes d'Emergència:</strong></p>
    @if ($patient->emergencyContacts->isNotEmpty())
        <ul class="list-disc list-inside">
            @foreach ($patient->emergencyContacts as $contact)
                <li>{{ $contact->name }} ({{ $contact->phone_number }})</li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-500">Sense contactes d'emergència</p>
    @endif
    
    <div class="mt-4 flex space-x-4">
        <a href="{{ route('patients.index') }}" class="text-blue-600 hover:underline">Tornar al llistat</a>
        @can('update', $patient)
        <a href="{{ route('patients.edit', $patient->id) }}" class="text-yellow-600 hover:underline">Editar</a>
        @endcan
        @can('delete', $patient)
        <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" onsubmit="return confirm('Estàs segur de voler esborrar aquest pacient?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
        </form>
        @endcan
    </div>
</div>
@endsection
