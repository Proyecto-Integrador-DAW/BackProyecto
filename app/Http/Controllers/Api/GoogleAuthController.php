<?php

namespace App\Http\Controllers\Api;

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

                $token = $user->createToken('auth_token')->plainTextToken;

                return redirect('http://localhost:5173/home?token=' . $token);

            } catch (\Exception $e) {
                return redirect('http://localhost:5173/login?error=auth_failed');
            }
        }
    }
?>