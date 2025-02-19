@extends('layouts.app')

@section('title', 'Añadir Paciente')

@section('content')
    <h1 class="text-3xl font-bold text-blue-800 mb-6">Añadir Paciente</h1>
    <form action="{{ route('patients.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto">
        @csrf

        <div class="mb-4">
            <label for="dni" class="block text-sm font-medium text-gray-700 mb-1">DNI:</label>
            <input type="text" name="dni" id="dni" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('dni') border-red-500 @enderror">
            @error('dni')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre:</label>
            <input type="text" name="name" id="name" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-1">Fecha de Nacimiento:</label>
            <input type="date" name="birth_date" id="birth_date" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('birth_date') border-red-500 @enderror">
            @error('birth_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Dirección:</label>
            <input type="text" name="address" id="address" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('address') border-red-500 @enderror">
            @error('address')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Número de Teléfono:</label>
            <input type="text" name="phone_number" id="phone_number" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('phone_number') border-red-500 @enderror">
            @error('phone_number')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="health_card" class="block text-sm font-medium text-gray-700 mb-1">Tarjeta Sanitaria:</label>
            <input type="text" name="health_card" id="health_card" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('health_card') border-red-500 @enderror">
            @error('health_card')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico:</label>
            <input type="email" name="email" id="email" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror">
            @error('email')
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
            <label for="personal_situation" class="block text-sm font-medium text-gray-700 mb-1">Situación Personal:</label>
            <input type="text" name="personal_situation" id="personal_situation" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('personal_situation') border-red-500 @enderror">
            @error('personal_situation')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="health_situation" class="block text-sm font-medium text-gray-700 mb-1">Situación de Salud:</label>
            <input type="text" name="health_situation" id="health_situation" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('health_situation') border-red-500 @enderror">
            @error('health_situation')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="housing_situation" class="block text-sm font-medium text-gray-700 mb-1">Situación de Vivienda:</label>
            <input type="text" name="housing_situation" id="housing_situation" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('housing_situation') border-red-500 @enderror">
            @error('housing_situation')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="economic_situation" class="block text-sm font-medium text-gray-700 mb-1">Situación Económica:</label>
            <input type="text" name="economic_situation" id="economic_situation" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('economic_situation') border-red-500 @enderror">
            @error('economic_situation')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="autonomy" class="block text-sm font-medium text-gray-700 mb-1">Autonomía:</label>
            <input type="text" name="autonomy" id="autonomy" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('autonomy') border-red-500 @enderror">
            @error('autonomy')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="block mx-auto mt-6 p-4 bg-blue-800 text-white rounded border border-black text-center">
            Añadir Paciente
        </button>
    </form>
@endsection
