@extends('layouts.content')

@section('title', 'Editar Paciente')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('patients.update', $patient->id) }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')


                        {{-- NOMBRE --}}
                        <div class="mb-4">
                            <label for="name" class="block text-gray-800 dark:text-white font-bold mb-2">Nombre <span class="text-red-500">*</span></label>
                            <input type="text"
                                name="name"
                                id="name"
                                value="{{ old('name', $patient->name) }}"
                                class="w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('name') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                required
                            >
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>


                        {{-- DNI Y FECHA DE NACIMIENTO --}}
                        <div class="mb-4 flex flex-wrap md:flex-nowrap gap-1 md:gap-2">
                            {{-- DNI --}}
                            <div class="w-full md:w-1/2">
                                <label for="dni" class="block text-gray-800 dark:text-white font-bold mb-2">DNI <span class="text-red-500">*</span></label>
                                <input type="text"
                                    name="dni"
                                    id="dni"
                                    value="{{ old('dni', $patient->dni) }}"
                                    class="w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('dni') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                    required
                                >
                                <x-input-error :messages="$errors->get('dni')" class="mt-2" />
                            </div>

                            {{-- FECHA DE NACIMIENTO --}}
                            <div class="w-full md:w-1/2">
                                <label for="birth_date" class="block text-gray-800 dark:text-white font-bold mb-2">Fecha de Nacimiento <span class="text-red-500">*</span></label>
                                <input type="date"
                                    name="birth_date"
                                    id="birth_date"
                                    value="{{ old('birth_date', $patient->birth_date) }}"
                                    class="dark:[color-scheme:dark] w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('birth_date') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                    required
                                >
                                @error('birth_date')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>


                        {{-- DIRECCIÓN Y TELÉFONO --}}
                        <div class="mb-4 flex flex-wrap md:flex-nowrap gap-1 md:gap-2">
                            {{-- DIRECCIÓN --}}
                            <div class="w-full md:w-1/2">
                                <label for="address" class="block text-gray-800 dark:text-white font-bold mb-2">Dirección <span class="text-red-500">*</span></label>
                                <input type="text"
                                    name="address"
                                    id="address"
                                    value="{{ old('address', $patient->address) }}"
                                    class="w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('address') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                    required
                                >
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>

                            {{-- TELÉFONO --}}
                            <div class="w-full md:w-1/2">
                                <label for="phone_number" class="block text-gray-800 dark:text-white font-bold mb-2">Número de teléfono <span class="text-red-500">*</span></label>
                                <input type="text"
                                    name="phone_number"
                                    id="phone_number"
                                    value="{{ old('phone_number', $patient->phone_number) }}"
                                    class="w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('phone_number') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                    required
                                >
                                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                            </div>
                        </div>


                        {{-- EMAIL Y ZONA --}}
                        <div class="mb-4 flex flex-wrap md:flex-nowrap gap-1 md:gap-2">
                            {{-- EMAIL --}}
                            <div class="w-full md:w-1/2">
                                <label for="email" class="block text-gray-800 dark:text-white font-bold mb-2">Correo electrónico <span class="text-red-500">*</span></label>
                                <input type="email"
                                    name="email"
                                    id="email"
                                    value="{{ old('email', $patient->email) }}"
                                    class="w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('email') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                    required
                                >
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
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
                                        <option value="{{ $zone->id }}" {{ old('zone_id', $patient->zone_id) == $zone->id ? 'selected' : '' }}>{{ $zone->city }} - {{ $zone->zone }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('zone_id')" class="mt-2" />
                            </div>
                        </div>


                        {{-- TELEOPERADOR Y TARJETA SANITARIA --}}
                        <div class="mb-4 flex flex-wrap md:flex-nowrap gap-1 md:gap-2">
                            {{-- TELEOPERADOR --}}
                            <div class="w-full md:w-1/2">
                                <label for="associated_teleoperator_id" class="block text-gray-800 dark:text-white font-bold mb-2">Teleoperador</label>
                                <select 
                                    name="associated_teleoperator_id"
                                    id="associated_teleoperator_id"
                                    class="w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('zone_id') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                >
                                    <option value="">Sin teleoperador</option>
                                    @foreach ($teleoperators as $teleoperator)
                                        <option value="{{ $teleoperator->id }}" {{ old('associated_teleoperator_id', $patient->associated_teleoperator_id) == $teleoperator->id ? 'selected' : '' }}>{{ $teleoperator->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('associated_teleoperator_id')" class="mt-2" />
                            </div>

                            {{-- TARJETA SANITARIA --}}
                            <div class="w-full md:w-1/2">
                                <label for="health_card" class="block text-gray-800 dark:text-white font-bold mb-2">Tarjeta Sanitaria:</label>
                                <input type="text"
                                    name="health_card"
                                    id="health_card"
                                    value="{{ old('health_card', $patient->health_card) }}"
                                    class="w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('health_card') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                    required
                                >
                                <x-input-error :messages="$errors->get('health_card')" class="mt-2" />
                            </div>
                        </div>


                        {{-- SITUACIÓN PERSONAL --}}
                        <div class="mb-4">
                            <label for="personal_situation" class="block text-gray-800 dark:text-white font-bold mb-2">Situación Personal <span class="text-red-500">*</span></label>
                            <textarea
                                name="personal_situation"
                                id="personal_situation"
                                rows="4"
                                class="dark:[color-scheme:dark] w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('personal_situation') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                required
                            >{{ old('personal_situation', $patient->personal_situation) }}</textarea>
                            <x-input-error :messages="$errors->get('personal_situation')" class="mt-2" />
                        </div>


                        {{-- SITUACIÓN DE SALUD --}}
                        <div class="mb-4">
                            <label for="health_situation" class="block text-gray-800 dark:text-white font-bold mb-2">Situación de Salud <span class="text-red-500">*</span></label>
                            <textarea
                                name="health_situation"
                                id="health_situation"
                                rows="4"
                                class="dark:[color-scheme:dark] w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('health_situation') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                required
                            >{{ old('health_situation', $patient->health_situation) }}</textarea>
                            <x-input-error :messages="$errors->get('health_situation')" class="mt-2" />
                        </div>


                        {{-- SITUACIÓN EN CASA --}}
                        <div class="mb-4">
                            <label for="housing_situation" class="block text-gray-800 dark:text-white font-bold mb-2">Situación de Vivienda <span class="text-red-500">*</span></label>
                            <textarea
                                name="housing_situation"
                                id="housing_situation"
                                rows="4"
                                class="dark:[color-scheme:dark] w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('health_situation') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                required
                            >{{ old('housing_situation', $patient->housing_situation) }}</textarea>
                            <x-input-error :messages="$errors->get('housing_situation')" class="mt-2" />
                        </div>


                        {{-- SITUACIÓN ECONÓMICA --}}
                        <div class="mb-4">
                            <label for="economic_situation" class="block text-gray-800 dark:text-white font-bold mb-2">Situación Económica <span class="text-red-500">*</span></label>
                            <textarea
                                name="economic_situation"
                                id="economic_situation"
                                rows="4"
                                class="dark:[color-scheme:dark] w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('health_situation') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                required
                            >{{ old('economic_situation', $patient->economic_situation) }}</textarea>
                            <x-input-error :messages="$errors->get('economic_situation')" class="mt-2" />
                        </div>


                        {{-- AUTONOMÍA --}}
                        <div class="mb-4">
                            <label for="autonomy" class="block text-gray-800 dark:text-white font-bold mb-2">Autonomía <span class="text-red-500">*</span></label>
                            <textarea
                                name="autonomy"
                                id="autonomy"
                                rows="4"
                                class="dark:[color-scheme:dark] w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm @error('health_situation') border-red-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                required
                            >{{ old('autonomy', $patient->autonomy) }}</textarea>
                            <x-input-error :messages="$errors->get('autonomy')" class="mt-2" />
                        </div>


                        {{-- BOTONES --}}
                        <div class="flex flex-warp">
                            <button type="button" onclick="window.location.href='/patients'" class="w-1/2 mt-2 mr-2 bg-gray-500 text-white font-medium py-3 px-4 rounded-lg shadow hover:bg-gray-600 focus:ring focus:ring-gray-300">
                                Volver al listado de pacientes
                            </button>
                            <button type="submit" class="w-1/2 mt-2 ml-2 py-3 px-4 bg-blue-500 text-white font-medium rounded-lg shadow hover:bg-blue-600 focus:ring focus:ring-blue-300">
                                Crear Paciente
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
