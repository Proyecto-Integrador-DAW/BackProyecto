@extends('layouts.content')

@section('title', 'Crear Teleoperador')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('teleoperators.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        {{-- NOMBRE --}}
                        <div class="mb-4">
                            <label for="name" class="block text-gray-800 dark:text-white font-bold mb-2">Nombre completo <span class="text-red-500">*</span></label>
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


                        {{-- EMAIL Y CONTRASEÑA --}}
                        <div class="mb-4 flex flex-wrap md:flex-nowrap gap-1 md:gap-2">
                            {{-- EMAIL --}}
                            <div class="w-full md:w-1/2">
                                <label for="email" class="block text-gray-800 dark:text-white font-bold mb-2">Correo electrónico <span class="text-red-500">*</span></label>
                                <input type="email"
                                    name="email"
                                    id="email"
                                    value="{{ old('email') }}"
                                    class="w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('email') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                    required
                                >
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            {{-- PASSWORD --}}
                            <div class="w-full md:w-1/2">
                                <label for="password" class="block text-gray-800 dark:text-white font-bold mb-2">Contraseña <span class="text-red-500">*</span></label>
                                <input type="password"
                                    name="password"
                                    id="password"
                                    value="{{ old('password') }}"
                                    class="w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('password') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                    required
                                >
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                        </div>


                        {{-- PREFIJO Y TELÉFONO --}}
                        <div class="mb-4 flex flex-wrap md:flex-nowrap gap-1 md:gap-2">
                            {{-- PREFIJO --}}
                            <div class="w-full md:w-1/3">
                                <label for="prefix" class="block text-gray-800 dark:text-white font-bold mb-2">Prefijo <span class="text-red-500">*</span></label>
                                <input type="text"
                                    name="prefix"
                                    id="prefix"
                                    value="{{ old('prefix') }}"
                                    class="w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('prefix') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                    required
                                >
                                <x-input-error :messages="$errors->get('prefix')" class="mt-2" />
                            </div>

                            {{-- TELÉFONO --}}
                            <div class="w-full md:w-2/3">
                                <label for="phone_number" class="block text-gray-800 dark:text-white font-bold mb-2">Número de teléfono <span class="text-red-500">*</span></label>
                                <input type="text"
                                    name="phone_number"
                                    id="phone_number"
                                    value="{{ old('phone_number') }}"
                                    class="w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('phone_number') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                    required
                                >
                                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                            </div>
                        </div>


                        {{-- CÓDIGO Y ZONA --}}
                        <div class="mb-4 flex flex-wrap md:flex-nowrap gap-1 md:gap-2">
                            {{-- CÓDIGO --}}
                            <div class="w-full md:w-1/2">
                                <label for="code" class="block text-gray-800 dark:text-white font-bold mb-2">Código <span class="text-red-500">*</span></label>
                                <input type="number"
                                    name="code"
                                    id="code"
                                    value="{{ old('code') }}"
                                    class="dark:[color-scheme:dark] w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('code') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                    required
                                >
                                <x-input-error :messages="$errors->get('code')" class="mt-2" />
                            </div>

                            {{-- ZONA --}}
                            <div class="w-full md:w-1/2">
                                <label for="zone_id" class="block text-gray-800 dark:text-white font-bold mb-2">Zona <span class="text-red-500">*</span></label>
                                <select 
                                    name="zone_id"
                                    id="zone_id"
                                    class="w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('zone_id') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                    required
                                >
                                    @foreach ($zones as $zone)
                                        <option value="{{ $zone->id }}" {{ old('zone_id') == $zone->id ? 'selected' : '' }}>{{ $zone->city }} - {{ $zone->zone }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('zone_id')" class="mt-2" />
                            </div>
                        </div>


                        {{-- FECHA DE CONTRATACIÓN Y DE DESPIDO --}}
                        <div class="mb-4 flex flex-wrap md:flex-nowrap gap-1 md:gap-2">
                            {{-- FECHA DE CONTRATACIÓN --}}
                            <div class="w-full md:w-1/2">
                                <label for="hiring_date" class="block text-gray-800 dark:text-white font-bold mb-2">Fecha de contratación <span class="text-red-500">*</span></label>
                                <input type="date"
                                    name="hiring_date"
                                    id="hiring_date"
                                    value="{{ old('hiring_date') }}"
                                    class="dark:[color-scheme:dark] w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('hiring_date') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                    required
                                >
                                <x-input-error :messages="$errors->get('hiring_date')" class="mt-2" />
                            </div>

                            {{-- FECHA DE DESPIDO --}}
                            <div class="w-full md:w-1/2">
                                <label for="firing_date" class="block text-gray-800 dark:text-white font-bold mb-2">Fecha de despido</label>
                                <input type="date"
                                    name="firing_date"
                                    id="firing_date"
                                    value="{{ old('firing_date') }}"
                                    class="dark:[color-scheme:dark] w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('firing_date') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                >
                                <x-input-error :messages="$errors->get('firing_date')" class="mt-2" />
                            </div>
                        </div>


                        {{-- IDIOMAS --}}
                        <div class="mb-4">
                            <label class="block text-gray-800 dark:text-white font-bold mb-2">Idiomas <span class="text-red-500">*</span></label>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($languages as $language)
                                    <label class="flex items-center cursor-pointer bg-gray-200 dark:bg-gray-700 px-4 py-2 rounded-lg shadow-sm transition-all hover:bg-gray-300 dark:hover:bg-gray-600">
                                        <input type="checkbox" name="languages[]" value="{{ $language->id }}" class="hidden peer">
                                        <span class="text-gray-900 dark:text-gray-100 peer-checked:font-bold peer-checked:text-indigo-600 dark:peer-checked:text-indigo-400">{{ $language->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('languages')" class="mt-2" />
                        </div>


                        {{-- BOTONES --}}
                        <div class="flex flex-warp">
                            <button type="button" onclick="window.location.href='/teleoperators'" class="w-1/2 mt-2 mr-2 bg-gray-500 text-white font-medium py-3 px-4 rounded-lg shadow hover:bg-gray-600 focus:ring focus:ring-gray-300">
                                Volver a teleopreadores
                            </button>
                            <button type="submit" class="w-1/2 mt-2 ml-2 py-3 px-4 bg-blue-500 text-white font-medium rounded-lg shadow hover:bg-blue-600 focus:ring focus:ring-blue-300">
                                Crear Teleoperador
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
