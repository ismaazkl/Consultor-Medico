@extends('layouts.dashboard')
@section('title', 'Pacientes')
@section('page-title', 'Gestión de Pacientes')

@section('content')

<!-- SEARCH + ACTIONS BAR -->
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem">
    <div style="position:relative;flex:1;max-width:360px">
        <svg style="position:absolute;left:0.85rem;top:50%;transform:translateY(-50%);color:var(--gray-4)" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
        <input type="text" id="patientSearch" placeholder="Buscar paciente por nombre..."
               style="padding:0.75rem 1rem 0.75rem 2.5rem;border:1.5px solid var(--gray-2);border-radius:10px;font-size:0.88rem;width:100%;background:white;outline:none;transition:all 0.2s"
               onfocus="this.style.borderColor='var(--teal)'" onblur="this.style.borderColor='var(--gray-2)'">
    </div>
    <a href="{{ route('patients.create') }}" class="btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nuevo Paciente
    </a>
</div>

<!-- STATS ROW -->
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1.5rem">
    <div style="background:white;border-radius:12px;padding:1.25rem;border:1px solid var(--gray-2);display:flex;align-items:center;gap:1rem">
        <div style="width:40px;height:40px;border-radius:10px;background:rgba(26,158,140,0.12);display:flex;align-items:center;justify-content:center">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="2"><path d="M17 21v-2a4 4 0 00-8 0v2M12 11a4 4 0 100-8 4 4 0 000 8z"/></svg>
        </div>
        <div>
            <p style="font-size:1.5rem;font-weight:700;color:var(--deep);font-family:'Playfair Display',serif">{{ $patients->total() }}</p>
            <p style="font-size:0.78rem;color:var(--text-lt)">Total registrados</p>
        </div>
    </div>
    <div style="background:white;border-radius:12px;padding:1.25rem;border:1px solid var(--gray-2);display:flex;align-items:center;gap:1rem">
        <div style="width:40px;height:40px;border-radius:10px;background:rgba(76,175,125,0.12);display:flex;align-items:center;justify-content:center">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--sage)" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
        </div>
        <div>
            <p style="font-size:1.5rem;font-weight:700;color:var(--deep);font-family:'Playfair Display',serif">{{ $activePatients }}</p>
            <p style="font-size:0.78rem;color:var(--text-lt)">Pacientes activos</p>
        </div>
    </div>
    <div style="background:white;border-radius:12px;padding:1.25rem;border:1px solid var(--gray-2);display:flex;align-items:center;gap:1rem">
        <div style="width:40px;height:40px;border-radius:10px;background:rgba(245,166,35,0.12);display:flex;align-items:center;justify-content:center">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--gold)" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
        </div>
        <div>
            <p style="font-size:1.5rem;font-weight:700;color:var(--deep);font-family:'Playfair Display',serif">{{ $newThisMonth }}</p>
            <p style="font-size:0.78rem;color:var(--text-lt)">Nuevos este mes</p>
        </div>
    </div>
</div>

<!-- PATIENTS TABLE -->
<div class="dash-section">
    <div class="dash-section-header">
        <h2>Lista de Pacientes</h2>
        <span style="font-size:0.8rem;color:var(--text-lt)">{{ $patients->total() }} pacientes</span>
    </div>
    <table class="patient-table">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Edad</th>
                <th>Teléfono</th>
                <th>Última visita</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($patients as $patient)
            <tr class="patient-row">
                <td>
                    <div class="patient-name">
                        <div class="pt-avatar" style="background:{{ $patient->avatar_color }}">
                            {{ strtoupper(substr($patient->first_name, 0, 1) . substr($patient->last_name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="patient-name-text" style="font-weight:600;font-size:0.88rem;color:var(--deep)">{{ $patient->full_name }}</p>
                            <p style="font-size:0.75rem;color:var(--text-lt)">{{ $patient->email ?: '—' }}</p>
                        </div>
                    </div>
                </td>
                <td>{{ $patient->age ?? '—' }} años</td>
                <td>{{ $patient->phone ?: '—' }}</td>
                <td>
                    @if($patient->consultations->count() > 0)
                        {{ $patient->consultations->sortByDesc('visit_date')->first()->visit_date->format('d/m/Y') }}
                    @else
                        <span style="color:var(--text-lt)">Sin visitas</span>
                    @endif
                </td>
                <td>
                    <span class="badge-status badge-{{ strtolower($patient->status) }}">
                        {{ $patient->status }}
                    </span>
                </td>
                <td>
                    <div style="display:flex;gap:0.4rem">
                        <a href="{{ route('patients.show', $patient->id) }}" class="btn-sm">Ver</a>
                        <a href="{{ route('patients.edit', $patient->id) }}" class="btn-sm">Editar</a>
                        <form action="{{ route('patients.destroy', $patient->id) }}" method="POST"
                              onsubmit="return confirm('¿Eliminar a {{ $patient->full_name }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-sm" style="color:var(--rose);border-color:rgba(232,100,122,0.3)">✕</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;padding:3rem;color:var(--text-lt)">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--gray-3)" stroke-width="1.5" style="margin:0 auto 1rem"><path d="M17 21v-2a4 4 0 00-8 0v2M12 11a4 4 0 100-8 4 4 0 000 8z"/></svg>
                    <p style="font-weight:600;margin-bottom:0.5rem">No hay pacientes registrados</p>
                    <a href="{{ route('patients.create') }}" style="color:var(--teal);font-weight:600">Agregar primer paciente →</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($patients->hasPages())
    <div style="padding:1rem 1.5rem;border-top:1px solid var(--gray-1)">
        {{ $patients->links() }}
    </div>
    @endif
</div>

@endsection