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
        UserController
    };

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');


    Route::post('login', [AuthController::class, 'login'])->middleware('api');
    Route::post('register', [TeleoperatorController::class, 'store'])->middleware('api');

    Route::middleware(['auth:sanctum','api'])->group( function () {

        Route::apiResource('/alerts',  AlertController::class);
        Route::apiResource('/teleoperators',  TeleoperatorController::class);
        Route::apiResource('/languages',  LanguageController::class);
        Route::apiResource('/zones',  ZoneController::class);
        Route::apiResource('/patients', PatientController::class);
        Route::apiResource('/contacts', EmergencyContactController::class)
            ->parameter('contacts', 'emergencyContact');
        Route::apiResource('/calls', CallController::class);

        Route::get('/subtypesAlerts', [AlertSubtypeController::class, 'index']);
        Route::get('/typesAlerts', [AlertTypeController::class, 'index']);

        Route::get('/zones/{zone}/patients', [ZoneController::class, 'patients']);
        Route::get('/zones/{zone}/teleoperators', [ZoneController::class, 'teleoperators']);

        Route::get('/patients/{patient}/calls', [PatientController::class, 'patientCalls']);

        Route::get('/user', [UserController::class, 'show']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
?>