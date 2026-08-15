<?php
namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Doctor;

class ExportController extends Controller
{
    public function printHistory(Patient $patient)
    {
        $patient->load(['consultations' => function ($q) {
            $q->with('prescriptions')->latest('visit_date');
        }]);

        $doctor = Doctor::find(session('doctor_id'));

        return view('patients.print-history', compact('patient', 'doctor'));
    }
}
