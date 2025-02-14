<?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Api\{
        AlertController,
        AuthController,
        TeleoperatorController,
        LanguageController,
        ZonesController,
        PatientsController,
        ContactsController,
    };

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    Route::post('login', [AuthController::class, 'login'])->middleware('api');
    // Route::post('register', [AuthController::class, 'register'])->middleware('api');

    Route::middleware(['auth:sanctum','api'])->group( function () {

        Route::apiResource('alerts',  AlertController::class);
        Route::apiResource('teleoperators',  TeleoperatorController::class);
        Route::apiResource('languages',  LanguageController::class);
        // Route::apiResource('zones',  ZonesController::class);
        // Route::apiResource('operators',  TeleoperatorsController::class);
        // Route::apiResource('patients', PatientsController::class);
        // Route::apiResource('contacts',  ContactsController::class);

        // Route::get('zones/{id}/patients', [ZonesController::class, 'patients'])->name('zones.patients');
        // Route::get('zones/{id}/operators', [ZonesController::class, 'operators'])->name('zones.operators');
        // Route::get('patients/{id}/contacts', [ContactsController::class, 'contacts'])->name('patients.contacts');
        // Route::post('patients/{id}/contacts', [ContactsController::class, 'store'])->name('patients.contacts.store');
        
        // Route::post('logout', [AuthController::class, 'logout']);
    });
?>