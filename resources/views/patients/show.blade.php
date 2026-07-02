@extends('layouts.dashboard')
@section('title', $patient->full_name)
@section('page-title', $patient->full_name)

@section('content')

<div class="patient-detail-grid">

    <!-- PATIENT CARD -->
    <div>
        <div class="dash-section" style="margin-bottom:1.5rem">
            <div style="padding:2rem;text-align:center;border-bottom:1px solid var(--gray-1)">
                <div style="width:80px;height:80px;border-radius:50%;background:{{ $patient->avatar_color }};display:flex;align-items:center;justify-content:center;font-size:1.8rem;font-weight:700;color:white;margin:0 auto 1rem">
                    {{ strtoupper(substr($patient->first_name,0,1).substr($patient->last_name,0,1)) }}
                </div>
                <h2 style="font-family:'Playfair Display',serif;font-size:1.3rem;color:var(--deep)">{{ $patient->full_name }}</h2>
                <p style="color:var(--text-lt);font-size:0.85rem;margin:0.25rem 0 0.75rem">
                    {{ $patient->gender }} · {{ $patient->age }} años
                </p>
                <span class="badge-status badge-{{ strtolower($patient->status) }}">{{ $patient->status }}</span>
            </div>
            <div style="padding:1.5rem">
                <div style="display:flex;flex-direction:column;gap:0.85rem">
                    @if($patient->phone)
                    <div style="display:flex;align-items:center;gap:0.75rem;font-size:0.85rem">
                        <span style="color:var(--teal)">📞</span>
                        <span style="color:var(--text)">{{ $patient->phone }}</span>
                    </div>
                    @endif
                    @if($patient->email)
                    <div style="display:flex;align-items:center;gap:0.75rem;font-size:0.85rem">
                        <span style="color:var(--teal)">✉️</span>
                        <span style="color:var(--text)">{{ $patient->email }}</span>
                    </div>
                    @endif
                    @if($patient->address)
                    <div style="display:flex;align-items:center;gap:0.75rem;font-size:0.85rem">
                        <span style="color:var(--teal)">📍</span>
                        <span style="color:var(--text)">{{ $patient->address }}</span>
                    </div>
                    @endif
                    <div style="display:flex;align-items:center;gap:0.75rem;font-size:0.85rem">
                        <span style="color:var(--teal)">🎂</span>
                        <span style="color:var(--text)">{{ $patient->birth_date->format('d/m/Y') }}</span>
                    </div>
                    @if($patient->id_number)
                    <div style="display:flex;align-items:center;gap:0.75rem;font-size:0.85rem">
                        <span style="color:var(--teal)">🪪</span>
                        <span style="color:var(--text)">{{ $patient->id_number }}</span>
                    </div>
                    @endif
                </div>
            </div>
            <div style="padding:0 1.5rem 1.5rem;display:flex;gap:0.5rem">
                <a href="{{ route('patients.edit', $patient->id) }}" class="btn-sm teal" style="flex:1;text-align:center">Editar</a>
                <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="flex:1"
                      onsubmit="return confirm('¿Eliminar a {{ $patient->full_name }}?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-sm" style="width:100%;color:var(--rose);border-color:rgba(232,100,122,0.3)">Eliminar</button>
                </form>
            </div>
        </div>

        <!-- MEDICAL INFO CARD -->
        <div class="dash-section">
            <div class="dash-section-header"><h2>Información Médica</h2></div>
            <div style="padding:1.5rem;display:flex;flex-direction:column;gap:1rem">
                <div style="padding:1rem;background:var(--gray-1);border-radius:10px">
                    <p style="font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;color:var(--text-lt);margin-bottom:0.4rem">🩸 Tipo de sangre</p>
                    <p style="font-weight:700;color:var(--deep);font-size:1rem">{{ $patient->blood_type ?: 'Desconocido' }}</p>
                </div>
                @if($patient->allergies)
                <div style="padding:1rem;background:rgba(232,100,122,0.08);border-radius:10px;border:1px solid rgba(232,100,122,0.2)">
                    <p style="font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;color:var(--rose);margin-bottom:0.4rem">⚠️ Alergias</p>
                    <p style="font-size:0.85rem;color:var(--text)">{{ $patient->allergies }}</p>
                </div>
                @endif
                @if($patient->chronic_conditions)
                <div style="padding:1rem;background:rgba(245,166,35,0.08);border-radius:10px;border:1px solid rgba(245,166,35,0.2)">
                    <p style="font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;color:var(--gold);margin-bottom:0.4rem">🏥 Condiciones crónicas</p>
                    <p style="font-size:0.85rem;color:var(--text)">{{ $patient->chronic_conditions }}</p>
                </div>
                @endif
                @if($patient->current_medications)
                <div style="padding:1rem;background:rgba(26,158,140,0.08);border-radius:10px;border:1px solid rgba(26,158,140,0.2)">
                    <p style="font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;color:var(--teal);margin-bottom:0.4rem">💊 Medicación actual</p>
                    <p style="font-size:0.85rem;color:var(--text)">{{ $patient->current_medications }}</p>
                </div>
                @endif
                @if($patient->insurance)
                <div style="padding:1rem;background:var(--gray-1);border-radius:10px">
                    <p style="font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;color:var(--text-lt);margin-bottom:0.4rem">🛡️ Seguro médico</p>
                    <p style="font-size:0.85rem;font-weight:600;color:var(--deep)">{{ $patient->insurance }}</p>
                </div>
                @endif
                @if($patient->emergency_contact_name)
                <div style="padding:1rem;background:var(--gray-1);border-radius:10px">
                    <p style="font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;color:var(--text-lt);margin-bottom:0.4rem">🚨 Contacto de emergencia</p>
                    <p style="font-weight:600;font-size:0.88rem;color:var(--deep)">{{ $patient->emergency_contact_name }}</p>
                    <p style="font-size:0.78rem;color:var(--text-lt)">{{ $patient->emergency_contact_relation }} · {{ $patient->emergency_contact_phone }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- HISTORIAL MÉDICO -->
    <div>
        <div class="dash-section">
            <div class="dash-section-header">
                <h2>Historial Médico</h2>
                <button onclick="document.getElementById('addConsultModal').style.display='flex'" class="btn-sm teal">
                    + Agregar consulta
                </button>
            </div>

            <div class="history-timeline">
                @forelse($patient->consultations->sortByDesc('visit_date') as $consult)
                <div class="history-item" style="padding-left:1.5rem">
                    <div class="history-dot" style="position:absolute;left:0;top:0.4rem"></div>
                    <div style="flex:1">
                        <p class="history-date">{{ \Carbon\Carbon::parse($consult->visit_date)->format('d/m/Y') }}
                            @if($consult->visit_time) · {{ $consult->visit_time }} @endif
                        </p>
                        <p class="history-title">{{ $consult->title }}</p>
                        @if($consult->diagnosis)
                        <div style="margin:0.5rem 0;padding:0.5rem 0.75rem;background:rgba(26,158,140,0.06);border-left:3px solid var(--teal);border-radius:0 8px 8px 0">
                            <p style="font-size:0.72rem;font-weight:700;color:var(--teal);text-transform:uppercase;letter-spacing:0.05em">Diagnóstico</p>
                            <p style="font-size:0.83rem;color:var(--text)">{{ $consult->diagnosis }}</p>
                        </div>
                        @endif
                        @if($consult->treatment)
                        <p class="history-desc"><strong>Tratamiento:</strong> {{ $consult->treatment }}</p>
                        @endif
                        @if($consult->notes)
                        <p class="history-desc" style="margin-top:0.3rem">{{ $consult->notes }}</p>
                        @endif
                        @if($consult->next_visit)
                        <p style="font-size:0.75rem;color:var(--gold);margin-top:0.4rem;font-weight:600">
                            📅 Próxima cita: {{ \Carbon\Carbon::parse($consult->next_visit)->format('d/m/Y') }}
                        </p>
                        @endif
                    </div>
                    <form action="{{ route('consultations.destroy', $consult->id) }}" method="POST"
                          onsubmit="return confirm('¿Eliminar esta consulta?')">
                        @csrf @method('DELETE')
                        <button type="submit" style="background:none;border:none;cursor:pointer;color:var(--gray-3);font-size:0.8rem;flex-shrink:0" title="Eliminar">✕</button>
                    </form>
                </div>
                @empty
                <div style="text-align:center;padding:2.5rem;color:var(--text-lt)">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--gray-3)" stroke-width="1.5" style="margin:0 auto 0.75rem"><path d="M9 3H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2h-4M9 3a2 2 0 004 0M9 3a2 2 0 014 0M12 12v6M9 15h6"/></svg>
                    <p>Sin consultas registradas</p>
                    <button onclick="document.getElementById('addConsultModal').style.display='flex'"
                            style="color:var(--teal);font-weight:600;background:none;border:none;cursor:pointer;margin-top:0.5rem">
                        Agregar primera consulta →
                    </button>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- ===== MODAL: AGREGAR CONSULTA ===== -->
