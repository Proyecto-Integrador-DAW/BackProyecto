<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Resources\AlertSubtypeResource;
    use App\Models\AlertSubtype;
    use Illuminate\Http\Request;

    class AlertSubtypeController extends BaseController {

        /**
         * Display a listing of the resource.
         */
        public function index() {
            return AlertSubtypeResource::collection(AlertSubtype::paginate(100));
        }
    }
?>