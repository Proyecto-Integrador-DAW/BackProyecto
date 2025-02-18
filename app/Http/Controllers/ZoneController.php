<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests\StoreZoneRequest;
use App\Http\Requests\UpdateZoneRequest;
use App\Models\Zone;


class ZoneController extends Controller
{
    use AuthorizesRequests;

    public function index() {
        $zones = Zone::all();
        return view('zones.index', compact('zones'));
    }

    public function show() {
        return view('zones.show');
    }
   
    public function create() {
        $this->authorize('create', Zone::class);
        return view('zones.create');
    }
   
    public function edit(Zone $zone) {
        $this->authorize('update', $zone);
        return view('zones.edit', compact('zone'));
    }

    public function destroy(Zone $zone) {
        $zone->delete();
        return redirect()->route('zones.index')->with('success', 'Zona borrada correctamente!');
    }
    
    public function store(StoreZoneRequest $request)
{
    $validated = $request->validated();

    Zone::create($validated);

    return redirect()->route('zones.index')->with('success', 'Zona creada correctamente!');
}

public function update(UpdateZoneRequest $request, Zone $zone)
{
    $this->authorize('update', $zone);
      
    $validated = $request->validated();
    $zone->update($validated);

    return redirect()->route('zones.index')->with('success', 'Zona actualizada correctamente!');
}

public function delete(Zone $zone)
{
    $zone->delete();
    return redirect()->route('zones.index')->with('success', 'Zona esboborradorrada correctamente!');
}
}
