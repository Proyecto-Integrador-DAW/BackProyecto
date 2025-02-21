@extends('layouts.content')

@section('title', 'Pacientes')
@section('content')
    <div class="py-12 mx-auto sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                <span class="text-lg">{{ session('success') }}</span>
                @if (session('id'))
                    <span class="text-lg">&nbsp;Para ver el paciente, pulse <a href="{{ route('patients.show', session('id')) }}" class="font-semibold underline hover:no-underline">aquí</a>.</span>
                @endif
            </div>
        @elseif (session('error'))
            <div class="bg-red-500 text-black p-4 mb-6 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <div class="max-w-9xl">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @section('create')
                    @can('create', \App\Models\Patient::class)
                        <a href="{{ route('patients.create') }}" class="bg-lime-500 p-2 rounded-[10px]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-white" style="width: 1.5rem; display:inline">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </a>
                    @endcan
                @endsection

                @if (!$patients->isEmpty())
                    <table class="min-w-full">
                        <thead>
                            <tr class="divide-x divide-gray-300 dark:divide-gray-700">
                                <th class="px-6 py-3 text-left font-bold text-gray-800 dark:text-gray-300 bg-gray-200 dark:bg-gray-800 rounded-tl-lg uppercase">DNI</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-800 dark:text-gray-300 bg-gray-200 dark:bg-gray-800 uppercase">Nombre</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-800 dark:text-gray-300 bg-gray-200 dark:bg-gray-800 uppercase">Fecha de Nacimiento</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-800 dark:text-gray-300 bg-gray-200 dark:bg-gray-800 uppercase">Dirección</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-800 dark:text-gray-300 bg-gray-200 dark:bg-gray-800 uppercase">Teléfono</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-800 dark:text-gray-300 bg-gray-200 dark:bg-gray-800 uppercase">Tarjeta Sanitaria</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-800 dark:text-gray-300 bg-gray-200 dark:bg-gray-800 uppercase">Email</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-800 dark:text-gray-300 bg-gray-200 dark:bg-gray-800 uppercase">Contactos Asociados</th>
                                @can('view', \App\Models\Teleoperator::class)
                                    <th class="px-6 py-3 text-left font-bold text-gray-800 dark:text-gray-300 bg-gray-200 dark:bg-gray-800 uppercase">Eliminado</th>
                                @else
                                    <th class="px-6 py-3 text-left font-bold text-gray-800 dark:text-gray-300 bg-gray-200 dark:bg-gray-800 uppercase">Zona</th>
                                @endcan
                                <th class="px-6 py-3 text-left font-bold text-gray-800 dark:text-gray-300 bg-gray-200 dark:bg-gray-800 rounded-tr-lg uppercase">Opciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300 dark:divide-gray-600">
                            @foreach ($patients as $patient)
                                <tr class="divide-x divide-gray-300 dark:divide-gray-600 dark:bg-[#2c3543]">

                                    {{-- DNI --}}
                                    <td class="px-6 py-4 text-md text-gray-800 dark:text-gray-300">{{ $patient->dni }}</td>

                                    {{-- NOMBRE --}}
                                    <td class="px-6 py-4 text-md text-gray-800 dark:text-gray-300">{{ $patient->name }}</td>

                                    {{-- CUMPLE --}}
                                    <td class="px-6 py-4 text-md text-gray-800 dark:text-gray-300">{{ dd($patient) }}</td>

                                    {{-- DIRECCIÓN --}}
                                    <td class="px-6 py-4 text-md text-gray-800 dark:text-gray-300">{{ $patient->address }}</td>

                                    {{-- NÚMERO DE TELÉFONO --}}
                                    <td class="px-6 py-4 text-md text-gray-800 dark:text-gray-300">{{ $patient->phone_number }}</td>

                                    {{-- TARGETA SANITARIA --}}
                                    <td class="px-6 py-4 text-md text-gray-800 dark:text-gray-300">{{ $patient->health_card }}</td>

                                    {{-- EMAIL --}}
                                    <td class="px-6 py-4 text-md text-gray-800 dark:text-gray-300">{{ $patient->email }}</td>

                                    {{-- CONTACTOS DE EMERGENCIA --}}
                                    <td class="px-6 py-4 text-md text-gray-800 dark:text-gray-300">
                                        @if ($patient->emergencyContacts->isNotEmpty())
                                            <ul>
                                                @foreach ($patient->emergencyContacts as $contact)
                                                    <li>{{ $contact->name }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="px-6 py-4 text-md text-gray-800 dark:text-gray-300">Sin contactos</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-md text-gray-800 dark:text-gray-300">{{ $patient->zone->city ?? 'N/A' }}</td>
                                    @auth
                                        <td class="px-6 py-4 text-md text-gray-800 dark:text-gray-300 flex space-x-4">
                                            <a href="{{ route('patients.show', $patient->id) }}" class="text-green-600 hover:underline">Mostrar</a>
                                            @can('update', $patient)
                                            <a href="{{ route('patients.edit', $patient->id) }}" class="text-yellow-600 hover:underline">Editar</a>
                                            @endcan
                                            @can('delete', $patient)
                                            <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" onsubmit="return confirm('Estàs segur de voler esborrar aquest pacient?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                            </form>
                                            @endcan
                                        </td>
                                    @endauth
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="p-4 text-center text-gray-800 dark:text-gray-300 bg-gray-200 dark:bg-gray-800">
                        <h1 class="text-lg">NO HAY PACIENTES AÚN</h1>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
