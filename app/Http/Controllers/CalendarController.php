<?php
namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->get('month', now()->month);
        $year  = $request->get('year',  now()->year);

        $consultations = Consultation::with('patient')
            ->whereMonth('visit_date', $month)
            ->whereYear('visit_date', $year)
            ->orderBy('visit_date')
            ->get();

        $eventDays = $consultations
            ->pluck('visit_date')
            ->map(fn($d) => \Carbon\Carbon::parse($d)->format('Y-m-d'))
            ->unique()->values()->toArray();

        return view('calendar.index', compact('consultations','eventDays','month','year'));
    }
}