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

Route::resource('/patients', PatientController::class)->middleware(RoleMiddleware::class.':administrador,manager')->only(['create', 'store', 'destroy']);
Route::resource('/patients', PatientController::class)->middleware(RoleMiddleware::class.':administrador,manager')->only(['edit', 'update']);
Route::resource('/patients', PatientController::class)->only(['index', 'show']);

Route::resource('/zones', ZoneController::class)->middleware(RoleMiddleware::class.':administrador,manager')->only(['create', 'store', 'destroy']);
Route::resource('/zones', ZoneController::class)->middleware(RoleMiddleware::class.':administrador,manager')->only(['edit', 'update']);
Route::resource('/zones', ZoneController::class)->only(['index', 'show']);

Route::resource('/teleoperators', TeleoperatorController::class)->middleware(RoleMiddleware::class.':administrador,manager')->only(['create', 'store', 'destroy']);
Route::resource('/teleoperators', TeleoperatorController::class)->middleware(RoleMiddleware::class.':administrador,manager')->only(['edit', 'update']);
Route::resource('/teleoperators', TeleoperatorController::class)->only(['index', 'show']);

Route::resource('/languages', LanguageController::class)->middleware(RoleMiddleware::class.':administrador,manager')->only(['create', 'store', 'destroy']);
Route::resource('/languages', LanguageController::class)->middleware(RoleMiddleware::class.':administrador,manager')->only(['edit', 'update']);
Route::resource('/languages', LanguageController::class)->only(['index', 'show']);

Route::resource('/contacts', EmergencyContactController::class)->middleware(RoleMiddleware::class.':administrador,manager')->only(['create', 'store', 'destroy']);
Route::resource('/contacts', EmergencyContactController::class)->middleware(RoleMiddleware::class.':administrador,manager')->only(['edit', 'update']);
Route::resource('/contacts', EmergencyContactController::class)->only(['index', 'show']);

require __DIR__.'/auth.php';
