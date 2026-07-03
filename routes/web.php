<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\AppointmentController;

// ── PÚBLICA ──────────────────────────────────────
Route::get('/', fn() => view('welcome'))->name('home');
Route::get('/debug', function () {
    $files = [
        'css/app.css'        => file_exists(public_path('css/app.css')),
        'js/app.js'          => file_exists(public_path('js/app.js')),
        'images/logo.png'    => file_exists(public_path('images/logo.png')),
        'images/favicon.png' => file_exists(public_path('images/favicon.png')),
        'build/manifest.json'=> file_exists(public_path('build/manifest.json')),
    ];
    return response()->json([
        'public_path' => public_path(),
        'base_path'   => base_path(),
        'files'       => $files,
    ]);
});
Route::post('/appointments', [AppointmentController::class, 'store'])
     ->name('appointments.store');

// ── AUTH ─────────────────────────────────────────
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

// ── PANEL MÉDICO (protegido) ──────────────────────
Route::middleware('doctor.auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // Pacientes
    Route::resource('patients', PatientController::class);

    // Historial 
    Route::get('/dashboard/appointments', [AppointmentController::class, 'index'])
         ->name('appointments.index');
     Route::patch('/appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])
         ->name('appointments.updateStatus');
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])
         ->name('appointments.destroy');
    Route::post('/patients/{patient}/consultations', [ConsultationController::class, 'store'])
         ->name('consultations.store');
    Route::delete('/consultations/{consultation}', [ConsultationController::class, 'destroy'])
         ->name('consultations.destroy');

    // Calendario
    Route::get('/dashboard/calendar', [CalendarController::class, 'index'])
         ->name('calendar.index');

    // Notificaciones
    Route::post('/notifications/mark-read', function () {
        $doctor = \App\Models\Doctor::find(session('doctor_id'));
        if ($doctor) {
            $doctor->unreadNotifications->markAsRead();
        }
        return back()->with('success', 'Notificaciones marcadas como leídas.');
    })->name('notifications.markRead');
});