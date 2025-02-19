@extends('layouts.app')

@section('title', 'Añadir Teleoperador')

@section('content')
    <h1 class="text-3xl font-bold text-blue-800 mb-6">Añadir Teleoperador</h1>
    <form action="{{ route('teleoperators.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
                @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
                @error('email') border-red-500 @enderror">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="prefix" class="block text-sm font-medium text-gray-700 mb-1">Prefijo:</label>
            <input type="text" name="prefix" id="prefix" value="{{ old('prefix') }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
                @error('prefix') border-red-500 @enderror">
            @error('prefix')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Número de teléfono:</label>
            <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
                @error('phone_number') border-red-500 @enderror">
            @error('phone_number')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="zone_id" class="block text-sm font-medium text-gray-700 mb-1">Zona:</label>
            <select name="zone_id" id="zone_id" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
                @error('zone_id') border-red-500 @enderror">
                <option value="">Seleccione una zona</option>
                @foreach ($zones as $zone)
                    <option value="{{ $zone->id }}">{{ $zone->city }} - {{ $zone->zone }}</option>
                @endforeach
            </select>
            @error('zone_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="hiring_date" class="block text-sm font-medium text-gray-700 mb-1">Fecha de contratación:</label>
            <input type="date" name="hiring_date" id="hiring_date" value="{{ old('hiring_date') }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
                @error('hiring_date') border-red-500 @enderror">
            @error('hiring_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Código:</label>
            <input type="text" name="code" id="code" value="{{ old('code') }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
                @error('code') border-red-500 @enderror">
            @error('code')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="firing_date" class="block text-sm font-medium text-gray-700 mb-1">Fecha de despido (opcional):</label>
            <input type="date" name="firing_date" id="firing_date" value="{{ old('firing_date') }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
                @error('firing_date') border-red-500 @enderror">
            @error('firing_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Idiomas:</label>
            @foreach ($languages as $language)
                <div class="flex items-center">
                    <input type="checkbox" name="languages[]" value="{{ $language->id }}"
                        class="mr-2 border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <span class="text-gray-700">{{ $language->name }}</span>
                </div>
            @endforeach
            @error('languages')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
        class="block mx-auto mt-6 p-4 bg-blue-800 text-white rounded border border-black text-center">
            Añadir Teleoperador
        </button>
    </form>
@endsection
