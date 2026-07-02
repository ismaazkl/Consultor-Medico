@extends('layouts.dashboard')
@section('title', isset($patient) ? 'Editar Paciente' : 'Nuevo Paciente')
@section('page-title', isset($patient) ? 'Editar: ' . $patient->full_name : 'Agregar Nuevo Paciente')

@section('content')

<div style="max-width:800px">
    <div class="dash-section">
        <div class="dash-section-header">
            <h2>{{ isset($patient) ? 'Información del Paciente' : 'Datos del Nuevo Paciente' }}</h2>
        </div>
        <div style="padding:2rem">
            <form action="{{ isset($patient) ? route('patients.update', $patient->id) : route('patients.store') }}" 
                  method="POST">
                @csrf
                @if(isset($patient)) @method('PUT') @endif

                @if($errors->any())
                <div style="padding:1rem;background:rgba(232,100,122,0.1);border:1px solid rgba(232,100,122,0.3);border-radius:10px;margin-bottom:1.5rem;color:var(--rose)">
                    <strong>Por favor corrija los siguientes errores:</strong>
                    <ul style="margin-top:0.5rem;padding-left:1.25rem">
                        @foreach($errors->all() as $error)
                        <li style="font-size:0.85rem">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- SECTION: Personal -->
                <div style="margin-bottom:2rem">
                    <p style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:var(--text-lt);margin-bottom:1rem;padding-bottom:0.5rem;border-bottom:1px solid var(--gray-2)">
                        👤 Información Personal
                    </p>
                    <div class="patient-form-grid">
                        <div class="form-group">
                            <label>Nombre *</label>
                            <input type="text" name="first_name" required
                                   value="{{ old('first_name', $patient->first_name ?? '') }}"
                                   placeholder="Ej: María">
                        </div>
                        <div class="form-group">
                            <label>Apellido *</label>
                            <input type="text" name="last_name" required
                                   value="{{ old('last_name', $patient->last_name ?? '') }}"
                                   placeholder="Ej: García">
                        </div>
                        <div class="form-group">
                            <label>Fecha de nacimiento *</label>
                            <input type="date" name="birth_date" required
                                   value="{{ old('birth_date', isset($patient) ? $patient->birth_date->format('Y-m-d') : '') }}">
                        </div>
                        <div class="form-group">
                            <label>Género *</label>
                            <select name="gender" required>
                                <option value="">— Seleccione —</option>
                                <option value="Masculino" {{ old('gender', $patient->gender ?? '') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="Femenino" {{ old('gender', $patient->gender ?? '') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                <option value="Otro" {{ old('gender', $patient->gender ?? '') == 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Cédula / DNI</label>
                            <input type="text" name="id_number"
                                   value="{{ old('id_number', $patient->id_number ?? '') }}"
                                   placeholder="Ej: 1700000000">
                        </div>
                        <div class="form-group">
                            <label>Estado</label>
                            <select name="status">
                                <option value="Activo" {{ old('status', $patient->status ?? 'Activo') == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Pendiente" {{ old('status', $patient->status ?? '') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="Inactivo" {{ old('status', $patient->status ?? '') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- SECTION: Contacto -->
                <div style="margin-bottom:2rem">
                    <p style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:var(--text-lt);margin-bottom:1rem;padding-bottom:0.5rem;border-bottom:1px solid var(--gray-2)">
                        📞 Contacto
                    </p>
                    <div class="patient-form-grid">
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="tel" name="phone"
                                   value="{{ old('phone', $patient->phone ?? '') }}"
                                   placeholder="+593 99 000 0000">
                        </div>
                        <div class="form-group">
                            <label>Correo electrónico</label>
                            <input type="email" name="email"
                                   value="{{ old('email', $patient->email ?? '') }}"
                                   placeholder="paciente@email.com">
                        </div>
                        <div class="form-group full">
                            <label>Dirección</label>
                            <input type="text" name="address"
                                   value="{{ old('address', $patient->address ?? '') }}"
                                   placeholder="Calle, número, ciudad">
                        </div>
                    </div>
                </div>

                <!-- SECTION: Médico -->
                <div style="margin-bottom:2rem">
                    <p style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:var(--text-lt);margin-bottom:1rem;padding-bottom:0.5rem;border-bottom:1px solid var(--gray-2)">
                        🏥 Información Médica
                    </p>
                    <div class="patient-form-grid">
                        <div class="form-group">
                            <label>Tipo de sangre</label>
                            <select name="blood_type">
                                <option value="">— Desconocido —</option>
                                @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bt)
                                <option value="{{ $bt }}" {{ old('blood_type', $patient->blood_type ?? '') == $bt ? 'selected' : '' }}>{{ $bt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Seguro médico</label>
                            <input type="text" name="insurance"
                                   value="{{ old('insurance', $patient->insurance ?? '') }}"
                                   placeholder="Ej: IESS, privado...">
                        </div>
                        <div class="form-group full">
                            <label>Alergias conocidas</label>
                            <input type="text" name="allergies"
                                   value="{{ old('allergies', $patient->allergies ?? '') }}"
                                   placeholder="Ej: Penicilina, mariscos... (separadas por coma)">
                        </div>
                        <div class="form-group full">
                            <label>Enfermedades crónicas / Antecedentes</label>
                            <textarea name="chronic_conditions" rows="3"
                                      placeholder="Ej: Diabetes tipo 2, hipertensión arterial...">{{ old('chronic_conditions', $patient->chronic_conditions ?? '') }}</textarea>
                        </div>
                        <div class="form-group full">
                            <label>Medicación actual</label>
                            <textarea name="current_medications" rows="2"
                                      placeholder="Ej: Metformina 500mg, Losartán 50mg...">{{ old('current_medications', $patient->current_medications ?? '') }}</textarea>
                        </div>
                        <div class="form-group full">
                            <label>Observaciones generales</label>
                            <textarea name="notes" rows="3"
                                      placeholder="Notas adicionales sobre el paciente...">{{ old('notes', $patient->notes ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- SECTION: Contacto de emergencia -->
                <div style="margin-bottom:2rem">
                    <p style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:var(--text-lt);margin-bottom:1rem;padding-bottom:0.5rem;border-bottom:1px solid var(--gray-2)">
                        🚨 Contacto de Emergencia
                    </p>
                    <div class="patient-form-grid">
                        <div class="form-group">
                            <label>Nombre del contacto</label>
                            <input type="text" name="emergency_contact_name"
                                   value="{{ old('emergency_contact_name', $patient->emergency_contact_name ?? '') }}"
                                   placeholder="Nombre completo">
                        </div>
                        <div class="form-group">
                            <label>Relación</label>
                            <input type="text" name="emergency_contact_relation"
                                   value="{{ old('emergency_contact_relation', $patient->emergency_contact_relation ?? '') }}"
                                   placeholder="Ej: Esposo/a, hijo/a...">
                        </div>
                        <div class="form-group">
                            <label>Teléfono de emergencia</label>
                            <input type="tel" name="emergency_contact_phone"
                                   value="{{ old('emergency_contact_phone', $patient->emergency_contact_phone ?? '') }}"
                                   placeholder="+593 99 000 0000">
                        </div>
                    </div>
                </div>

                <!-- ACTIONS -->
                <div style="display:flex;gap:1rem;justify-content:flex-end;padding-top:1.5rem;border-top:1px solid var(--gray-2)">
                    <a href="{{ route('patients.index') }}" class="btn-secondary">Cancelar</a>
                    <button type="submit" class="btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v14a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        {{ isset($patient) ? 'Actualizar Paciente' : 'Guardar Paciente' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection