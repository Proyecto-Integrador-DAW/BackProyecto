<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Api\BaseController;
    use App\Http\Resources\TeleoperatorResource;
    use App\Http\Requests\Api\{
        UpdateTeleoperatorRequest,
        StoreTeleoperatorRequest
    };
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Http\Request;
    use App\Models\Teleoperator;
    
    class TeleoperatorController extends BaseController {

        /**
         * Display a listing of the resource.
         */
        public function index() {
            return $this->sendResponse(TeleoperatorResource::collection(Teleoperator::paginate()), 'Teleoperadores mostrados con éxito', 200);
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(StoreTeleoperatorRequest $request) {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);

            $teleoperator = Teleoperator::create($data);

            // ASOCIAMIENTO DE IDIOMAS
            $teleoperator->languages()->attach($data['languages']);

            return $this->sendResponse(new TeleoperatorResource($teleoperator), 'Teleoperador creado con éxito', 201);
        }

        /**
         * Display the specified resource.
         */
        public function show(Teleoperator $teleoperator) {
            return $this->sendResponse(new TeleoperatorResource($teleoperator), 'Teleoperador mostrado con éxito', 200);
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(UpdateTeleoperatorRequest $request, Teleoperator $teleoperator) {
            $data = $request->validated();
        
            // Si la contraseña ha sido modificada, la actualizamos
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }
        
            // Actualizamos el teleoperador
            $teleoperator->update($data);
        
            // Asociamos los nuevos idiomas
            if (isset($data['languages'])) {
                $teleoperator->languages()->sync($data['languages']); // 'sync' asegura que los idiomas sean reemplazados, no añadidos
            }
        
            return $this->sendResponse(new TeleoperatorResource($teleoperator), 'Teleoperador actualizado con éxito', 200);
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Teleoperator $teleoperator) {
            $teleoperator->languages()->detach();
            $teleoperator->delete();
            return $this->sendResponse([], 'Teleoperador eliminado con éxito', 204);
        }
    }
?>