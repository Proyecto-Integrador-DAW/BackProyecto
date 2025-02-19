<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTeleoperatorRequest;
use App\Http\Requests\UpdateTeleoperatorRequest;
use App\Models\Teleoperator;
use App\Models\Zone;
use App\Models\Language;


class TeleoperatorController extends Controller
{
    use AuthorizesRequests;

    public function index() {
        $teleoperators = Teleoperator::all();
        return view('teleoperators.index', compact('teleoperators'));
    }

    public function show() {
        return view('teleoperators.show');
    }
   
    public function create() {
        $this->authorize('create', Teleoperator::class);
        $zones = Zone::all(); 
        $languages = Language::all();
        return view('teleoperators.create', compact('zones', 'languages'));
    }
   
    public function edit(Teleoperator $teleoperator) {
        $this->authorize('update', $teleoperator);
        $zones = Zone::all(); 
        $languages = Language::all();
        return view('teleoperators.edit', compact('teleoperator', 'zones', 'languages'));
    }
    

    public function destroy(Teleoperator $teleoperator) {
        $teleoperator->delete();
        return redirect()->route('teleoperators.index')->with('success', 'Zona borrado correctamente!');
    }
    
    public function store(StoreTeleoperatorRequest $request)
{
    $validated = $request->validated();

    // Crear el teleoperador
    $teleoperator = Teleoperator::create($validated);

    if (isset($validated['languages'])) {
        $teleoperator->languages()->sync($validated['languages']);
    }

    return redirect()->route('teleoperators.index')->with('success', 'Teleoperador creado correctamente!');
}

public function update(UpdateTeleoperatorRequest $request, Teleoperator $teleoperator)
{
    $this->authorize('update', $teleoperator);
      
    $validated = $request->validated();
    
    $teleoperator->update($validated);

    if (isset($validated['languages'])) {
        $teleoperator->languages()->sync($validated['languages']);
    } else {
        $teleoperator->languages()->sync([]);
    }

    return redirect()->route('teleoperators.index')->with('success', 'Teleoperador actualizado correctamente!');
}

public function delete(Teleoperator $teleoperator)
{
    $teleoperator->delete();
    return redirect()->route('teleoperators.index')->with('success', 'Zona borrado correctamente!');
}
}
