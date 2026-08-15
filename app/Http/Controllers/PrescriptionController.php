<?php
namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Consultation;
use App\Models\Patient;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function store(Request $request, Patient $patient)
    {
        $data = $request->validate([
            'consultation_id'  => 'required|exists:consultations,id',
            'medication_name'  => 'required|string|max:200',
            'dosage'           => 'required|string|max:100',
            'frequency'        => 'required|string|max:100',
            'duration'         => 'nullable|string|max:100',
            'instructions'     => 'nullable|string',
        ]);

        $consultation = Consultation::findOrFail($data['consultation_id']);

        if ($consultation->patient_id !== $patient->id) {
            abort(403);
        }

        Prescription::create($data);

        return redirect()->route('patients.show', $patient->id)
                         ->with('success', 'Receta médica agregada correctamente.');
    }

    public function destroy(Prescription $prescription)
    {
        $patientId = $prescription->consultation->patient_id;
        $prescription->delete();

        return redirect()->route('patients.show', $patientId)
                         ->with('success', 'Receta eliminada.');
    }

    public function print(Prescription $prescription)
    {
        $prescription->load('consultation.patient');

        $doctor = \App\Models\Doctor::find(session('doctor_id'));

        return view('prescriptions.print', compact('prescription', 'doctor'));
    }
}
