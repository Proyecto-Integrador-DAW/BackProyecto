@extends('layouts.app')

@section('title', "Detall del Teleoperador")

@section('content')
<div class="teleoperador-detall border rounded-lg shadow-md p-4 bg-white">
    <h2 class="text-xl font-bold text-blue-800">{{ $teleoperator->name }}</h2>
    
    <p><strong>Email:</strong> {{ $teleoperator->email }}</p>
    <p><strong>Telèfono:</strong> {{ $teleoperator->prefix }} {{ $teleoperator->phone_number }}</p>
    <p><strong>Zona:</strong> {{ $teleoperator->zone->city ?? 'N/A' }}</p>
    <p><strong>Fecha de contratación:</strong> {{ $teleoperator->hiring_date ?? 'No disponible' }}</p>
    <p><strong>Fecha de despido:</strong> {{ $teleoperator->firing_date ?? 'Aún no ha sido despedido' }}</p>
    <p><strong>Código:</strong> {{ $teleoperator->code ?? 'No disponible' }}</p>
    
    <p><strong>Idiomas:</strong></p>
    @if ($teleoperator->languages->isNotEmpty())
        <ul class="list-disc list-inside">
            @foreach ($teleoperator->languages as $language)
                <li>{{ $language->name }}</li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-500">Sin idiomas registrados</p>
    @endif
    
    <div class="mt-4 flex space-x-4">
        <a href="{{ route('teleoperators.index') }}" class="text-blue-600 hover:underline">Tornar al llistat</a>
        @can('update', $teleoperator)
        <a href="{{ route('teleoperators.edit', $teleoperator->id) }}" class="text-yellow-600 hover:underline">Editar</a>
        @endcan
        @can('delete', $teleoperator)
        <form action="{{ route('teleoperators.destroy', $teleoperator->id) }}" method="POST" onsubmit="return confirm('Estàs segur de voler esborrar aquest teleoperador?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
        </form>
        @endcan
    </div>
</div>
@endsection
