<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DoctorAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('doctor_id')) {
            return redirect()->route('login')
                             ->with('error', 'Debe iniciar sesión para acceder.');
        }
        return $next($request);
    }
}