<div id="addConsultModal" style="display:none;position:fixed;inset:0;background:rgba(13,45,58,0.5);backdrop-filter:blur(4px);z-index:1000;align-items:center;justify-content:center;padding:1rem">
    <div style="background:white;border-radius:20px;padding:2rem;width:100%;max-width:560px;max-height:90vh;overflow-y:auto">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
            <h2 style="font-family:'Playfair Display',serif;font-size:1.3rem;color:var(--deep)">Agregar Consulta</h2>
            <button onclick="document.getElementById('addConsultModal').style.display='none'"
                    style="background:none;border:none;cursor:pointer;color:var(--gray-4);font-size:1.3rem;line-height:1">✕</button>
        </div>
        <form action="{{ route('consultations.store', $patient->id) }}" method="POST" style="display:flex;flex-direction:column;gap:1rem">
            @csrf
            <div class="patient-form-grid">
                <div class="form-group">
                    <label>Fecha de consulta *</label>
                    <input type="date" name="visit_date" required value="{{ now()->format('Y-m-d') }}">
                </div>
                <div class="form-group">
                    <label>Hora</label>
                    <input type="time" name="visit_time" value="{{ now()->format('H:i') }}">
                </div>
            </div>
            <div class="form-group">
                <label>Motivo de consulta *</label>
                <input type="text" name="title" required placeholder="Ej: Control mensual, fiebre, dolor...">
            </div>
            <div class="form-group">
                <label>Diagnóstico</label>
                <input type="text" name="diagnosis" placeholder="Ej: Infección viral de vías respiratorias">
            </div>
            <div class="form-group">
                <label>Tratamiento / Receta</label>
                <textarea name="treatment" rows="3" placeholder="Medicamentos, dosis, indicaciones..."></textarea>
            </div>
            <div class="form-group">
                <label>Observaciones adicionales</label>
                <textarea name="notes" rows="2" placeholder="Signos vitales, evolución..."></textarea>
            </div>
            <div class="form-group">
                <label>Próxima cita sugerida</label>
                <input type="date" name="next_visit">
            </div>
            <div style="display:flex;gap:0.75rem;margin-top:0.5rem">
                <button type="button" onclick="document.getElementById('addConsultModal').style.display='none'" class="btn-secondary" style="flex:1">Cancelar</button>
                <button type="submit" class="btn-primary" style="flex:1">
                    💾 Guardar Consulta
                </button>
            </div>
        </form>
    </div>
</div>

@endsection