<?php

    namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Laravel\Socialite\Facades\Socialite;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;

    class GoogleAuthController {

        public function redirectToGoogle() {
            return Socialite::driver('google')->stateless()->redirect();
        }

        public function handleGoogleCallback() {
            try {
                $googleUser = Socialite::driver('google')->stateless()->user();

                $user = User::where('email', $googleUser->getEmail())->first();

                if (!$user) {
                    return response()->json([
                        'success' => false,
                        'message' => 'La dirección de correo electrónico no está registrada',
                    ], 401);
                }

                // Generar un token de autenticación
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'message' => 'Usuario autenticado con éxito',
                    'token' => $token,
                    'user' => $user
                ], 200);

            } catch (\Exception $e) {
                return response()->json(['error' => 'Error en la autenticación'], 500);
            }
        }
    }
?>