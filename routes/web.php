<?php

    use App\Http\Controllers\ProfileController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\PatientController;
    use App\Http\Controllers\ZoneController;
    use App\Http\Controllers\TeleoperatorController;
    use App\Http\Controllers\LoginController;
    use App\Http\Controllers\LanguageController;
    use App\Http\Controllers\EmergencyContactController;
    use App\Http\Middleware\RoleMiddleware;

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/home', function () {
        return view('home');
    })->middleware(['auth', 'verified'])->name('home');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });


    Route::middleware('auth')->group(function () {

        Route::resource('/patients', PatientController::class)->middleware(RoleMiddleware::class.':administrador,coordinador');
        Route::patch('/patients/{id}/restore', [PatientController::class, 'restore'])->middleware(RoleMiddleware::class.':administrador,coordinador')->name('patients.restore');
        Route::delete('/patients/{id}/force-delete', [PatientController::class, 'forceDelete'])->name('patients.forceDelete');


        Route::resource('/zones', ZoneController::class)->middleware(RoleMiddleware::class.':administrador,coordinador');
        Route::patch('/zones/{id}/restore', [ZoneController::class, 'restore'])->middleware(RoleMiddleware::class.':administrador,coordinador')->name('zones.restore');
        Route::delete('/zones/{id}/force-delete', [ZoneController::class, 'forceDelete'])->name('zones.forceDelete');


        Route::resource('/teleoperators', TeleoperatorController::class)->middleware(RoleMiddleware::class.':administrador,coordinador');
        Route::patch('/teleoperators/{id}/restore', [TeleoperatorController::class, 'restore'])->middleware(RoleMiddleware::class.':administrador,coordinador')->name('teleoperators.restore');
        Route::delete('/teleoperators/{id}/force-delete', [TeleoperatorController::class, 'forceDelete'])->name('teleoperators.forceDelete');


        Route::resource('/languages', LanguageController::class)->middleware(RoleMiddleware::class.':administrador,coordinador');
        Route::patch('/languages/{id}/restore', [LanguageController::class, 'restore'])->middleware(RoleMiddleware::class.':administrador,coordinador')->name('languages.restore');
        Route::delete('/languages/{id}/force-delete', [LanguageController::class, 'forceDelete'])->name('languages.forceDelete');


        Route::resource('/contacts', EmergencyContactController::class)->middleware(RoleMiddleware::class.':administrador,coordinador');
        Route::patch('/contacts/{id}/restore', [EmergencyContactController::class, 'restore'])->middleware(RoleMiddleware::class.':administrador,coordinador')->name('contacts.restore');
        Route::delete('/contacts/{id}/force-delete', [EmergencyContactController::class, 'forceDelete'])->name('contacts.forceDelete');
    });

    require __DIR__.'/auth.php';
?>