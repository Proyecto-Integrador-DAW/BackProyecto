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

        Route::resource('/patients', PatientController::class)->middleware(RoleMiddleware::class.':administrador,coordinador')
            ->names([
                'index' => 'patients.web.index',
                'create' => 'patients.web.create',
                'store' => 'patients.web.store',
                'show' => 'patients.web.show',
                'edit' => 'patients.web.edit',
                'update' => 'patients.web.update',
                'destroy' => 'patients.web.destroy',
            ]);
        Route::patch('/patients/{id}/restore', [PatientController::class, 'restore'])->middleware(RoleMiddleware::class.':administrador,coordinador')->name('patients.restore');
        Route::delete('/patients/{id}/force-delete', [PatientController::class, 'forceDelete'])->name('patients.forceDelete');


        Route::resource('/zones', ZoneController::class)->middleware(RoleMiddleware::class.':administrador,coordinador')
            ->names([
                'index' => 'zones.web.index',
                'create' => 'zones.web.create',
                'store' => 'zones.web.store',
                'show' => 'zones.web.show',
                'edit' => 'zones.web.edit',
                'update' => 'zones.web.update',
                'destroy' => 'zones.web.destroy',
            ]);
        Route::patch('/zones/{id}/restore', [ZoneController::class, 'restore'])->middleware(RoleMiddleware::class.':administrador,coordinador')->name('zones.restore');
        Route::delete('/zones/{id}/force-delete', [ZoneController::class, 'forceDelete'])->name('zones.forceDelete');


        Route::resource('/teleoperators', TeleoperatorController::class)->middleware(RoleMiddleware::class.':administrador,coordinador')
            ->names([
                'index' => 'teleoperators.web.index',
                'create' => 'teleoperators.web.create',
                'store' => 'teleoperators.web.store',
                'show' => 'teleoperators.web.show',
                'edit' => 'teleoperators.web.edit',
                'update' => 'teleoperators.web.update',
                'destroy' => 'teleoperators.web.destroy',
            ]);
        Route::patch('/teleoperators/{id}/restore', [TeleoperatorController::class, 'restore'])->middleware(RoleMiddleware::class.':administrador,coordinador')->name('teleoperators.restore');
        Route::delete('/teleoperators/{id}/force-delete', [TeleoperatorController::class, 'forceDelete'])->name('teleoperators.forceDelete');


        Route::resource('/languages', LanguageController::class)->middleware(RoleMiddleware::class.':administrador,coordinador')
            ->names([
                'index' => 'languages.web.index',
                'create' => 'languages.web.create',
                'store' => 'languages.web.store',
                'show' => 'languages.web.show',
                'edit' => 'languages.web.edit',
                'update' => 'languages.web.update',
                'destroy' => 'languages.web.destroy',
            ]);
        Route::patch('/languages/{id}/restore', [LanguageController::class, 'restore'])->middleware(RoleMiddleware::class.':administrador,coordinador')->name('languages.restore');
        Route::delete('/languages/{id}/force-delete', [LanguageController::class, 'forceDelete'])->name('languages.forceDelete');


        Route::resource('/contacts', EmergencyContactController::class)->middleware(RoleMiddleware::class.':administrador,coordinador')
            ->names([
                'index' => 'contacts.web.index',
                'create' => 'contacts.web.create',
                'store' => 'contacts.web.store',
                'show' => 'contacts.web.show',
                'edit' => 'contacts.web.edit',
                'update' => 'contacts.web.update',
                'destroy' => 'contacts.web.destroy',
            ]);
        Route::patch('/contacts/{id}/restore', [EmergencyContactController::class, 'restore'])->middleware(RoleMiddleware::class.':administrador,coordinador')->name('contacts.restore');
        Route::delete('/contacts/{id}/force-delete', [EmergencyContactController::class, 'forceDelete'])->name('contacts.forceDelete');
    });

    require __DIR__.'/auth.php';
?>