@extends('layouts.content')

@section('title', 'Editar Zona')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('zones.update', $zone->id) }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        {{-- CIUDAD Y ZONA --}}
                        <div class="mb-4 flex flex-wrap md:flex-nowrap gap-1 md:gap-2">
                            {{-- CIUDAD --}}
                            <div class="w-full md:w-1/2">
                                <label for="city" class="block text-gray-800 dark:text-white font-bold mb-2">Ciudad <span class="text-red-500">*</span></label>
                                <input type="text"
                                    name="city"
                                    id="city"
                                    class="w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('city') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                    value="{{ old('city', $zone->city) }}"
                                    required
                                    autofocus
                                >
                                <x-input-error :messages="$errors->get('city')" class="mt-2" />
                            </div>

                            {{-- ZONA --}}
                            <div class="w-full md:w-1/2">
                                <label for="zone" class="block text-gray-800 dark:text-white font-bold mb-2">Zona <span class="text-red-500">*</span></label>
                                <input type="text"
                                    name="zone"
                                    id="zone" 
                                    class="w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('zone') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                    value="{{ old('zone', $zone->zone) }}"
                                    required
                                >
                                <x-input-error :messages="$errors->get('zone')" class="mt-2" />
                            </div>
                        </div>


                        {{-- BOTONES --}}
                        <div class="flex flex-warp">
                            <button type="button" onclick="window.location.href='/zones'" class="w-1/2 mt-2 mr-2 bg-gray-500 text-white font-medium py-3 px-4 rounded-lg shadow hover:bg-gray-600 focus:ring focus:ring-gray-300">
                                Volver a zonas
                            </button>
                            <button type="submit" class="w-1/2 mt-2 ml-2 py-3 px-4 bg-blue-500 text-white font-medium rounded-lg shadow hover:bg-blue-600 focus:ring focus:ring-blue-300">
                                Editar Zona
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection