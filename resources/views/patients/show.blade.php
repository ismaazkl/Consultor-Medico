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
                <a href="{{ route('patients.printHistory', $patient->id) }}" target="_blank" class="btn-sm" style="flex:1;text-align:center;color:var(--teal);border-color:rgba(26,158,140,0.3)">🖨 Imprimir</a>
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
                <div style="display:flex;gap:0.5rem">
                    <button onclick="document.getElementById('addPrescriptionModal').style.display='flex'" class="btn-sm" style="color:var(--gold);border-color:rgba(245,166,35,0.3)">
                        + Receta
                    </button>
                    <button onclick="document.getElementById('addConsultModal').style.display='flex'" class="btn-sm teal">
                        + Consulta
                    </button>
                </div>
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
                        @if($consult->weight || $consult->bp_systolic || $consult->temperature || $consult->heart_rate)
                        <div style="display:flex;flex-wrap:wrap;gap:0.5rem;margin-top:0.5rem">
                            @if($consult->weight && $consult->height)
                                @php $imcVal = round($consult->weight / (($consult->height/100) * ($consult->height/100)), 1); @endphp
                                <span style="display:inline-flex;align-items:center;gap:0.25rem;padding:0.2rem 0.5rem;background:var(--teal-light);border-radius:6px;font-size:0.72rem;font-weight:600;color:var(--teal)">⚖ {{ $consult->weight }}kg · IMC {{ $imcVal }}</span>
                            @endif
                            @if($consult->bp_systolic)
                                @php
                                    $bpC = ($consult->bp_systolic >= 140 || $consult->bp_diastolic >= 90) ? 'var(--rose)' : (($consult->bp_systolic >= 120 || $consult->bp_diastolic >= 80) ? 'var(--gold)' : 'var(--sage)');
                                @endphp
                                <span style="display:inline-flex;align-items:center;gap:0.25rem;padding:0.2rem 0.5rem;background:{{ $bpC }}15;border-radius:6px;font-size:0.72rem;font-weight:600;color:{{ $bpC }}">🫀 {{ $consult->bp_systolic }}/{{ $consult->bp_diastolic }}</span>
                            @endif
                            @if($consult->temperature)
                                <span style="display:inline-flex;align-items:center;gap:0.25rem;padding:0.2rem 0.5rem;background:var(--gold-light);border-radius:6px;font-size:0.72rem;font-weight:600;color:var(--gold)">🌡 {{ $consult->temperature }}°C</span>
                            @endif
                            @if($consult->heart_rate)
                                <span style="display:inline-flex;align-items:center;gap:0.25rem;padding:0.2rem 0.5rem;background:var(--sage-light);border-radius:6px;font-size:0.72rem;font-weight:600;color:var(--sage)">💓 {{ $consult->heart_rate }} lpm</span>
                            @endif
                        </div>
                        @endif
                        @if($consult->next_visit)
                        <p style="font-size:0.75rem;color:var(--gold);margin-top:0.4rem;font-weight:600">
                            📅 Próxima cita: {{ \Carbon\Carbon::parse($consult->next_visit)->format('d/m/Y') }}
                        </p>
                        @endif
                        @if($consult->prescriptions->count() > 0)
                        <div style="margin-top:0.75rem;padding-top:0.75rem;border-top:1px solid var(--gray-2)">
                            <p style="font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;color:var(--gold);margin-bottom:0.5rem">💊 Recetas</p>
                            @foreach($consult->prescriptions as $rx)
                            <div style="display:flex;align-items:center;justify-content:space-between;padding:0.5rem 0.75rem;background:rgba(245,166,35,0.06);border-radius:8px;margin-bottom:0.4rem;border:1px solid rgba(245,166,35,0.15)">
                                <div>
                                    <p style="font-size:0.85rem;font-weight:600;color:var(--deep)">{{ $rx->medication_name }}</p>
                                    <p style="font-size:0.75rem;color:var(--text-lt)">{{ $rx->dosage }} · {{ $rx->frequency }}</p>
                                </div>
                                <div style="display:flex;gap:0.3rem">
                                    <a href="{{ route('prescriptions.print', $rx->id) }}" target="_blank" class="btn-sm" style="color:var(--teal);border-color:rgba(26,158,140,0.3)" title="Imprimir receta">🖨</a>
                                    <form action="{{ route('prescriptions.destroy', $rx->id) }}" method="POST" onsubmit="return confirm('¿Eliminar esta receta?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" style="background:none;border:none;cursor:pointer;color:var(--gray-3);font-size:0.8rem" title="Eliminar">✕</button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
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

