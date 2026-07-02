@extends('layouts.dashboard')
@section('title', 'Citas')
@section('page-title', 'Solicitudes de Cita')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem">
    <div style="display:flex;gap:0.75rem;align-items:center">
        <span style="font-size:0.85rem;color:var(--text-lt)">
            {{ $appointments->count() }} solicitud(es) total(es)
        </span>
        @if($pendientes > 0)
        <span style="background:rgba(245,166,35,0.12);color:var(--gold);font-size:0.75rem;font-weight:700;padding:0.3rem 0.75rem;border-radius:100px">
            {{ $pendientes }} pendiente(s)
        </span>
        @endif
    </div>
</div>

<div class="dash-section">
    <div class="table-wrap">
    <table class="patient-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Tipo</th>
                <th>Fecha deseada</th>
                <th>Estado</th>
                <th>Recibida</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appointments as $appointment)
            <tr>
                <td style="font-weight:600">{{ $appointment->nombre }}</td>
                <td>{{ $appointment->email }}</td>
                <td>{{ $appointment->telefono ?: '—' }}</td>
                <td>{{ $appointment->tipo ?: '—' }}</td>
                <td>{{ $appointment->fecha_deseada ? \Carbon\Carbon::parse($appointment->fecha_deseada)->format('d/m/Y') : '—' }}</td>
                <td>
                    <span class="badge-status badge-{{ $appointment->status === 'confirmada' ? 'activo' : ($appointment->status === 'cancelada' ? 'inactivo' : 'pendiente') }}">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </td>
                <td style="font-size:0.82rem;color:var(--text-lt)">{{ $appointment->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <div style="display:flex;gap:0.4rem">
                        <form action="{{ route('appointments.updateStatus', $appointment->id) }}" method="POST" style="display:inline">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="confirmada">
                            <button type="submit" class="btn-sm" style="color:var(--sage);border-color:rgba(76,175,125,0.3)" title="Confirmar">✓</button>
                        </form>
                        <form action="{{ route('appointments.updateStatus', $appointment->id) }}" method="POST" style="display:inline">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="cancelada">
                            <button type="submit" class="btn-sm" style="color:var(--rose);border-color:rgba(232,100,122,0.3)" title="Cancelar">✕</button>
                        </form>
                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST"
                              onsubmit="return confirm('¿Eliminar esta solicitud?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-sm" style="color:var(--gray-4);border-color:var(--gray-2)" title="Eliminar">🗑</button>
                        </form>
                    </div>
                </td>
            </tr>
            @if($appointment->mensaje)
            <tr>
                <td colspan="8" style="padding:0 1.5rem 1rem;background:var(--gray-1);border-radius:0 0 10px 10px;font-size:0.82rem;color:var(--text-lt)">
                    <strong>Mensaje:</strong> {{ $appointment->mensaje }}
                </td>
            </tr>
            @endif
            @empty
            <tr>
                <td colspan="8" style="text-align:center;padding:3rem;color:var(--text-lt)">
                    <p style="font-weight:600;margin-bottom:0.5rem">No hay solicitudes de cita</p>
                    <p style="font-size:0.82rem">Las solicitudes del formulario de contacto aparecerán aquí.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>

@endsection
