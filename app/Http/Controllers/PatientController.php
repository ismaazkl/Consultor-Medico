<?php
namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Doctor;
use App\Notifications\NewPatientRegistered;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    private $colors = ['#1a9e8c','#4caf7d','#e8647a','#f5a623','#5b6abf','#9b59b6'];

    public function index()
    {
        $patients       = Patient::with('consultations')->latest()->paginate(15);
        $totalPatients  = Patient::count();
        $activePatients = Patient::where('status', 'Activo')->count();
        $newThisMonth   = Patient::whereMonth('created_at', now()->month)->count();
        return view('patients.index', compact('patients','totalPatients','activePatients','newThisMonth'));
    }

    public function create() { return view('patients.form'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name'  => 'required|string|max:100',
            'last_name'   => 'required|string|max:100',
            'birth_date'  => 'required|date',
            'gender'      => 'required|string',
            'id_number'   => 'nullable|string|max:20',
            'phone'       => 'nullable|string|max:20',
            'email'       => 'nullable|email|max:150',
            'address'     => 'nullable|string|max:255',
            'blood_type'  => 'nullable|string|max:5',
            'insurance'   => 'nullable|string|max:100',
            'allergies'   => 'nullable|string',
            'chronic_conditions'  => 'nullable|string',
            'current_medications' => 'nullable|string',
            'notes'       => 'nullable|string',
            'status'      => 'nullable|string|in:Activo,Pendiente,Inactivo',
            'emergency_contact_name'     => 'nullable|string|max:100',
            'emergency_contact_relation' => 'nullable|string|max:50',
            'emergency_contact_phone'    => 'nullable|string|max:20',
        ]);

        $data['avatar_color'] = $this->colors[array_rand($this->colors)];
        $patient = Patient::create($data);

        $doctor = Doctor::first();
        if ($doctor) {
            $doctor->notify(new NewPatientRegistered($patient));
        }

        return redirect()->route('patients.show', $patient->id)
                         ->with('success', 'Paciente registrado correctamente.');
    }

    public function show(Patient $patient)
    {
        $patient->load('consultations');
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('patients.form', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'birth_date' => 'required|date',
            'gender'     => 'required|string',
            'id_number'  => 'nullable|string|max:20',
            'phone'      => 'nullable|string|max:20',
            'email'      => 'nullable|email|max:150',
            'address'    => 'nullable|string|max:255',
            'blood_type' => 'nullable|string|max:5',
            'insurance'  => 'nullable|string|max:100',
            'allergies'  => 'nullable|string',
            'chronic_conditions'  => 'nullable|string',
            'current_medications' => 'nullable|string',
            'notes'      => 'nullable|string',
            'status'     => 'nullable|string|in:Activo,Pendiente,Inactivo',
            'emergency_contact_name'     => 'nullable|string|max:100',
            'emergency_contact_relation' => 'nullable|string|max:50',
            'emergency_contact_phone'    => 'nullable|string|max:20',
        ]);

        $patient->update($data);
        return redirect()->route('patients.show', $patient->id)
                         ->with('success', 'Paciente actualizado correctamente.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')
                         ->with('success', 'Paciente eliminado.');
    }
}
