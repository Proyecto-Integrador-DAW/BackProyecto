<?php

    namespace App\Http\Controllers;
    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    use Illuminate\Http\Request;
    use App\Http\Requests\StoreTeleoperatorRequest;
    use App\Http\Requests\UpdateTeleoperatorRequest;
    use App\Models\Teleoperator;
    use App\Models\Zone;
    use App\Models\Language;


    class TeleoperatorController extends Controller {

        use AuthorizesRequests;

        public function index() {

            if (auth()->user()->role === 'administrador') {
                $teleoperators = Teleoperator::withTrashed()->get();
            } else {
                $teleoperators = Teleoperator::all();
            }

            return view('teleoperators.index', compact('teleoperators'));
        }

        public function show(Teleoperator $teleoperator) {
            return view('teleoperators.show', compact('teleoperator'));
        }
        
        public function create() {
            $this->authorize('create', Teleoperator::class);
            $zones = Zone::all(); 
            $languages = Language::all();
            return view('teleoperators.create', compact('zones', 'languages'));
        }
    
        public function edit(Teleoperator $teleoperator) {
            $this->authorize('edit', $teleoperator);
            $zones = Zone::all(); 
            $languages = Language::all();
            return view('teleoperators.edit', compact('teleoperator', 'zones', 'languages'));
        }
        

        public function destroy(Teleoperator $teleoperator) {
            $this->authorize('delete', $teleoperator);
            $teleoperator->delete();
            return redirect()->route('teleoperators.index')->with('success', '¡Teleoperador borrado correctamente!');
        }
        
        public function store(StoreTeleoperatorRequest $request) {

            $this->authorize('create', Teleoperator::class);

            $validated = $request->validated();

            $teleoperator = Teleoperator::create($validated);

            if (isset($validated['languages'])) {
                $teleoperator->languages()->attach($validated['languages']);
            }

            return redirect()->route('teleoperators.index')
                ->with('success', '¡Teleoperador creado correctamente!')
                ->with('id', $teleoperator->id);
        }

        public function update(UpdateTeleoperatorRequest $request, Teleoperator $teleoperator) {

            $this->authorize('edit', $teleoperator);
            
            $validated = $request->validated();
            
            $teleoperator->update($validated);

            if (isset($validated['languages'])) {
                $teleoperator->languages()->sync($validated['languages']);
            }

            return redirect()->route('teleoperators.index')
                ->with('success', '¡Teleoperador actualizado correctamente!')
                ->with('id', $teleoperator->id);
        }

        public function restore($id) {

            $this->authorize('restore', Teleoperator::class);

            $teleoperator = Teleoperator::withTrashed()->findOrFail($id);

            $this->authorize('restore', $teleoperator);

            $teleoperator->restore();

            return redirect()->route('teleoperators.index')
                ->with('success', '¡Teleoperador restaurado correctamente!')
                ->with('id', $teleoperator->id);
        }

        public function forceDelete($id) {

            $this->authorize('forceDelete', Teleoperator::class);

            $teleoperator = Teleoperator::withTrashed()->findOrFail($id);

            $this->authorize('forceDelete', $teleoperator);

            $teleoperator->calls()->forceDelete();
            $teleoperator->forceDelete();

            return redirect()->route('teleoperators.index')->with('success', 'Teleoperador eliminado permanentemente.');
        }
    }
?>