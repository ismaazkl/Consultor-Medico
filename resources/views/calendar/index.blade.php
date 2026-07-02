@extends('layouts.dashboard')
@section('title', 'Calendario')
@section('page-title', 'Calendario de Consultas')

@section('content')
<div class="calendar-page-grid">

    <div class="dash-section">
        <div class="dash-section-header">
            <div style="display:flex;align-items:center;gap:1rem">
                <a href="?month={{ $month == 1 ? 12 : $month-1 }}&year={{ $month == 1 ? $year-1 : $year }}" class="btn-sm">‹ Anterior</a>
                <h2 id="calMonthYear"></h2>
                <a href="?month={{ $month == 12 ? 1 : $month+1 }}&year={{ $month == 12 ? $year+1 : $year }}" class="btn-sm">Siguiente ›</a>
            </div>
        </div>
        <div class="calendar-wrap">
            <div class="cal-grid" id="calGrid" data-events='@json($eventDays)' data-month="{{ $month }}" data-year="{{ $year }}"
                 style="grid-template-columns:repeat(7,1fr)"></div>
        </div>
    </div>

    <div class="dash-section">
        <div class="dash-section-header"><h2>Consultas del mes</h2></div>
        <div style="padding:1rem;max-height:600px;overflow-y:auto">
            @forelse($consultations->groupBy(fn($c) => $c->visit_date->format('Y-m-d')) as $date => $dayConsults)
            <div style="margin-bottom:1.25rem">
                <p style="font-size:0.75rem;font-weight:700;text-transform:uppercase;color:var(--text-lt);margin-bottom:0.5rem">
                    {{ \Carbon\Carbon::parse($date)->isoFormat('dddd, D [de] MMMM') }}
                </p>
                @foreach($dayConsults as $c)
                <div style="padding:0.85rem;background:var(--gray-1);border-radius:10px;margin-bottom:0.5rem;border-left:3px solid var(--teal)">
                    <a href="{{ route('patients.show', $c->patient_id) }}" style="font-weight:700;font-size:0.88rem;color:var(--deep);text-decoration:none">
                        {{ $c->patient->full_name }}
                    </a>
                    <p style="font-size:0.78rem;color:var(--text-lt)">{{ $c->title }}</p>
                    @if($c->visit_time)
                    <p style="font-size:0.75rem;color:var(--teal);font-weight:600">⏰ {{ $c->visit_time }}</p>
                    @endif
                </div>
                @endforeach
            </div>
            @empty
            <p style="text-align:center;color:var(--text-lt);padding:2rem">Sin consultas este mes</p>
            @endforelse
        </div>
    </div>
</div>
@endsection