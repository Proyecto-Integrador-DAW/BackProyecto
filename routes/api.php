<?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Api\{
        AuthController,
        AlertController,
        AlertTypeController,
        AlertSubtypeController,
        TeleoperatorController,
        LanguageController,
        ZoneController,
        PatientController,
        EmergencyContactController,
        CallController,
        UserController,
        GoogleAuthController
    };


    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');


    Route::post('/login', [AuthController::class, 'login'])->middleware('api');
    Route::post('/register', [TeleoperatorController::class, 'store'])->middleware('api');

    Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->middleware('web');
    Route::get('/auth/callback/google', [GoogleAuthController::class, 'handleGoogleCallback'])->middleware('web');

    Route::middleware(['auth:sanctum','api'])->group( function () {

        Route::apiResource('/alerts',  AlertController::class)
            ->names([
                'index' => 'api.alerts.index',
                'store' => 'api.alerts.store',
                'show' => 'api.alerts.show',
                'update' => 'api.alerts.update',
                'destroy' => 'api.alerts.destroy',
            ]);

        Route::apiResource('/teleoperators',  TeleoperatorController::class)
            ->names([
                'index' => 'api.teleoperators.index',
                'store' => 'api.teleoperators.store',
                'show' => 'api.teleoperators.show',
                'update' => 'api.teleoperators.update',
                'destroy' => 'api.teleoperators.destroy',
            ]);

        Route::apiResource('/languages',  LanguageController::class)
            ->names([
                'index' => 'api.languages.index',
                'store' => 'api.languages.store',
                'show' => 'api.languages.show',
                'update' => 'api.languages.update',
                'destroy' => 'api.languages.destroy',
            ]);

        Route::apiResource('/zones',  ZoneController::class)
            ->names([
                'index' => 'api.zones.index',
                'store' => 'api.zones.store',
                'show' => 'api.zones.show',
                'update' => 'api.zones.update',
                'destroy' => 'api.zones.destroy',
            ]);

        Route::apiResource('/patients', PatientController::class)
            ->names([
                'index' => 'api.patients.index',
                'store' => 'api.patients.store',
                'show' => 'api.patients.show',
                'update' => 'api.patients.update',
                'destroy' => 'api.patients.destroy',
            ]);

        Route::apiResource('/contacts', EmergencyContactController::class)
            ->parameter('contacts', 'emergencyContact')
            ->names([
                'index' => 'api.contacts.index',
                'store' => 'api.contacts.store',
                'show' => 'api.contacts.show',
                'update' => 'api.contacts.update',
                'destroy' => 'api.contacts.destroy',
            ]);

        Route::apiResource('/calls', CallController::class)
            ->names([
                'index' => 'api.calls.index',
                'store' => 'api.calls.store',
                'show' => 'api.calls.show',
                'update' => 'api.calls.update',
                'destroy' => 'api.calls.destroy',
            ]);


        Route::get('/subtypesAlerts', [AlertSubtypeController::class, 'index']);
        Route::get('/typesAlerts', [AlertTypeController::class, 'index']);

        Route::get('/zones/{zone}/patients', [ZoneController::class, 'patients']);
        Route::get('/zones/{zone}/teleoperators', [ZoneController::class, 'teleoperators']);

        Route::get('/patients/{patient}/calls', [PatientController::class, 'patientCalls']);
        Route::get('/patients/{patient}/alerts', [PatientController::class, 'alerts']);

        Route::get('/user', [UserController::class, 'show']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
?>