@extends('layouts.app')

@section('title', 'Editar Paciente')

@section('content')
    <h1 class="text-3xl font-bold text-blue-800 mb-6">Editar Paciente</h1>
    <form action="{{ route('patients.update', $patient->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="dni" class="block text-sm font-medium text-gray-700 mb-1">DNI:</label>
            <input type="text" name="dni" id="dni" value="{{ old('dni', $patient->dni) }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
                @error('dni') border-red-500 @enderror">
            @error('dni')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $patient->name) }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
                @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-1">Fecha de nacimiento:</label>
            <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date', $patient->birth_date) }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
                @error('birth_date') border-red-500 @enderror">
            @error('birth_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Dirección:</label>
            <input type="text" name="address" id="address" value="{{ old('address', $patient->address) }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
                @error('address') border-red-500 @enderror">
            @error('address')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Número de teléfono:</label>
            <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $patient->phone_number) }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
                @error('phone_number') border-red-500 @enderror">
            @error('phone_number')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="health_card" class="block text-sm font-medium text-gray-700 mb-1">Tarjeta Sanitaria:</label>
            <input type="text" name="health_card" id="health_card" value="{{ old('health_card', $patient->health_card) }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
                @error('health_card') border-red-500 @enderror">
            @error('health_card')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico:</label>
            <input type="email" name="email" id="email" value="{{ old('email', $patient->email) }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
                @error('email') border-red-500 @enderror">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="zone_id" class="block text-sm font-medium text-gray-700 mb-1">Zona:</label>
            <select name="zone_id" id="zone_id" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
                @error('zone_id') border-red-500 @enderror">
                @foreach ($zones as $zone)
                    <option value="{{ $zone->id }}" {{ $zone->id == $patient->zone_id ? 'selected' : '' }}>
                        {{ $zone->city }} - {{ $zone->zone }}
                    </option>
                @endforeach
            </select>
            @error('zone_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="personal_situation" class="block text-sm font-medium text-gray-700 mb-1">Situación Personal:</label>
            <input type="text" name="personal_situation" id="personal_situation" value="{{ old('personal_situation', $patient->personal_situation) }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="health_situation" class="block text-sm font-medium text-gray-700 mb-1">Situación de Salud:</label>
            <input type="text" name="health_situation" id="health_situation" value="{{ old('health_situation', $patient->health_situation) }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="housing_situation" class="block text-sm font-medium text-gray-700 mb-1">Situación de Vivienda:</label>
            <input type="text" name="housing_situation" id="housing_situation" value="{{ old('housing_situation', $patient->housing_situation) }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="economic_situation" class="block text-sm font-medium text-gray-700 mb-1">Situación Económica:</label>
            <input type="text" name="economic_situation" id="economic_situation" value="{{ old('economic_situation', $patient->economic_situation) }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="autonomy" class="block text-sm font-medium text-gray-700 mb-1">Autonomía:</label>
            <input type="text" name="autonomy" id="autonomy" value="{{ old('autonomy', $patient->autonomy) }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <button type="submit" class="block mx-auto mt-6 p-4 bg-blue-800 text-white rounded border border-black text-center">
            Actualizar Paciente
        </button>
    </form>
@endsection
