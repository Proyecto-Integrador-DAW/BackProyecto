@extends('layouts.content')

@section('title', 'Teleoperador ' . $teleoperator->name)
@section('content')
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center space-y-6">

                    <!-- Información del teleoperador -->
                    <h2 class="text-4xl font-bold text-gray-800 dark:text-white">{{ $teleoperator->name }}</h2>
                    
                    <div class="text-left space-y-2">
                        <p class="text-xl"><strong>Email:</strong> {{ $teleoperator->email }}</p>
                        <p class="text-xl"><strong>Teléfono:</strong> {{ $teleoperator->prefix }} {{ $teleoperator->phone_number }}</p>
                        <p class="text-xl"><strong>Zona:</strong> {{ $teleoperator->zone->city }} - {{ $teleoperator->zone->zone }}</p>
                        <p class="text-xl"><strong>Fecha de contratación:</strong> {{ $teleoperator->hiring_date ?? 'No disponible' }}</p>
                        <p class="text-xl"><strong>Fecha de despido:</strong> {{ $teleoperator->firing_date ?? 'Aún no ha sido despedido' }}</p>
                        <p class="text-xl"><strong>Código:</strong> {{ $teleoperator->code ?? 'No disponible' }}</p>
                    </div>
                    
                    <div class="text-left">
                        <p class="font-bold text-xl">Idiomas:</p>
                        @if ($teleoperator->languages->isNotEmpty())
                            <ul class="list-disc list-inside">
                                @foreach ($teleoperator->languages as $language)
                                    <li>{{ $language->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500">Este teleoperador no tiene idiomas registrados.</p>
                        @endif
                    </div>

                    <!-- Botón volver -->
                    <button type="button" onclick="window.location.href='/teleoperators'"
                        class="w-full mt-8 bg-gray-500 text-white font-medium py-2 px-4 rounded-lg shadow hover:bg-gray-600 focus:ring focus:ring-gray-300">
                        Volver al listado
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
