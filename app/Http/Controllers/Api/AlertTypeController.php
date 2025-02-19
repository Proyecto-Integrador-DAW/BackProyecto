<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Resources\AlertTypeResource;
    use App\Models\AlertType;
    use Illuminate\Http\Request;

    class AlertTypeController {

        /**
         * Display a listing of the resource.
         */
        public function index() {
            return AlertTypeResource::collection(AlertType::paginate(100));
        }
    }
