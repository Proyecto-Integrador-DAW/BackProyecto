<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Resources\CallResource;
    use App\Http\Requests\Api\{
        StoreCallRequest,
        UpdateCallRequest
    };
    use App\Models\Call;
    use Illuminate\Http\Request;

    class CallController extends BaseController {

        /**
         * Display a listing of the resource.
         */
        public function index() {
            return CallResource::collection(Call::paginate(20));
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(StoreCallRequest $request) {
            $call = Call::create($request->validated());
            return $this->sendResponse(new CallResource($call), 'Llamada creada con éxito', 201);
        }

        /**
         * Display the specified resource.
         */
        public function show(Call $call) {
            return $this->sendResponse(new CallResource($call), 'Llamada mostrada con éxito', 200);
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(UpdateCallRequest $request, Call $call) {
            $call->update($request->validated());
            return $this->sendResponse(new CallResource($call), 'Llamada actualizada con éxito', 200);
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Call $call) {
            $call->delete();
            return $this->sendResponse(null, 'Llamada eliminada con éxito', 204);
        }
    }
?>