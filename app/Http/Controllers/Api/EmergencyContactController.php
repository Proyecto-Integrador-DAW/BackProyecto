<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Resources\EmergencyContactResource;
    use App\Http\Requests\Api\{
        StoreEmergencyContactRequest,
        UpdateEmergencyContactRequest
    };
    use App\Models\EmergencyContact;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Http\Request;

    class EmergencyContactController extends BaseController {

        /**
         * Display a listing of the resource.
         */
        public function index() {
            return EmergencyContactResource::collection(EmergencyContact::paginate(100));
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(StoreEmergencyContactRequest $request) {

            $data = $request->validated();

            $data['created_by'] = Auth::user()->id;

            $contact = EmergencyContact::create($data);
            if (isset($data['patients'])) {
                $contact->patients()->attach($data['patients']);
            }
            
            return $this->sendResponse(new EmergencyContactResource($contact), 'Contacto de emergencia creado con éxito', 201);
        }

        /**
         * Display the specified resource.
         */
        public function show(EmergencyContact $emergencyContact) {
            return $this->sendResponse(new EmergencyContactResource($emergencyContact), 'Contacto de emergencia mostrado con éxito', 201);
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(UpdateEmergencyContactRequest $request, EmergencyContact $emergencyContact) {

            $data = $request->validated();
            // dd($data);
            $emergencyContact->update($data);
            
            if (isset($data['patients'])) {
                $emergencyContact->patients()->sync($data['patients']);
            }

            return $this->sendResponse(new EmergencyContactResource($emergencyContact), 'Contacto de emergencia actualizado con éxito', 200);
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(EmergencyContact $emergencyContact) {
            $emergencyContact->patients()->detach();
            $emergencyContact->delete();
            return $this->sendResponse(null, 'Contacto de emergencia eliminado con éxito', 204);
        }
    }
?>