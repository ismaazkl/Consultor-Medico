<?php
namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Consultation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->get('month', now()->month);
        $year  = $request->get('year',  now()->year);

        $totalPatients  = Patient::count();
        $todayConsults  = Consultation::whereDate('visit_date', today())->count();
        $monthConsults  = Consultation::whereMonth('visit_date', $month)
                                       ->whereYear('visit_date', $year)->count();
        $recentPatients = Patient::with('consultations')->latest()->take(8)->get();
        $newThisMonth   = Patient::whereMonth('created_at', $month)
                                 ->whereYear('created_at', $year)->count();

        $eventDays = Consultation::whereMonth('visit_date', $month)
            ->whereYear('visit_date', $year)
            ->pluck('visit_date')
            ->map(fn($d) => \Carbon\Carbon::parse($d)->format('Y-m-d'))
            ->unique()->values()->toArray();

        return view('dashboard.index', compact(
            'totalPatients','todayConsults','monthConsults',
            'recentPatients','newThisMonth','eventDays','month','year'
        ));
    }
}
