<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Api\BaseController;
    use App\Http\Resources\AlertResource;
    use App\Http\Requests\StoreAlertRequest;
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

        // /**
        //  * Display the specified resource.
        //  */
        // public function show(Alert $alert) {
        //     return $this->sendResponse(new AlertResource($alert->load('type.category')), 'Alerta recuperada con éxito', 200);
        // }
        

        // /**
        //  * Update the specified resource in storage.
        //  */
        // public function update(Request $request, Alert $alert) {
        //     //
        // }

        // /**
        //  * Remove the specified resource from storage.
        //  */
        // public function destroy(Alert $alert) {
        //     //
        // }
    }
?>