@extends('layouts.content')

@section('title', 'Paciente ' . $patient->name)
@section('content')
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center space-y-6">

                    <h2 class="text-4xl font-bold text-gray-800 dark:text-white">{{ $patient->name }}</h2>

                    <div class="text-left space-y-2">
                        <p class="text-xl"><strong>DNI:</strong> {{ $patient->dni }}</p>
                        <p class="text-xl"><strong>Data de naixement:</strong> {{ $patient->birth_date }}</p>
                        <p class="text-xl"><strong>Adreça:</strong> {{ $patient->address }}</p>
                        <p class="text-xl"><strong>Telèfon:</strong> {{ $patient->phone_number }}</p>
                        <p class="text-xl"><strong>Targeta Sanitària:</strong> {{ $patient->health_card }}</p>
                        <p class="text-xl"><strong>Email:</strong> {{ $patient->email }}</p>
                        <p class="text-xl"><strong>Zona:</strong> {{ $patient->zone->city }} - {{ $patient->zone->zone }}</p>
                    </div>

                    <div class="text-left space-y-2">
                        <p class="text-xl"><strong>Situació Personal:</strong> {{ $patient->personal_situation }}</p>
                        <p class="text-xl"><strong>Situació de Salut:</strong> {{ $patient->health_situation }}</p>
                        <p class="text-xl"><strong>Situació d'Habitatge:</strong> {{ $patient->housing_situation }}</p>
                        <p class="text-xl"><strong>Situació Econòmica:</strong> {{ $patient->economic_situation }}</p>
                        <p class="text-xl"><strong>Autonomia:</strong> {{ $patient->autonomy }}</p>
                    </div>

                    <div class="text-left">
                        <p class="font-bold text-xl">Contactos de emergencia:</p>
                        @if ($patient->emergencyContacts->isNotEmpty())
                            <ul class="list-disc list-inside">
                                @foreach ($patient->emergencyContacts as $contact)
                                    <li><a href="{{ route('contacts.show', $contact->id) }}" class="text-cyan-600 dark:text-cyan-300 hover:underline">{{ $contact->name }}</a> - ({{ $contact->phone_number }})</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500">Este paciente no tiene contactos de emergencia registrados.</p>
                        @endif
                    </div>

                    <!-- Botón volver -->
                    <button type="button" onclick="window.location.href='/patients'"
                        class="w-full mt-8 bg-gray-500 text-white font-medium py-2 px-4 rounded-lg shadow hover:bg-gray-600 focus:ring focus:ring-gray-300">
                        Volver al listado
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
