@extends('layouts.content')

@section('title', 'Crear Contacto')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <form action="{{ route('contacts.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        {{-- NOMBRE --}}
                        <div class="mb-4">
                            <label for="name" class="block text-gray-800 dark:text-white font-bold mb-2">Nombre:</label>
                            <input type="text"
                                name="name"
                                id="name"
                                value="{{ old('name') }}"
                                class="w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('name') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                autofocus
                                required
                            >
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        {{-- TELÉFONO --}}
                        <div class="mb-4">
                            <label for="phone_number" class="block text-gray-800 dark:text-white font-bold mb-2">Número de Teléfono:</label>
                            <input type="text"
                                name="phone_number"
                                id="phone_number"
                                value="{{ old('phone_number') }}"
                                class="w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('phone_number') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                required
                            >
                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                        </div>

                        {{-- RELACIÓN --}}
                        <div class="mb-4">
                            <label for="relationship" class="block text-gray-800 dark:text-white font-bold mb-2">Relación:</label>
                            <input type="text"
                                name="relationship"
                                id="relationship"
                                value="{{ old('relationship') }}"
                                class="w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('relationship') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                required
                            >
                            <x-input-error :messages="$errors->get('relationship')" class="mt-2" />
                        </div>

                        {{-- BOTONES --}}
                        <div class="flex flex-warp">
                            <button type="button" onclick="window.location.href='/contacts'" class="w-1/2 mt-2 mr-2 bg-gray-500 text-white font-medium py-3 px-4 rounded-lg shadow hover:bg-gray-600 focus:ring focus:ring-gray-300">
                                Volver a Contactos
                            </button>
                            <button type="submit" class="w-1/2 mt-2 ml-2 py-3 px-4 bg-blue-500 text-white font-medium rounded-lg shadow hover:bg-blue-600 focus:ring focus:ring-blue-300">
                                Crear Contacto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
