<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Resources\TeleoperatorResource;
    use App\Http\Resources\UserResource;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Teleoperator;

    class UserController extends BaseController {

        /**
         * Display the specified resource.
         */
        public function show() {

            $user = Auth::user();
            $teleoperator = Teleoperator::where('email', $user->email)->first();

            if (!$teleoperator) {
                return $this->sendResponse(new UserResource($user), 'Datos del usuario autenticado mostrados con éxito', 200);
            }

            return $this->sendResponse(new TeleoperatorResource($teleoperator), 'Datos del usuario autenticado mostrados con éxito', 200);
        }
    }
?>