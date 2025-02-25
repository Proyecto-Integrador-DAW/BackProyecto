<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Api\BaseController;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Validator;
    use App\Models\User;
/**
 * @OA\Info(
 *    title="Teleassistance API Documentation",
 *    version="1.0.0",
 * )
 * @OA\PathItem(path="/api")
**  
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */
    class AuthController extends BaseController {

        /**
         * @OA\Post(
         *     path="/api/login",
         *     summary="Autenticación del usuario",
         *     tags={"Autenticación"},
         *     @OA\RequestBody(
         *         required=true,
         *         @OA\JsonContent(
         *             required={"email", "password"},
         *             @OA\Property(property="email", type="string", format="email", example="1@manager.com"),
         *             @OA\Property(property="password", type="string", example="1234"),
         *         )
         *     ),
         *     @OA\Response(
         *         response=200,
         *         description="Login correcte",
         *         @OA\JsonContent(
         *             @OA\Property(property="success", type="boolean", example=true),
         *             @OA\Property(property="data", type="object",
         *                 @OA\Property(property="token", type="string", example="jwt-token"),
         *                 @OA\Property(property="name", type="string", example="John Doe")
         *             ),
         *             @OA\Property(property="message", type="string", example="User signed in")
         *         )
         *     ),
         *     @OA\Response(
         *         response=401,
         *         description="No autoritzat",
         *         @OA\JsonContent(
         *             @OA\Property(property="success", type="boolean", example=false),
         *             @OA\Property(property="message", type="string", example="Unauthorised."),
         *             @OA\Property(property="info", type="object",
         *                 @OA\Property(property="error", type="string", example="incorrect Email/Password")
         *             )
         *         )
         *     )
         * )
         */
        public function login(Request $request) {

            $validated = $request->validate([
                'identifier' => 'required|string',
                'password' => 'required|string|min:6',
            ]);

            $identifier = $request->identifier;
            $credentials = ['password' => $request->password];

            if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
                $credentials['email'] = $identifier;
            } else {
                $credentials['code'] = $identifier;
            }

            if (Auth::attempt($credentials)) {
                $authUser = Auth::user();
                $result['token'] = $authUser->createToken('MyAuthApp')->plainTextToken;
                $result['name'] = $authUser->name;
                return $this->sendResponse($result, 'User signed in');
            }

            return $this->sendError('Unauthorised.', ['error'=>'incorrect Email/Password']);
        }

        public function logout(Request $request) {

            $user = request()->user(); //or Auth::user()
            $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
            $success['name'] =  $user->name;

            return $this->sendResponse($success, 'User successfully signed out.');
        }
    }
?>