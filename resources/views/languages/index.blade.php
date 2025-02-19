@extends('layouts.app')

@section('title', __('Llistat de Llengües'))

@section('content')
<h1 class="text-3xl font-bold text-blue-800 mb-6">Listado de Idiomas</h1>
<table class="w-full border-collapse border border-gray-300">
    <thead class="bg-gray-200">
        <tr>
            <th class="border border-gray-300 p-2">ID</th>
            <th class="border border-gray-300 p-2">Nom</th>
            <th class="border border-gray-300 p-2">Opcions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($languages as $language)
            <tr class="hover:bg-gray-100">
                <td class="border border-gray-300 p-2">{{ $language->id }}</td>
                <td class="border border-gray-300 p-2">
                    <a href="{{ route('languages.show', $language->id) }}" class="text-blue-700 hover:underline">{{ $language->name }}</a>
                </td>
                @auth
                <td class="border border-gray-300 p-2 flex space-x-4">
                    @can('update', $language)
                    <a href="{{ route('languages.edit', $language->id) }}" class="text-yellow-600 hover:underline">Editar</a>
                    @endcan
                    @can('delete', $language)
                    <form action="{{ route('languages.destroy', $language->id) }}" method="POST" onsubmit="return confirm('Estàs segur de voler esborrar aquesta llengua?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                    </form>
                    @endcan
                </td>
                @endauth
            </tr>
        @endforeach
    </tbody>
</table>
@can('create', App\Models\Language::class)
<button onclick="window.location.href='{{ route('languages.create') }}'" class="block mx-auto mt-6 p-4 bg-blue-800 text-white rounded border border-black text-center">Afegir Llengua</button>
@endcan
@endsection
