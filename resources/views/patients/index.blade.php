@extends('layouts.app')

@section('title', __('Llistat de Pacients'))

@section('content')
<h1 class="text-3xl font-bold text-blue-800 mb-6">Listado de Pacientes</h1>
<table class="w-full border-collapse border border-gray-300">
    <thead class="bg-gray-200">
        <tr>
            <th class="border border-gray-300 p-2">DNI</th>
            <th class="border border-gray-300 p-2">Nombre</th>
            <th class="border border-gray-300 p-2">Fecha de Nacimiento</th>
            <th class="border border-gray-300 p-2">Dirección</th>
            <th class="border border-gray-300 p-2">Teléfono</th>
            <th class="border border-gray-300 p-2">Tarjeta Sanitaria</th>
            <th class="border border-gray-300 p-2">Email</th>
            <th class="border border-gray-300 p-2">Zona</th>
            <th class="border border-gray-300 p-2">Opcions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($patients as $patient)
            <tr class="hover:bg-gray-100">
                <td class="border border-gray-300 p-2">{{ $patient->dni }}</td>
                <td class="border border-gray-300 p-2">
                    <a href="{{ route('patients.show', $patient->id) }}" class="text-blue-700 hover:underline">{{ $patient->name }}</a>
                </td>
                <td class="border border-gray-300 p-2">{{ $patient->birth_date }}</td>
                <td class="border border-gray-300 p-2">{{ $patient->address }}</td>
                <td class="border border-gray-300 p-2">{{ $patient->phone_number }}</td>
                <td class="border border-gray-300 p-2">{{ $patient->health_card }}</td>
                <td class="border border-gray-300 p-2">{{ $patient->email }}</td>
                <td class="border border-gray-300 p-2">{{ $patient->zone->city ?? 'N/A' }}</td>
                @auth
                <td class="border border-gray-300 p-2 flex space-x-4">
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
@can('create', App\Models\Patient::class)
<button onclick="window.location.href='{{ route('patients.create') }}'" class="block mx-auto mt-6 p-4 bg-blue-800 text-white rounded border border-black text-center">Afegir Pacient</button>
@endcan
@endsection
