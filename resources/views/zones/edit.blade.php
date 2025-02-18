@extends('layouts.app')

@section('title', 'Editar Zona')

@section('content')
    <h1 class="text-3xl font-bold text-blue-800 mb-6">Editar Zona</h1>
    <form action="{{ route('zones.update', $zone->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto">
        @csrf
        @method('PUT')
    
        <div class="mb-4">
            <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Ciutat:</label>
            <input type="text" name="city" id="city" value="{{ old('city', $zone->city) }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
                @error('city') border-red-500 @enderror">
            @error('city')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    
        <div class="mb-4">
            <label for="zone" class="block text-sm font-medium text-gray-700 mb-1">Zona:</label>
            <input type="text" name="zone" id="zone" value="{{ old('zone', $zone->zone) }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
                @error('zone') border-red-500 @enderror">
            @error('zone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    
        <button type="submit"
        class="block mx-auto mt-6 p-4 bg-blue-800 text-white rounded border border-black text-center">
            Actualizar Zona
        </button>
    </form>
@endsection
