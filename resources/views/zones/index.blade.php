@extends('layouts.app')

@section('title', __('Llistat de Zones'))

@section('content')
<h1 class="text-3xl font-bold text-blue-800 mb-6">Llistat de Zones</h1>
<table class="w-full border-collapse border border-gray-300">
    <thead class="bg-gray-200">
        <tr>
            <th class="border border-gray-300 p-2">Ciutat</th>
            <th class="border border-gray-300 p-2">Zona</th>
            <th class="border border-gray-300 p-2">Opcions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($zones as $zone)
            <tr class="hover:bg-gray-100">
                <td class="border border-gray-300 p-2">{{ $zone->city }}</td>
                <td class="border border-gray-300 p-2">{{ $zone->zone }}</td>
                @auth
                <td class="border border-gray-300 p-2 flex space-x-4">
                    <a href="{{ route('zones.show', $zone->id) }}" class="text-green-600 hover:underline">Mostrar</a>
                    <a href="{{ route('zones.edit', $zone->id) }}" class="text-yellow-600 hover:underline">Editar</a>
                    <form action="{{ route('zones.destroy', $zone->id) }}" method="POST" onsubmit="return confirm('Estàs segur de voler esborrar aquesta zona?');" class="inline">
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
@can('create', App\Models\Zone::class)
<button onclick="window.location.href='{{ route('zones.create') }}'" class="block mx-auto mt-6 p-4 bg-blue-800 text-white rounded border border-black text-center">Afegir Zona</button>
@endcan
@endsection
