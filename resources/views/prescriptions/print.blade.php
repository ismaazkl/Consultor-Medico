<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receta Médica - {{ $prescription->consultation->patient->full_name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            color: #334155;
            background: #fff;
            padding: 2rem;
        }

        .prescription-container {
            max-width: 700px;
            margin: 0 auto;
            border: 2px solid #0d2d3a;
            border-radius: 12px;
            overflow: hidden;
        }

        .rx-header {
            background: #0d2d3a;
            color: white;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .rx-header-left h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .rx-header-left p {
            font-size: 0.85rem;
            opacity: 0.8;
        }

        .rx-header-right {
            text-align: right;
        }

        .rx-header-right .rx-label {
            font-size: 2rem;
            font-weight: 700;
            font-family: 'Playfair Display', serif;
            color: #1a9e8c;
        }

        .rx-header-right p {
            font-size: 0.75rem;
            opacity: 0.7;
        }

        .rx-body {
            padding: 2rem;
        }

        .rx-patient-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px dashed #e2e8f0;
            margin-bottom: 1.5rem;
        }

        .rx-info-item {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
        }

        .rx-info-label {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #64748b;
        }

        .rx-info-value {
            font-size: 0.95rem;
            font-weight: 600;
            color: #0d2d3a;
        }

        .rx-medication {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 1.25rem;
            margin-bottom: 1rem;
        }

        .rx-med-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: #0d2d3a;
            margin-bottom: 0.75rem;
        }

        .rx-med-details {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }

        .rx-detail {
            display: flex;
            flex-direction: column;
            gap: 0.15rem;
        }

        .rx-detail-label {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #1a9e8c;
        }

        .rx-detail-value {
            font-size: 0.9rem;
            font-weight: 600;
            color: #334155;
        }

        .rx-instructions {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
        }

        .rx-instructions-label {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            margin-bottom: 0.3rem;
        }

        .rx-instructions-text {
            font-size: 0.88rem;
            color: #334155;
            line-height: 1.5;
        }

        .rx-footer {
            padding: 1.5rem 2rem;
            border-top: 2px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .rx-doctor-info p {
            font-size: 0.82rem;
            color: #64748b;
            line-height: 1.5;
        }

        .rx-doctor-info .doctor-name {
            font-size: 1rem;
            font-weight: 700;
            color: #0d2d3a;
        }

        .rx-date {
            text-align: right;
        }

        .rx-date p {
            font-size: 0.82rem;
            color: #64748b;
        }

        .rx-date .date-value {
            font-weight: 600;
            color: #0d2d3a;
        }

        .rx-signature {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
            text-align: center;
        }

        .rx-signature-line {
            width: 200px;
            border-top: 2px solid #0d2d3a;
            margin: 0 auto 0.5rem;
            padding-top: 0.5rem;
        }

        .rx-signature-name {
            font-size: 0.9rem;
            font-weight: 700;
            color: #0d2d3a;
        }

        .rx-signature-title {
            font-size: 0.75rem;
            color: #64748b;
        }

        .no-print {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .no-print button {
            padding: 0.75rem 2rem;
            background: #1a9e8c;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .no-print button:hover {
            background: #148a7b;
            transform: translateY(-1px);
        }

        @media print {
            body { padding: 0; background: white; }
            .no-print { display: none !important; }
            .prescription-container { border: none; box-shadow: none; }
            .rx-header { background: #0d2d3a !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body>
    <div class="no-print">
        <button onclick="window.print()">🖨️ Imprimir Receta</button>
        <button onclick="window.close()" style="background:#64748b;margin-left:0.5rem">Cerrar</button>
    </div>

    <div class="prescription-container">
        <div class="rx-header">
            <div class="rx-header-left">
                <h1>Dr. {{ $doctor->name ?? 'Gary Vergara' }}</h1>
                <p>Médico General & Familiar</p>
            </div>
            <div class="rx-header-right">
                <div class="rx-label">Rx</div>
                <p>Receta Médica</p>
            </div>
        </div>

        <div class="rx-body">
            <div class="rx-patient-info">
                <div class="rx-info-item">
                    <span class="rx-info-label">Paciente</span>
                    <span class="rx-info-value">{{ $prescription->consultation->patient->full_name }}</span>
                </div>
                <div class="rx-info-item">
                    <span class="rx-info-label">Edad</span>
                    <span class="rx-info-value">{{ $prescription->consultation->patient->age }} años</span>
                </div>
                <div class="rx-info-item">
                    <span class="rx-info-label">Cédula / DNI</span>
                    <span class="rx-info-value">{{ $prescription->consultation->patient->id_number ?: '—' }}</span>
                </div>
                <div class="rx-info-item">
                    <span class="rx-info-label">Fecha</span>
                    <span class="rx-info-value">{{ $prescription->created_at->format('d/m/Y') }}</span>
                </div>
            </div>

            <div class="rx-medication">
                <div class="rx-med-name">💊 {{ $prescription->medication_name }}</div>
                <div class="rx-med-details">
                    <div class="rx-detail">
                        <span class="rx-detail-label">Dosis</span>
                        <span class="rx-detail-value">{{ $prescription->dosage }}</span>
                    </div>
                    <div class="rx-detail">
                        <span class="rx-detail-label">Frecuencia</span>
                        <span class="rx-detail-value">{{ $prescription->frequency }}</span>
                    </div>
                    @if($prescription->duration)
                    <div class="rx-detail">
                        <span class="rx-detail-label">Duración</span>
                        <span class="rx-detail-value">{{ $prescription->duration }}</span>
                    </div>
                    @endif
                </div>
                @if($prescription->instructions)
                <div class="rx-instructions">
                    <p class="rx-instructions-label">Instrucciones</p>
                    <p class="rx-instructions-text">{{ $prescription->instructions }}</p>
                </div>
                @endif
            </div>

            <div class="rx-signature">
                <div class="rx-signature-line">
                    <p class="rx-signature-name">Dr. {{ $doctor->name ?? 'Gary Vergara' }}</p>
                    <p class="rx-signature-title">Médico General & Familiar</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
