@extends('layouts.content')

@section('title', 'Llamadas')

@section('content')
    <div class="py-12 mx-auto sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                <span class="text-lg">{{ session('success') }}</span>
                @if (session('id'))
                    <span class="text-lg">&nbsp;Para ver la llamada, pulse <a href="{{ route('calls.show', session('id')) }}" class="font-semibold underline hover:no-underline">aquí</a>.</span>
                @endif
            </div>
        @elseif (session('error'))
            <div class="bg-red-500 text-black p-4 mb-6 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <div class="max-w-9xl">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @section('create')
                    @can('create', \App\Models\Call::class)
                        <a href="{{ route('calls.create') }}" class="bg-lime-500 p-2 rounded-[10px]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-white w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </a>
                    @endcan
                @endsection

                @if (!$calls->isEmpty())
                    <table class="min-w-full">
                        <thead>
                            <tr class="divide-x divide-gray-300 dark:divide-gray-700">
                                <th class="px-6 py-3 text-left font-bold text-gray-800 dark:text-gray-300 bg-gray-200 dark:bg-gray-800 rounded-tl-lg uppercase">Teleoperador</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-800 dark:text-gray-300 bg-gray-200 dark:bg-gray-800 uppercase">Paciente</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-800 dark:text-gray-300 bg-gray-200 dark:bg-gray-800 uppercase">Tipo</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-800 dark:text-gray-300 bg-gray-200 dark:bg-gray-800 uppercase">Fecha y Hora</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-800 dark:text-gray-300 bg-gray-200 dark:bg-gray-800 uppercase">Título</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-800 dark:text-gray-300 bg-gray-200 dark:bg-gray-800 rounded-tr-lg uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300 dark:divide-gray-600">
                            @foreach ($calls as $call)
                                <tr class="divide-x divide-gray-300 dark:divide-gray-600 dark:bg-[#2c3543]">

                                    {{-- TELEOPERADOR --}}
                                    <td class="px-6 py-4 text-md text-gray-800 dark:text-gray-300">
                                        {{ $call->teleoperator->name ?? 'N/A' }}
                                    </td>

                                    {{-- PACIENTE --}}
                                    <td class="px-6 py-4 text-md text-gray-800 dark:text-gray-300">
                                        {{ $call->patient->name ?? 'N/A' }}
                                    </td>

                                    {{-- TIPO DE LLAMADA --}}
                                    <td class="px-6 py-4 text-md text-gray-800 dark:text-gray-300">
                                        {{ $call->call_type }}
                                    </td>

                                    {{-- FECHA Y HORA --}}
                                    <td class="px-6 py-4 text-md text-gray-800 dark:text-gray-300">
                                        {{ $call->call_time }}
                                    </td>

                                    {{-- TÍTULO --}}
                                    <td class="px-6 py-4 text-md text-gray-800 dark:text-gray-300">
                                        {{ $call->title }}
                                    </td>

                                    {{-- BOTONES --}}
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col sm:flex-row gap-2 justify-center items-center w-full sm:w-auto">

                                            @if(!$call->trashed()) 
                                                {{-- VER --}}
                                                <a href="{{ route('calls.show', $call->id) }}" class="bg-blue-500 text-white py-2 px-4 rounded-lg shadow hover:bg-blue-600 flex items-center gap-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5C7.5 4.5 3.9 7.2 2.25 12c1.65 4.8 5.25 7.5 9.75 7.5s8.1-2.7 9.75-7.5c-1.65-4.8-5.25-7.5-9.75-7.5zM12 9a3 3 0 100 6 3 3 0 000-6z"/>
                                                    </svg>
                                                </a>

                                                {{-- EDITAR --}}
                                                @can('edit', $call)
                                                    <a href="{{ route('calls.edit', $call->id) }}" class="bg-yellow-500 text-white py-2 px-4 rounded-lg shadow hover:bg-yellow-600 flex items-center gap-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16.5V19h2.5L16.5 9.5l-2.5-2.5L4 16.5z"/>
                                                        </svg>
                                                    </a>
                                                @endcan

                                                {{-- ELIMINAR --}}
                                                @can('delete', $call)
                                                    <form action="{{ route('calls.destroy', $call->id) }}" method="POST" class="inline-block" 
                                                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta llamada?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-lg shadow hover:bg-red-600 flex items-center gap-1">
                                                            Eliminar
                                                        </button>
                                                    </form>
                                                @endcan
                                            @else
                                                <form action="{{ route('calls.restore', $call->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="bg-indigo-400 text-white py-2 px-4 rounded-lg shadow hover:bg-indigo-500 flex items-center gap-1">
                                                        Restaurar
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="p-4 text-center text-gray-800 dark:text-gray-300 bg-gray-200 dark:bg-gray-800">
                        <h1 class="text-lg">NO HAY LLAMADAS REGISTRADAS</h1>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
