@extends('layouts.content')

@section('title', 'Idiomas')
@section('content')
    <div class="py-12 mx-auto sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                <span class="text-lg">{{ session('success') }}</span>
            </div>
        @elseif (session('error'))
            <div class="bg-red-500 text-black p-4 mb-6 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <div class="max-w-9xl">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @section('create')
                    @can('create', \App\Models\Language::class)
                        <a href="{{ route('languages.create') }}" class="bg-lime-500 p-2 rounded-[10px]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-white" style="width: 1.5rem; display:inline">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </a>
                    @endcan
                @endsection

                @if (!$languages->isEmpty())
                    <table class="min-w-full">
                        <thead>
                            <tr class="divide-x divide-gray-300 dark:divide-gray-700">
                                <th class="px-6 py-3 text-left font-bold text-gray-800 dark:text-gray-300 bg-gray-200 dark:bg-gray-800 rounded-tl-lg uppercase">Nombre</th>
                                @can('view', \App\Models\Language::class)
                                    <th class="px-6 py-3 text-left font-bold text-gray-800 dark:text-gray-300 bg-gray-200 dark:bg-gray-800 uppercase">Eliminado</th>
                                @endcan
                                <th class="px-6 py-3 text-left font-bold text-gray-800 dark:text-gray-300 bg-gray-200 dark:bg-gray-800 rounded-tr-lg uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300 dark:divide-gray-600">
                            @foreach ($languages as $language)
                                <tr class="divide-x divide-gray-300 dark:divide-gray-600 dark:bg-[#2c3543]">

                                    {{-- NOMBRE --}}
                                    <td class="px-6 py-4 text-md text-gray-800 dark:text-gray-300">{{ $language->name }}</td>
                                    
                                    {{-- ELIMINADO --}}
                                    @can('view', $language)
                                        <td class="px-6 py-4 text-md text-gray-800 dark:text-gray-300">{{ $language->deleted_at }}</td>
                                    @endcan

                                    {{-- BOTONES --}}
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col sm:flex-row gap-2 justify-center items-center w-full sm:w-auto">

                                            {{-- RESTAURAR --}}
                                            @if(!$language->trashed()) 
                                                {{-- EDITAR --}}
                                                @can('edit', $language)
                                                    <a href="{{ route('languages.edit', $language->id) }}" class="bg-yellow-500 text-white py-2 px-4 rounded-lg shadow hover:bg-yellow-600 flex items-center gap-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16.5V19h2.5L16.5 9.5l-2.5-2.5L4 16.5z"/>
                                                        </svg>
                                                    </a>
                                                @endcan

                                                {{-- ELIMINAR --}}
                                                @can('delete', $language)
                                                    <form action="{{ route('languages.destroy', $language->id) }}" method="POST" class="inline-block" 
                                                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar este Idioma? Esta acción no se puede deshacer.');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-lg shadow hover:bg-red-600 flex items-center gap-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h12M9 6V4h6v2m-7 0h8m-6 0v12m4-12v12M4 6h16M7 6v12a2 2 0 002 2h6a2 2 0 002-2V6"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endcan
                                            @else
                                                <form action="{{ route('languages.restore', $language->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="bg-indigo-400 text-white py-2 px-4 rounded-lg shadow hover:bg-indigo-500 flex items-center gap-1">
                                                        Restaurar
                                                    </button>
                                                </form>
                                                <form action="{{ route('languages.forceDelete', $language->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-700 text-white py-2 px-4 rounded-lg shadow hover:bg-red-600 flex items-center gap-1" onclick="return confirm('¿Estás seguro de eliminar esta zona permanentemente?')">
                                                        ELIMINAR DEFINITIVAMENTE
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
                        <h1 class="text-lg">NO HAY IDIOMAS AÚN</h1>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
