<?php

    namespace App\Http\Controllers;
    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    use Illuminate\Http\Request;
    use App\Http\Requests\StoreZoneRequest;
    use App\Http\Requests\UpdateZoneRequest;
    use App\Models\Zone;


    class ZoneController extends Controller {

        use AuthorizesRequests;

        public function index() {

            if (auth()->user()->role === 'administrador') {
                $zones = Zone::withTrashed()->get();
            } else {
                $zones = Zone::all();
            }

            return view('zones.index', compact('zones'));
        }
    
        public function create() {
            $this->authorize('create', Zone::class);
            return view('zones.create');
        }
    
        public function edit(Zone $zone) {
            $this->authorize('edit', $zone);
            return view('zones.edit', compact('zone'));
        }

        public function destroy(Zone $zone) {
            $this->authorize('delete', $zone);
            $zone->delete();
            return redirect()->route('zones.index')->with('success', '¡Zona borrada correctamente!');
        }
        
        public function store(StoreZoneRequest $request) {
            $this->authorize('create', Zone::class);
            $validated = $request->validated();

            Zone::create($validated);

            return redirect()->route('zones.index')->with('success', '¡Zona creada correctamente!');
        }

        public function update(UpdateZoneRequest $request, Zone $zone) {
            $this->authorize('edit', $zone);
            
            $validated = $request->validated();
            $zone->update($validated);

            return redirect()->route('zones.index')->with('success', '¡Zona actualizada correctamente!');
        }

        public function restore($id) {
            $zone = Zone::withTrashed()->findOrFail($id);

            $this->authorize('restore', $zone);

            $zone->restore();

            return redirect()->route('zones.index')->with('success', 'Zona restaurada correctamente.');
        }

        public function forceDelete($id) {
            $zone = Zone::withTrashed()->findOrFail($id);

            $this->authorize('forceDelete', $zone);

            $zone->forceDelete();

            return redirect()->route('zones.index')->with('success', 'Zona eliminada permanentemente.');
        }
    }
?>