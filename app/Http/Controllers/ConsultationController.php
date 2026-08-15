<?php
namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Patient;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function store(Request $request, Patient $patient)
    {
        $data = $request->validate([
            'visit_date'  => 'required|date',
            'visit_time'  => 'nullable',
            'title'       => 'required|string|max:200',
            'diagnosis'   => 'nullable|string',
            'treatment'   => 'nullable|string',
            'notes'       => 'nullable|string',
            'next_visit'  => 'nullable|date',
            'weight'      => 'nullable|numeric|min:0|max:300',
            'height'      => 'nullable|numeric|min:0|max:300',
            'bp_systolic' => 'nullable|integer|min:0|max:300',
            'bp_diastolic'=> 'nullable|integer|min:0|max:200',
            'temperature' => 'nullable|numeric|min:30|max:45',
            'heart_rate'  => 'nullable|integer|min:0|max:300',
        ]);

        $data['patient_id'] = $patient->id;
        $data['doctor_id']  = session('doctor_id');

        Consultation::create($data);

        return redirect()->route('patients.show', $patient->id)
                         ->with('success', 'Consulta registrada correctamente.');
    }

    public function destroy(Consultation $consultation)
    {
        $patientId = $consultation->patient_id;
        $consultation->delete();
        return redirect()->route('patients.show', $patientId)
                         ->with('success', 'Consulta eliminada.');
    }
}
