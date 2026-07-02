<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use App\Notifications\NewAppointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'        => 'required|string|max:150',
            'email'         => 'required|email|max:150',
            'telefono'      => 'nullable|string|max:20',
            'tipo'          => 'nullable|string|max:100',
            'fecha_deseada' => 'nullable|date',
            'mensaje'       => 'nullable|string',
        ]);

        $appointment = Appointment::create($data);

        $doctor = Doctor::first();
        if ($doctor) {
            $doctor->notify(new NewAppointment($appointment));
        }

        return response()->json([
            'success' => true,
            'message' => '¡Solicitud enviada! Me pondré en contacto pronto.'
        ]);
    }

    public function index()
    {
        $appointments = Appointment::latest()->get();
        $pendientes   = $appointments->where('status', 'pendiente')->count();
        return view('dashboard.appointments', compact('appointments', 'pendientes'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => 'required|in:pendiente,confirmada,cancelada'
        ]);

        $appointment->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Estado actualizado correctamente.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->back()->with('success', 'Solicitud eliminada.');
    }
}
