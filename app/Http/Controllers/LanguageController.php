<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Models\Language;

class LanguageController extends Controller
{
   
    use AuthorizesRequests;

    public function index() {
        $languages = Language::all();
        return view('languages.index', compact('languages'));
    }
   
    public function show(Language $language) {
        return view('languages.show', compact('language'));
    }
   
    public function create() {
        $this->authorize('create', Language::class);
        return view('languages.create');
    }
   
    public function edit(Language $language) {
        $this->authorize('update', $language);
        return view('languages.edit', compact('language'));
    }

    public function destroy(Language $language) {
        $language->delete();
        return redirect()->route('languages.index')->with('success', 'Idioma borrado correctamente!');
    }
    
    public function store(StoreLanguageRequest $request)
{
    $validated = $request->validated();

    Language::create($validated);

    return redirect()->route('languages.index')->with('success', 'Idioma creado correctamente!');
}

public function update(UpdateLanguageRequest $request, Language $language)
{
    $this->authorize('update', $language);
      
    $validated = $request->validated();
    
    $language->update($validated);

    return redirect()->route('languages.index')->with('success', 'Idioma actualizado correctamente!');
}

public function delete(Language $language)
{
    $language->delete();
    return redirect()->route('languages.index')->with('success', 'Idioma borrado correctamente!');
}
}