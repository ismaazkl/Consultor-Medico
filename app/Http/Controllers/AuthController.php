<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Doctor;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('doctor_id')) return redirect()->route('dashboard');
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $doctor = Doctor::where('username', $request->username)->first();

        if ($doctor && Hash::check($request->password, $doctor->password)) {
            session(['doctor_id' => $doctor->id, 'doctor_name' => $doctor->name]);
            return redirect()->route('dashboard')->with('success', '¡Bienvenido, ' . $doctor->name . '!');
        }

        return back()->withErrors(['username' => 'Usuario o contraseña incorrectos.'])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }
}