<!-- ===== SIGNOS VITALES: GRÁFICAS ===== -->
<div class="dash-section" style="margin-top:1.5rem">
    <div class="dash-section-header">
        <h2>📊 Signos Vitales</h2>
    </div>
    @php
        $vitals = $patient->consultations()
            ->whereNotNull('weight')
            ->orWhereNotNull('bp_systolic')
            ->orWhereNotNull('temperature')
            ->orWhereNotNull('heart_rate')
            ->orderBy('visit_date')
            ->get();
        $hasVitals = $vitals->isNotEmpty();
    @endphp
    @if($hasVitals)
    <div style="padding:1.5rem">
        {{-- Último IMC --}}
        @php
            $lastWithWeight = $patient->consultations()->whereNotNull('weight')->whereNotNull('height')->latest('visit_date')->first();
            $imc = null;
            $imcClass = '';
            if($lastWithWeight && $lastWithWeight->height > 0) {
                $imc = round($lastWithWeight->weight / (($lastWithWeight->height/100) * ($lastWithWeight->height/100)), 1);
                if($imc < 18.5) { $imcClass = 'Bajo peso'; }
                elseif($imc < 25) { $imcClass = 'Normal'; }
                elseif($imc < 30) { $imcClass = 'Sobrepeso'; }
                else { $imcClass = 'Obesidad'; }
            }
        @endphp

        {{-- Resumen rápido --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:0.75rem;margin-bottom:1.5rem">
            @if($lastWithWeight)
            <div style="padding:0.85rem;background:var(--gray-1);border-radius:10px;text-align:center">
                <p style="font-size:0.72rem;font-weight:700;text-transform:uppercase;color:var(--text-lt);letter-spacing:0.05em">IMC</p>
                <p style="font-size:1.5rem;font-weight:700;color:var(--deep);font-family:var(--font-display)">{{ $imc }}</p>
                <p style="font-size:0.75rem;font-weight:600;color:{{ $imcClass === 'Normal' ? 'var(--sage)' : ($imcClass === 'Bajo peso' ? 'var(--gold)' : 'var(--rose)') }}">{{ $imcClass }}</p>
            </div>
            @endif
            @php
                $lastBP = $patient->consultations()->whereNotNull('bp_systolic')->latest('visit_date')->first();
            @endphp
            @if($lastBP)
            <div style="padding:0.85rem;background:var(--gray-1);border-radius:10px;text-align:center">
                <p style="font-size:0.72rem;font-weight:700;text-transform:uppercase;color:var(--text-lt);letter-spacing:0.05em">Presión</p>
                <p style="font-size:1.5rem;font-weight:700;color:var(--deep);font-family:var(--font-display)">{{ $lastBP->bp_systolic }}/{{ $lastBP->bp_diastolic }}</p>
                @php
                    $bpClass = 'Normal';
                    $bpColor = 'var(--sage)';
                    if($lastBP->bp_systolic >= 140 || $lastBP->bp_diastolic >= 90) { $bpClass = 'Hipertensión'; $bpColor = 'var(--rose)'; }
                    elseif($lastBP->bp_systolic >= 120 || $lastBP->bp_diastolic >= 80) { $bpClass = 'Prehipertensión'; $bpColor = 'var(--gold)'; }
                @endphp
                <p style="font-size:0.75rem;font-weight:600;color:{{ $bpColor }}">{{ $bpClass }}</p>
            </div>
            @endif
            @php
                $lastTemp = $patient->consultations()->whereNotNull('temperature')->latest('visit_date')->first();
            @endphp
            @if($lastTemp)
            <div style="padding:0.85rem;background:var(--gray-1);border-radius:10px;text-align:center">
                <p style="font-size:0.72rem;font-weight:700;text-transform:uppercase;color:var(--text-lt);letter-spacing:0.05em">Temperatura</p>
                <p style="font-size:1.5rem;font-weight:700;color:var(--deep);font-family:var(--font-display)">{{ $lastTemp->temperature }}°</p>
                @php
                    $tempClass = $lastTemp->temperature >= 38 ? 'Fiebre' : ($lastTemp->temperature < 35 ? 'Hipotermia' : 'Normal');
                    $tempColor = $lastTemp->temperature >= 38 ? 'var(--rose)' : ($lastTemp->temperature < 35 ? 'var(--gold)' : 'var(--sage)');
                @endphp
                <p style="font-size:0.75rem;font-weight:600;color:{{ $tempColor }}">{{ $tempClass }}</p>
            </div>
            @endif
            @php
                $lastHR = $patient->consultations()->whereNotNull('heart_rate')->latest('visit_date')->first();
            @endphp
            @if($lastHR)
            <div style="padding:0.85rem;background:var(--gray-1);border-radius:10px;text-align:center">
                <p style="font-size:0.72rem;font-weight:700;text-transform:uppercase;color:var(--text-lt);letter-spacing:0.05em">Frec. Cardíaca</p>
                <p style="font-size:1.5rem;font-weight:700;color:var(--deep);font-family:var(--font-display)">{{ $lastHR->heart_rate }} <span style="font-size:0.8rem;font-weight:500">lpm</span></p>
                @php
                    $hrClass = $lastHR->heart_rate < 60 ? 'Bradicardia' : ($lastHR->heart_rate > 100 ? 'Taquicardia' : 'Normal');
                    $hrColor = $lastHR->heart_rate < 60 ? 'var(--gold)' : ($lastHR->heart_rate > 100 ? 'var(--rose)' : 'var(--sage)');
                @endphp
                <p style="font-size:0.75rem;font-weight:600;color:{{ $hrColor }}">{{ $hrClass }}</p>
            </div>
            @endif
        </div>

        {{-- Gráficas --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
            {{-- IMC --}}
            @if($patient->consultations()->whereNotNull('weight')->whereNotNull('height')->count() > 0)
            <div style="background:var(--gray-1);border-radius:12px;padding:1.25rem">
                <p style="font-size:0.82rem;font-weight:700;color:var(--deep);margin-bottom:0.75rem">IMC (Peso/Estatura²)</p>
                <canvas id="chartIMC" height="140"></canvas>
            </div>
            @endif
            {{-- Presión Arterial --}}
            @if($patient->consultations()->whereNotNull('bp_systolic')->count() > 0)
            <div style="background:var(--gray-1);border-radius:12px;padding:1.25rem">
                <p style="font-size:0.82rem;font-weight:700;color:var(--deep);margin-bottom:0.75rem">Presión Arterial (mmHg)</p>
                <canvas id="chartBP" height="140"></canvas>
            </div>
            @endif
            {{-- Temperatura --}}
            @if($patient->consultations()->whereNotNull('temperature')->count() > 0)
            <div style="background:var(--gray-1);border-radius:12px;padding:1.25rem">
                <p style="font-size:0.82rem;font-weight:700;color:var(--deep);margin-bottom:0.75rem">Temperatura (°C)</p>
                <canvas id="chartTemp" height="140"></canvas>
            </div>
            @endif
            {{-- Frecuencia Cardíaca --}}
            @if($patient->consultations()->whereNotNull('heart_rate')->count() > 0)
            <div style="background:var(--gray-1);border-radius:12px;padding:1.25rem">
                <p style="font-size:0.82rem;font-weight:700;color:var(--deep);margin-bottom:0.75rem">Frecuencia Cardíaca (lpm)</p>
                <canvas id="chartHR" height="140"></canvas>
            </div>
            @endif
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartDefaults = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { size: 10 } } },
                    y: { grid: { color: '#e2e8f0' }, ticks: { font: { size: 10 } } }
                },
                elements: { point: { radius: 4, hoverRadius: 6 }, line: { tension: 0.3, borderWidth: 2 } }
            };

            @foreach($patient->consultations()->whereNotNull('weight')->whereNotNull('height')->orderBy('visit_date') as $c)
                @if($loop->first)
                    var imcLabels = [];
                    var imcData = [];
                @endif
                imcLabels.push('{{ $c->visit_date->format("d/m") }}');
                imcData.push({{ round($c->weight / (($c->height/100) * ($c->height/100)), 1) }});
            @endforeach
            if (typeof imcLabels !== 'undefined' && imcLabels.length > 0) {
                new Chart(document.getElementById('chartIMC'), {
                    type: 'line',
                    data: {
                        labels: imcLabels,
                        datasets: [{
                            data: imcData,
                            borderColor: '#1a9e8c',
                            backgroundColor: 'rgba(26,158,140,0.1)',
                            fill: true
                        }]
                    },
                    options: {
                        ...chartDefaults,
                        scales: {
                            ...chartDefaults.scales,
                            y: { ...chartDefaults.scales.y, suggestedMin: 15, suggestedMax: 35 }
                        }
                    }
                });
            }

            @foreach($patient->consultations()->whereNotNull('bp_systolic')->orderBy('visit_date') as $c)
                @if($loop->first)
                    var bpLabels = [], bpSys = [], bpDia = [];
                @endif
                bpLabels.push('{{ $c->visit_date->format("d/m") }}');
                bpSys.push({{ $c->bp_systolic }});
                bpDia.push({{ $c->bp_diastolic }});
            @endforeach
            if (typeof bpLabels !== 'undefined' && bpLabels.length > 0) {
                new Chart(document.getElementById('chartBP'), {
                    type: 'line',
                    data: {
                        labels: bpLabels,
                        datasets: [
                            { label: 'Sistólica', data: bpSys, borderColor: '#e8647a', backgroundColor: 'rgba(232,100,122,0.1)', fill: false },
                            { label: 'Diastólica', data: bpDia, borderColor: '#5b6abf', backgroundColor: 'rgba(91,106,191,0.1)', fill: false }
                        ]
                    },
                    options: {
                        ...chartDefaults,
                        plugins: { legend: { display: true, position: 'top', labels: { font: { size: 10 }, boxWidth: 12 } } },
                        scales: {
                            ...chartDefaults.scales,
                            y: { ...chartDefaults.scales.y, suggestedMin: 50, suggestedMax: 180 }
                        }
                    }
                });
            }

            @foreach($patient->consultations()->whereNotNull('temperature')->orderBy('visit_date') as $c)
                @if($loop->first)
                    var tempLabels = [], tempData = [];
                @endif
                tempLabels.push('{{ $c->visit_date->format("d/m") }}');
                tempData.push({{ $c->temperature }});
            @endforeach
            if (typeof tempLabels !== 'undefined' && tempLabels.length > 0) {
                new Chart(document.getElementById('chartTemp'), {
                    type: 'line',
                    data: {
                        labels: tempLabels,
                        datasets: [{
                            data: tempData,
                            borderColor: '#f5a623',
                            backgroundColor: 'rgba(245,166,35,0.1)',
                            fill: true
                        }]
                    },
                    options: {
                        ...chartDefaults,
                        scales: {
                            ...chartDefaults.scales,
                            y: { ...chartDefaults.scales.y, suggestedMin: 35, suggestedMax: 40 }
                        }
                    }
                });
            }

            @foreach($patient->consultations()->whereNotNull('heart_rate')->orderBy('visit_date') as $c)
                @if($loop->first)
                    var hrLabels = [], hrData = [];
                @endif
                hrLabels.push('{{ $c->visit_date->format("d/m") }}');
                hrData.push({{ $c->heart_rate }});
            @endforeach
            if (typeof hrLabels !== 'undefined' && hrLabels.length > 0) {
                new Chart(document.getElementById('chartHR'), {
                    type: 'line',
                    data: {
                        labels: hrLabels,
                        datasets: [{
                            data: hrData,
                            borderColor: '#4caf7d',
                            backgroundColor: 'rgba(76,175,125,0.1)',
                            fill: true
                        }]
                    },
                    options: {
                        ...chartDefaults,
                        scales: {
                            ...chartDefaults.scales,
                            y: { ...chartDefaults.scales.y, suggestedMin: 40, suggestedMax: 120 }
                        }
                    }
                });
            }
        });
        </script>
    </div>
    @else
    <div style="text-align:center;padding:3rem;color:var(--text-lt)">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--gray-3)" stroke-width="1.5" style="margin:0 auto 0.75rem"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
        <p style="font-size:0.88rem">Sin datos de signos vitales</p>
        <p style="font-size:0.78rem;margin-top:0.25rem">Agrega peso, estatura, presión o temperatura en una consulta</p>
    </div>
    @endif
