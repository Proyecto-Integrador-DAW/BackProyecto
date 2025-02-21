@extends('layouts.content')

@section('title', 'Contactos')
@section('content')
    <div class="py-12 mx-auto sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                <span class="text-lg">{{ session('success') }}</span>
                @if (session('id'))
                    <span class="text-lg">&nbsp;Para ver el contacto de emergencia, pulse <a href="{{ route('contacts.show', session('id')) }}" class="font-semibold underline hover:no-underline">aquí</a>.</span>
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
                    @can('create', \App\Models\Contacts::class)
                        <a href="{{ route('contacts.create') }}" class="bg-lime-500 p-2 rounded-[10px]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-white" style="width: 1.5rem; display:inline">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </a>
                    @endcan
                @endsection

                @if (!$contacts->isEmpty())
                @else
                    <div class="p-4 text-center text-gray-800 dark:text-gray-300 bg-gray-200 dark:bg-gray-800">
                        <h1 class="text-lg">NO HAY ZONAS AÚN</h1>
                    </div>
                @endif
            </div>
        </div>
    </div>


<h1 class="text-3xl font-bold text-blue-800 mb-6">Listado de Contactos de Emergencia</h1>
<table class="w-full border-collapse border border-gray-300">
    <thead class="bg-gray-200">
        <tr>
            <th class="border border-gray-300 p-2">Nombre</th>
            <th class="border border-gray-300 p-2">Teléfono</th>
            <th class="border border-gray-300 p-2">Relación</th>
            <th class="border border-gray-300 p-2">Creado por</th>
            <th class="border border-gray-300 p-2">Pacientes Asociados</th>
            <th class="border border-gray-300 p-2">Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($emergencyContacts as $contact)
            <tr class="hover:bg-gray-100">
                <td class="border border-gray-300 p-2">{{ $contact->name }}</td>
                <td class="border border-gray-300 p-2">{{ $contact->phone_number }}</td>
                <td class="border border-gray-300 p-2">{{ $contact->relationship }}</td>
                <td class="border border-gray-300 p-2">{{ $contact->teleoperator->name ?? 'No disponible' }}</td>
                <td class="border border-gray-300 p-2">
                    @if ($contact->patients->isNotEmpty())
                        <ul>
                            @foreach ($contact->patients as $patient)
                                <li>{{ $patient->name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <span class="text-gray-500">Sin pacientes</span>
                    @endif
                </td>
                @auth
                <td class="border border-gray-300 p-2 flex space-x-4">
                    <a href="{{ route('contacts.show', $contact->id) }}" class="text-green-600 hover:underline">Mostrar</a>
                    @can('update', $contact)
                    <a href="{{ route('contacts.edit', $contact->id) }}" class="text-yellow-600 hover:underline">Editar</a>
                    @endcan
                    @can('delete', $contact)
                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este contacto de emergencia?');" class="inline">
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
@can('create', App\Models\EmergencyContact::class)
<button onclick="window.location.href='{{ route('contacts.create') }}'" class="block mx-auto mt-6 p-4 bg-blue-800 text-white rounded border border-black text-center">Añadir Contacto de Emergencia</button>
@endcan
@endsection
