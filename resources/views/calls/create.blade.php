@extends('layouts.content')

@section('title', 'Registrar Llamada')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('calls.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- TELEOPERADOR Y PACIENTE --}}
                        <div class="mb-4 flex flex-wrap md:flex-nowrap gap-1 md:gap-2">
                            {{-- TELEOPERADOR --}}
                            <div class="w-full md:w-1/2">
                                <label for="teleoperator_id" class="block text-gray-800 dark:text-white font-bold mb-2">Teleoperador <span class="text-red-500">*</span></label>
                                <select name="teleoperator_id" id="teleoperator_id" class="w-full rounded-md shadow-sm" required>
                                    @foreach ($teleoperators as $teleoperator)
                                        <option value="{{ $teleoperator->id }}" {{ old('teleoperator_id') == $teleoperator->id ? 'selected' : '' }}>{{ $teleoperator->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('teleoperator_id')" class="mt-2" />
                            </div>

                            {{-- PACIENTE --}}
                            <div class="w-full md:w-1/2">
                                <label for="patient_id" class="block text-gray-800 dark:text-white font-bold mb-2">Paciente <span class="text-red-500">*</span></label>
                                <select name="patient_id" id="patient_id" class="w-full rounded-md shadow-sm" required>
                                    @foreach ($patients as $patient)
                                        <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('patient_id')" class="mt-2" />
                            </div>
                        </div>

                        {{-- TIPO DE LLAMADA --}}
                        <div class="mb-4">
                            <label for="call_type" class="block text-gray-800 dark:text-white font-bold mb-2">Tipo de llamada <span class="text-red-500">*</span></label>
                            <select name="call_type" id="call_type" class="w-full rounded-md shadow-sm" required>
                                <option value="Entrante" {{ old('call_type') == 'Entrante' ? 'selected' : '' }}>Entrante</option>
                                <option value="Saliente" {{ old('call_type') == 'Saliente' ? 'selected' : '' }}>Saliente</option>
                            </select>
                            <x-input-error :messages="$errors->get('call_type')" class="mt-2" />
                        </div>

                        {{-- CATEGORÍA DE LLAMADA --}}
                        <div class="mb-4">
                            <label for="type" class="block text-gray-800 dark:text-white font-bold mb-2">Categoría de llamada <span class="text-red-500">*</span></label>
                            <select name="type" id="type" class="w-full rounded-md shadow-sm" required>
                                @foreach ([
                                    'Emergencia social', 'Emergencia sanitaria', 'Crisis soledad',
                                    'Alarma sin respuesta', 'Comunicacion no urgente', 'Notificar absencia',
                                    'Modificar datos personales', 'Llamada accidental', 'Peticion informacion',
                                    'Sugerencia queja reclamacion', 'Llamada social', 'Registrar cita medica',
                                    'Planificada', 'No planificada', 'Otros'
                                ] as $category)
                                    <option value="{{ $category }}" {{ old('type') == $category ? 'selected' : '' }}>{{ $category }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>

                        {{-- FECHA Y HORA DE LLAMADA --}}
                        <div class="mb-4">
                            <label for="call_time" class="block text-gray-800 dark:text-white font-bold mb-2">Fecha y hora de la llamada <span class="text-red-500">*</span></label>
                            <input type="datetime-local" name="call_time" id="call_time" value="{{ old('call_time') }}" class="w-full rounded-md shadow-sm" required>
                            <x-input-error :messages="$errors->get('call_time')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="title" class="block text-gray-800 dark:text-white font-bold mb-2">Título</label>
                            <textarea name="title" id="title" class="w-full rounded-md shadow-sm">{{ old('title') }}</textarea>
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        {{-- DESCRIPCIÓN --}}
                        <div class="mb-4">
                            <label for="description" class="block text-gray-800 dark:text-white font-bold mb-2">Descripción</label>
                            <textarea name="description" id="description" class="w-full rounded-md shadow-sm">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        {{-- ALERTA ASOCIADA --}}
                        <div class="mb-4">
                            <label for="alert_id" class="block text-gray-800 dark:text-white font-bold mb-2">Alerta asociada</label>
                            <select name="alert_id" id="alert_id" class="w-full rounded-md shadow-sm">
                                <option value="">Ninguna</option>
                                @foreach ($alerts as $alert)
                                    <option value="{{ $alert->id }}" {{ old('alert_id') == $alert->id ? 'selected' : '' }}>{{ $alert->description }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('alert_id')" class="mt-2" />
                        </div>

                        {{-- BOTONES --}}
                        <div class="flex flex-wrap">
                            <button type="button" onclick="window.location.href='/calls'" class="w-1/2 mt-2 mr-2 bg-gray-500 text-white font-medium py-3 px-4 rounded-lg shadow hover:bg-gray-600 focus:ring focus:ring-gray-300">
                                Volver a llamadas
                            </button>
                            <button type="submit" class="w-1/2 mt-2 ml-2 py-3 px-4 bg-blue-500 text-white font-medium rounded-lg shadow hover:bg-blue-600 focus:ring focus:ring-blue-300">
                                Registrar Llamada
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
