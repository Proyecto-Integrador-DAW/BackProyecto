<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Resources\AlertResource;
    use App\Http\Requests\Api\{
        StoreAlertRequest,
        UpdateAlertRequest
    };
    use App\Models\Alert;
    use Illuminate\Http\Request;

    class AlertController extends BaseController {

        /**
         * Display a listing of the resource.
         */
        public function index() {
            return AlertResource::collection(Alert::paginate(40));
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(StoreAlertRequest $request) {
            $alert = Alert::create($request->validated());
            return $this->sendResponse($alert, 'Alerta creada con éxito', 201);
        }

        /**
         * Display the specified resource.
         */
        public function show(Alert $alert) {
            return $this->sendResponse(new AlertResource($alert), 'Alerta mostrada con éxito', 200);
        }
        

        /**
         * Update the specified resource in storage.
         */
        public function update(UpdateAlertRequest $request, Alert $alert) {
            $alert->update($request->validated());
            return $this->sendResponse(new AlertResource($alert), 'Alerta actualizada con éxito', 200);
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Alert $alert) {
            $alert->delete();
            return $this->sendResponse(null, 'Alerta eliminada con éxito', 204);
        }
    }
?>