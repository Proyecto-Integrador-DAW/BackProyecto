@extends('layouts.app')

@section('title', __('Listado de Contactos de Emergencia'))

@section('content')
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
                    <a href="{{ route('teleoperators.show', $contact->id) }}" class="text-green-600 hover:underline">Mostrar</a>
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
