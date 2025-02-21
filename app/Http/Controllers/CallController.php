<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCallRequest;
use App\Http\Requests\UpdateCallRequest;
use App\Models\Call;
use App\Models\Patient;
use App\Models\Teleoperator;
use App\Models\Alert;

class CallController extends Controller
{
    use AuthorizesRequests;

        public function index() {

            if (auth()->user()->role === 'administrador') {
                $calls = Call::withTrashed()->get();
            } else {
                $calls = Call::all();
            }

            return view('calls.index', compact('calls'));
        }
    
        public function show(Call $call) {
            return view('calls.show', compact('call'));
        }
    
        public function create() {

            $this->authorize('create', Call::class);
            $patients = Patient::all();
            $teleoperators = Teleoperator::all();
            $alerts = Alert::all();
            return view('calls.create', compact('patients','teleoperators','alerts'));
        }
    
        public function edit(Call $call) {

            $this->authorize('edit', $call);
            $patients = Patient::all();
            $teleoperators = Teleoperator::all();
            $alerts = Alert::all();
            return view('calls.edit',compact('call','patients','teleoperators','alerts'));
        }

        public function destroy(Call $call) {

            $this->authorize('delete', $call);

            $call->delete();
            return redirect()->route('calls.index')->with('success', 'Llamada borrada correctamente!');
        }
        
        public function store(StoreCallRequest $request) {

            $this->authorize('create', Call::class);

            $validated = $request->validated();

            $call = Call::create($validated);

            return redirect()->route('calls.index')
                ->with('success', 'Llamada creada correctamente!')
                ->with('id', $call->id);
        }

        public function update(UpdateCallRequest $request, Call $call) {

            $this->authorize('edit', $call);
            
            $validated = $request->validated();
            
            $call->update($validated);

            return redirect()->route('calls.index')
                ->with('success', 'Llamada actualizada correctamente!')
                ->with('id', $call->id);
        }

        public function restore($id) {

            $this->authorize('restore', Call::class);

            $call = Call::withTrashed()->findOrFail($id);

            $this->authorize('restore', $call);

            $call->restore();

            return redirect()->route('calls.index')
                ->with('success', 'Llamada restaurada correctamente!')
                ->with('id', $call->id);
        }

        public function forceDelete($id) {

            $this->authorize('forceDelete', Call::class);

            $call = Call::withTrashed()->findOrFail($id);

            $this->authorize('forceDelete', $call);

            $call->forceDelete();

            return redirect()->route('calls.index')->with('success', 'Llamada eliminada permanentemente.');
        }
    }
