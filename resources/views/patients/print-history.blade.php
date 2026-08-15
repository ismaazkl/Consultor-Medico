<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial — {{ $patient->full_name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DM Sans', sans-serif; color: #334155; padding: 2rem; font-size: 13px; line-height: 1.5; }
        h1 { font-size: 1.5rem; font-weight: 700; color: #0d2d3a; margin-bottom: 0.25rem; }
        h2 { font-size: 1rem; font-weight: 700; color: #0d2d3a; margin: 1.5rem 0 0.75rem; border-bottom: 2px solid #1a9e8c; padding-bottom: 0.35rem; }
        h3 { font-size: 0.9rem; font-weight: 600; color: #334155; margin-bottom: 0.25rem; }
        .header { text-align: center; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 2px solid #1a9e8c; }
        .header p { color: #64748b; font-size: 0.85rem; }
        .header .date { font-size: 0.75rem; color: #94a3b8; margin-top: 0.25rem; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 0.75rem; margin-bottom: 1.5rem; padding: 1rem; background: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0; }
        .info-item label { font-size: 0.7rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 0.15rem; }
        .info-item span { font-weight: 600; color: #0d2d3a; }
        .consultation { margin-bottom: 1.25rem; padding: 1rem; border: 1px solid #e2e8f0; border-radius: 8px; page-break-inside: avoid; }
        .consultation-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem; }
        .consultation-header .date { font-size: 0.78rem; font-weight: 600; color: #1a9e8c; }
        .consultation-header .title { font-weight: 700; color: #0d2d3a; }
        .detail { margin-bottom: 0.35rem; }
        .detail strong { color: #64748b; font-size: 0.78rem; }
        .prescription-list { margin-top: 0.5rem; padding: 0.5rem 0.75rem; background: #f8fafc; border-radius: 6px; }
        .prescription-item { padding: 0.3rem 0; border-bottom: 1px solid #e2e8f0; font-size: 0.82rem; }
        .prescription-item:last-child { border-bottom: none; }
        .rx-label { font-weight: 700; color: #1a9e8c; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .footer { text-align: center; margin-top: 2rem; padding-top: 1rem; border-top: 1px solid #e2e8f0; color: #94a3b8; font-size: 0.75rem; }

        @media print {
            body { padding: 1rem; font-size: 11px; }
            .no-print { display: none !important; }
            .consultation { break-inside: avoid; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align:right;margin-bottom:1rem">
        <button onclick="window.print()" style="padding:0.5rem 1rem;background:#1a9e8c;color:white;border:none;border-radius:6px;font-weight:600;cursor:pointer;font-size:0.82rem">
            🖨 Imprimir
        </button>
        <button onclick="window.close()" style="padding:0.5rem 1rem;background:#e2e8f0;color:#334155;border:none;border-radius:6px;font-weight:600;cursor:pointer;font-size:0.82rem;margin-left:0.5rem">
            Cerrar
        </button>
    </div>

    <div class="header">
        <h1>Historial Médico</h1>
        <p>{{ $doctor?->name ?? 'Dr. Gary Vergara' }}</p>
        <p class="date">Generado el {{ now()->format('d/m/Y \a \l\a\s H:i') }}</p>
    </div>

    <h2>Datos del Paciente</h2>
    <div class="info-grid">
        <div class="info-item">
            <label>Nombre</label>
            <span>{{ $patient->full_name }}</span>
        </div>
        <div class="info-item">
            <label>Cédula</label>
            <span>{{ $patient->id_number ?? '—' }}</span>
        </div>
        <div class="info-item">
            <label>Edad</label>
            <span>{{ $patient->age }} años</span>
        </div>
        <div class="info-item">
            <label>Género</label>
            <span>{{ ucfirst($patient->gender) }}</span>
        </div>
        <div class="info-item">
            <label>Teléfono</label>
            <span>{{ $patient->phone ?? '—' }}</span>
        </div>
        <div class="info-item">
            <label>Email</label>
            <span>{{ $patient->email ?? '—' }}</span>
        </div>
        <div class="info-item">
            <label>Tipo de Sangre</label>
            <span>{{ $patient->blood_type ?? '—' }}</span>
        </div>
        <div class="info-item">
            <label>Seguro</label>
            <span>{{ $patient->insurance ?? '—' }}</span>
        </div>
        <div class="info-item">
            <label>Estado</label>
            <span>{{ ucfirst($patient->status ?? 'activo') }}</span>
        </div>
    </div>

    @if($patient->allergies)
    <div style="margin-bottom:1rem;padding:0.75rem;background:#fff5f5;border:1px solid #fecaca;border-radius:8px">
        <strong style="color:#e8647a;font-size:0.82rem">⚠ Alergias:</strong>
        <span style="margin-left:0.5rem;font-size:0.85rem">{{ $patient->allergies }}</span>
    </div>
    @endif

    @if($patient->chronic_conditions)
    <div style="margin-bottom:1rem;padding:0.75rem;background:#fffbeb;border:1px solid #fde68a;border-radius:8px">
        <strong style="color:#f5a623;font-size:0.82rem">📋 Condiciones Crónicas:</strong>
        <span style="margin-left:0.5rem;font-size:0.85rem">{{ $patient->chronic_conditions }}</span>
    </div>
    @endif

    <h2>Consultas ({{ $patient->consultations->count() }})</h2>

    @forelse($patient->consultations as $consultation)
    <div class="consultation">
        <div class="consultation-header">
            <span class="title">{{ $consultation->title }}</span>
            <span class="date">{{ $consultation->visit_date->format('d/m/Y') }}</span>
        </div>

        @if($consultation->diagnosis)
        <div class="detail">
            <strong>Diagnóstico:</strong> {{ $consultation->diagnosis }}
        </div>
        @endif

        @if($consultation->treatment)
        <div class="detail">
            <strong>Tratamiento:</strong> {{ $consultation->treatment }}
        </div>
        @endif

        @if($consultation->notes)
        <div class="detail">
            <strong>Notas:</strong> {{ $consultation->notes }}
        </div>
        @endif

        @if($consultation->next_visit)
        <div class="detail">
            <strong>Próxima visita:</strong> {{ $consultation->next_visit->format('d/m/Y') }}
        </div>
        @endif

        @if($consultation->prescriptions->count() > 0)
        <div class="prescription-list">
            <span class="rx-label">💊 Recetas:</span>
            @foreach($consultation->prescriptions as $rx)
            <div class="prescription-item">
                <strong>{{ $rx->medication_name }}</strong> — {{ $rx->dosage }}, {{ $rx->frequency }}
                @if($rx->duration) | Duración: {{ $rx->duration }}@endif
                @if($rx->instructions) <br><em style="color:#64748b">{{ $rx->instructions }}</em>@endif
            </div>
            @endforeach
        </div>
        @endif
    </div>
    @empty
    <p style="text-align:center;color:#94a3b8;padding:2rem">No hay consultas registradas.</p>
    @endforelse

    <div class="footer">
        <p>{{ $doctor?->name ?? 'Dr. Gary Vergara' }} · Historial generado automáticamente</p>
    </div>
</body>
</html>
