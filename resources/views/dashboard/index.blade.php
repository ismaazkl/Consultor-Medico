@extends('layouts.dashboard')
@section('title', 'Resumen')
@section('page-title', 'Resumen del día')

@section('content')

<!-- OVERVIEW CARDS -->
<div class="overview-grid">
    <div class="ov-card">
        <div class="ov-header">
            <div class="ov-icon" style="background:rgba(26,158,140,0.12)">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 00-8 0v2M12 11a4 4 0 100-8 4 4 0 000 8z"/>
                    <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                </svg>
            </div>
        </div>
        <p class="ov-num">{{ $totalPatients }}</p>
        <p class="ov-label">Total Pacientes</p>
        <p class="ov-trend">↑ Activos en sistema</p>
    </div>
    <div class="ov-card">
        <div class="ov-header">
            <div class="ov-icon" style="background:rgba(76,175,125,0.12)">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--sage)" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>
                </svg>
            </div>
        </div>
        <p class="ov-num">{{ $todayConsults }}</p>
        <p class="ov-label">Consultas hoy</p>
        <p class="ov-trend" style="color:var(--sage)">📅 {{ now()->format('d/m/Y') }}</p>
    </div>
    <div class="ov-card">
        <div class="ov-header">
            <div class="ov-icon" style="background:rgba(245,166,35,0.12)">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--gold)" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>
                </svg>
            </div>
        </div>
        <p class="ov-num">{{ $monthConsults }}</p>
        <p class="ov-label">Consultas este mes</p>
        <p class="ov-trend" style="color:var(--gold)">📊 {{ now()->format('F Y') }}</p>
    </div>
    <div class="ov-card">
        <div class="ov-header">
            <div class="ov-icon" style="background:rgba(232,100,122,0.12)">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--rose)" stroke-width="2">
                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                </svg>
            </div>
        </div>
        <p class="ov-num">{{ $recentPatients->count() }}</p>
        <p class="ov-label">Pacientes recientes</p>
        <p class="ov-trend" style="color:var(--rose)">Últimos registrados</p>
    </div>
</div>

<!-- MAIN GRID -->
<div class="dashboard-main-grid">

    <!-- RECENT PATIENTS -->
    <div class="dash-section">
        <div class="dash-section-header">
            <h2>Pacientes Recientes</h2>
            <div style="display:flex;gap:0.5rem">
                <a href="{{ route('patients.index') }}" class="btn-sm">Ver todos</a>
                <a href="{{ route('patients.create') }}" class="btn-sm teal">+ Nuevo</a>
            </div>
        </div>
        <div class="table-wrap">
        <table class="patient-table">
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Edad</th>
                    <th>Última visita</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentPatients as $patient)
                <tr>
                    <td>
                        <div class="patient-name">
                            <div class="pt-avatar" style="background:{{ $patient->avatar_color ?? 'var(--teal)' }}">
                                {{ strtoupper(substr($patient->first_name, 0, 1) . substr($patient->last_name, 0, 1)) }}
                            </div>
                            <div>
                                <p style="font-weight:600;font-size:0.88rem;color:var(--deep)">{{ $patient->full_name }}</p>
                                <p style="font-size:0.75rem;color:var(--text-lt)">{{ $patient->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td>{{ $patient->age }} años</td>
                    <td>{{ $patient->last_visit ? $patient->last_visit->format('d/m/Y') : '—' }}</td>
                    <td>
                        <span class="badge-status badge-{{ strtolower($patient->status ?? 'activo') }}">
                            {{ ucfirst($patient->status ?? 'Activo') }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('patients.show', $patient->id) }}" class="btn-sm">Ver</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:2rem;color:var(--text-lt)">
                        No hay pacientes registrados aún.<br>
                        <a href="{{ route('patients.create') }}" style="color:var(--teal);font-weight:600">Agregar el primero →</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

    <!-- MINI CALENDAR -->
    <div class="dash-section">
        <div class="dash-section-header">
            <h2>Calendario</h2>
            <a href="{{ route('calendar.index') }}" class="btn-sm">Ver completo</a>
        </div>
        <div class="calendar-wrap">
            <div class="cal-nav">
                <a href="?month={{ $month == 1 ? 12 : $month-1 }}&year={{ $month == 1 ? $year-1 : $year }}" class="btn-sm">‹</a>
                <h3 id="calMonthYear"></h3>
                <a href="?month={{ $month == 12 ? 1 : $month+1 }}&year={{ $month == 12 ? $year+1 : $year }}" class="btn-sm">›</a>
            </div>
            <div class="cal-grid" id="calGrid" data-events='@json($eventDays)' data-month="{{ $month }}" data-year="{{ $year }}"></div>
            
            @if($todayConsults > 0)
            <div style="margin-top:1rem;padding:0.85rem;background:rgba(26,158,140,0.08);border-radius:10px;border:1px solid rgba(26,158,140,0.2)">
                <p style="font-size:0.82rem;font-weight:700;color:var(--teal)">📅 Hoy: {{ $todayConsults }} consulta(s)</p>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- QUICK ACTIONS -->
<div style="margin-top:1.5rem">
    <div class="dash-section">
        <div class="dash-section-header">
            <h2>Acciones Rápidas</h2>
        </div>
        <div class="quick-actions-grid">
            <a href="{{ route('patients.create') }}" style="display:flex;flex-direction:column;align-items:center;gap:0.5rem;padding:1.25rem;border-radius:12px;background:rgba(26,158,140,0.08);border:1px solid rgba(26,158,140,0.2);text-decoration:none;transition:all 0.2s;color:var(--teal)">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                <span style="font-size:0.82rem;font-weight:600">Nuevo Paciente</span>
            </a>
            <a href="{{ route('patients.index') }}" style="display:flex;flex-direction:column;align-items:center;gap:0.5rem;padding:1.25rem;border-radius:12px;background:rgba(76,175,125,0.08);border:1px solid rgba(76,175,125,0.2);text-decoration:none;transition:all 0.2s;color:var(--sage)">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-8 0v2M12 11a4 4 0 100-8 4 4 0 000 8z"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                <span style="font-size:0.82rem;font-weight:600">Ver Pacientes</span>
            </a>
            <a href="{{ route('calendar.index') }}" style="display:flex;flex-direction:column;align-items:center;gap:0.5rem;padding:1.25rem;border-radius:12px;background:rgba(245,166,35,0.08);border:1px solid rgba(245,166,35,0.2);text-decoration:none;transition:all 0.2s;color:var(--gold)">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                <span style="font-size:0.82rem;font-weight:600">Calendario</span>
            </a>
            <a href="{{ route('home') }}" target="_blank" style="display:flex;flex-direction:column;align-items:center;gap:0.5rem;padding:1.25rem;border-radius:12px;background:rgba(232,100,122,0.08);border:1px solid rgba(232,100,122,0.2);text-decoration:none;transition:all 0.2s;color:var(--rose)">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                <span style="font-size:0.82rem;font-weight:600">Portafolio</span>
            </a>
        </div>
    </div>
</div>

@endsection