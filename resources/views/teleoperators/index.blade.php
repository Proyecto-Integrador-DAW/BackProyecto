@extends('layouts.app')

@section('title', __('Llistat de Teleoperadors'))

@section('content')
<h1 class="text-3xl font-bold text-blue-800 mb-6">Llistat de Teleoperadors</h1>
<table class="w-full border-collapse border border-gray-300">
    <thead class="bg-gray-200">
        <tr>
            <th class="border border-gray-300 p-2">Nombre</th>
            <th class="border border-gray-300 p-2">Email</th>
            <th class="border border-gray-300 p-2">Telèfono</th>
            <th class="border border-gray-300 p-2">Zona</th>
            <th class="border border-gray-300 p-2">Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($teleoperators as $teleoperator)
            <tr class="hover:bg-gray-100">
                <td class="border border-gray-300 p-2">{{ $teleoperator->name }}</td>
                <td class="border border-gray-300 p-2">{{ $teleoperator->email }}</td>
                <td class="border border-gray-300 p-2">{{ $teleoperator->prefix }} {{ $teleoperator->phone_number }}</td>
                <td class="border border-gray-300 p-2">{{ $teleoperator->zone->city ?? 'N/A' }}</td>
                @auth
                <td class="border border-gray-300 p-2 flex space-x-4">
                    <a href="{{ route('teleoperators.show', $teleoperator->id) }}" class="text-green-600 hover:underline">Mostrar</a>
                    <a href="{{ route('teleoperators.edit', $teleoperator->id) }}" class="text-yellow-600 hover:underline">Editar</a>

                    <form action="{{ route('teleoperators.destroy', $teleoperator->id) }}" method="POST" onsubmit="return confirm('Estàs segur de voler esborrar aquest teleoperador?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                    </form>
                </td>
                @endauth
            </tr>
        @endforeach
    </tbody>
</table>
@can('create',$teleoperator)
<button onclick="window.location.href='{{ route('teleoperators.create') }}'" class="block mx-auto mt-6 p-4 bg-blue-800 text-white rounded border border-black text-center">Añadir Teleoperador</button>
@endcan
@endsection
