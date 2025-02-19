@extends('layouts.app')

@section('title', 'Editar Contacto de Emergencia')

@section('content')
    <h1 class="text-3xl font-bold text-blue-800 mb-6">Editar Contacto de Emergencia</h1>
    <form action="{{ route('contacts.update', $contact->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $contact->name) }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
                @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Número de Teléfono:</label>
            <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $contact->phone_number) }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
                @error('phone_number') border-red-500 @enderror">
            @error('phone_number')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="relationship" class="block text-sm font-medium text-gray-700 mb-1">Relación:</label>
            <input type="text" name="relationship" id="relationship" value="{{ old('relationship', $contact->relationship) }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
                @error('relationship') border-red-500 @enderror">
            @error('relationship')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="block mx-auto mt-6 p-4 bg-blue-800 text-white rounded border border-black text-center">
            Actualizar Contacto
        </button>
    </form>
@endsection