</div>

<!-- ===== MODAL: AGREGAR RECETA ===== -->
<div id="addPrescriptionModal" style="display:none;position:fixed;inset:0;background:rgba(13,45,58,0.5);backdrop-filter:blur(4px);z-index:1000;align-items:center;justify-content:center;padding:1rem">
    <div style="background:white;border-radius:20px;padding:2rem;width:100%;max-width:500px;max-height:90vh;overflow-y:auto">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
            <h2 style="font-family:'Playfair Display',serif;font-size:1.3rem;color:var(--deep)">💊 Agregar Receta</h2>
            <button onclick="document.getElementById('addPrescriptionModal').style.display='none'"
                    style="background:none;border:none;cursor:pointer;color:var(--gray-4);font-size:1.3rem;line-height:1">✕</button>
        </div>
        <form action="{{ route('prescriptions.store', $patient->id) }}" method="POST" style="display:flex;flex-direction:column;gap:1rem">
            @csrf
            <div class="form-group">
                <label>Consulta asociada *</label>
                <select name="consultation_id" required>
                    <option value="">— Seleccione consulta —</option>
                    @foreach($patient->consultations->sortByDesc('visit_date') as $consult)
                    <option value="{{ $consult->id }}">
                        {{ \Carbon\Carbon::parse($consult->visit_date)->format('d/m/Y') }} - {{ $consult->title }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Nombre del medicamento *</label>
                <input type="text" name="medication_name" required placeholder="Ej: Amoxicilina 500mg">
            </div>
            <div class="patient-form-grid">
                <div class="form-group">
                    <label>Dosis *</label>
                    <input type="text" name="dosage" required placeholder="Ej: 1 cápsula">
                </div>
                <div class="form-group">
                    <label>Frecuencia *</label>
                    <input type="text" name="frequency" required placeholder="Ej: Cada 8 horas">
                </div>
            </div>
            <div class="form-group">
                <label>Duración</label>
                <input type="text" name="duration" placeholder="Ej: 7 días">
            </div>
            <div class="form-group">
                <label>Instrucciones adicionales</label>
                <textarea name="instructions" rows="2" placeholder="Ej: Tomar con alimentos, evitar alcohol..."></textarea>
            </div>
            <div style="display:flex;gap:0.75rem;margin-top:0.5rem">
                <button type="button" onclick="document.getElementById('addPrescriptionModal').style.display='none'" class="btn-secondary" style="flex:1">Cancelar</button>
                <button type="submit" class="btn-primary" style="flex:1">
                    💾 Guardar Receta
                </button>
            </div>
        </form>
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
                <textarea name="notes" rows="2" placeholder="Evolución, observaciones..."></textarea>
            </div>

            <!-- SIGNOS VITALES -->
            <div style="border-top:1px solid var(--gray-2);padding-top:1rem;margin-top:0.5rem">
                <p style="font-size:0.82rem;font-weight:700;color:var(--teal);margin-bottom:0.75rem;text-transform:uppercase;letter-spacing:0.05em">📊 Signos Vitales</p>
                <div class="patient-form-grid">
                    <div class="form-group">
                        <label>Peso (kg)</label>
                        <input type="number" name="weight" step="0.1" min="0" max="300" placeholder="Ej: 72.5">
                    </div>
                    <div class="form-group">
                        <label>Estatura (cm)</label>
                        <input type="number" name="height" step="0.1" min="0" max="300" placeholder="Ej: 170">
                    </div>
                    <div class="form-group">
                        <label>Presión Arterial</label>
                        <div style="display:flex;align-items:center;gap:0.35rem">
                            <input type="number" name="bp_systolic" min="0" max="300" placeholder="120" style="flex:1">
                            <span style="color:var(--text-lt);font-weight:600">/</span>
                            <input type="number" name="bp_diastolic" min="0" max="200" placeholder="80" style="flex:1">
                            <span style="font-size:0.72rem;color:var(--text-lt)">mmHg</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Temperatura (°C)</label>
                        <input type="number" name="temperature" step="0.1" min="30" max="45" placeholder="36.5">
                    </div>
                    <div class="form-group">
                        <label>Frecuencia Cardíaca (lpm)</label>
                        <input type="number" name="heart_rate" min="0" max="300" placeholder="72">
                    </div>
                </div>
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