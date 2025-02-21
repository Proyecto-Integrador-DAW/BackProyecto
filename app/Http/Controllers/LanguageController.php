<?php

    namespace App\Http\Controllers;
    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    use Illuminate\Http\Request;
    use App\Http\Requests\StoreLanguageRequest;
    use App\Http\Requests\UpdateLanguageRequest;
    use App\Models\Language;

    class LanguageController extends Controller {

        use AuthorizesRequests;

        public function index() {

            if (auth()->user()->role === 'administrador') {
                $languages = Language::withTrashed()->get();
            } else {
                $languages = Language::all();
            }

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
            $this->authorize('edit', $language);
            return view('languages.edit', compact('language'));
        }

        public function destroy(Language $language) {
            $this->authorize('delete', $language);
            $language->delete();
            return redirect()->route('languages.index')->with('success', '¡Idioma borrado correctamente!');
        }
        
        public function store(StoreLanguageRequest $request) {

            $this->authorize('create', Language::class);

            $validated = $request->validated();

            $language= Language::create($validated);

            return redirect()->route('languages.index')
                ->with('success', '¡Idioma creado correctamente!')
                ->with('id', $language->id);
        }

        public function update(UpdateLanguageRequest $request, Language $language) {

            $this->authorize('edit', $language);
            
            $validated = $request->validated();
            
            $language->update($validated);

            return redirect()->route('languages.index')
                ->with('success', '¡Idioma actualizado correctamente!')
                ->with('id', $language->id);
        }

        public function restore($id) {

            $this->authorize('restore', Language::class);

            $language = Language::withTrashed()->findOrFail($id);

            $this->authorize('restore', $language);

            $language->restore();

            return redirect()->route('languages.index')
                ->with('success', '¡Idioma restaurado correctamente!')
                ->with('id', $language->id);
        }

        public function forceDelete($id) {

            $this->authorize('forceDelete', Language::class);

            $language = Language::withTrashed()->findOrFail($id);

            $this->authorize('forceDelete', $language);

            // $contact->calls()->forceDelete();
            $language->forceDelete();

            return redirect()->route('languages.index')->with('success', 'Idioma eliminado permanentemente.');
        }
    }
?>