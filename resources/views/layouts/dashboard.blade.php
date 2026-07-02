<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Panel Médico</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="dashboard-layout">

    <!-- ===== SIDEBAR ===== -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="sidebar-logo-img">
            </div>
            <span class="brand-text">Med. <strong>Gary</strong></span>
        </div>

        <nav class="sidebar-nav">
            <p class="sidebar-section">Principal</p>
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg class="sl-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                </svg>
                Resumen
            </a>
            <a href="{{ route('patients.index') }}" class="sidebar-link {{ request()->routeIs('patients.*') ? 'active' : '' }}">
                <svg class="sl-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 00-8 0v2M12 11a4 4 0 100-8 4 4 0 000 8z"/>
                    <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                </svg>
                Pacientes
            </a>
            <a href="{{ route('calendar.index') }}" class="sidebar-link {{ request()->routeIs('calendar.*') ? 'active' : '' }}">
                <svg class="sl-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>
                </svg>
                Calendario
            </a>
            <a href="{{ route('appointments.index') }}" class="sidebar-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}">
                <svg class="sl-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
                Citas
                @php
                    $pendingCount = \App\Models\Appointment::where('status', 'pendiente')->count();
                @endphp
                @if($pendingCount > 0)
                <span style="margin-left:auto;background:var(--rose);color:white;font-size:0.65rem;font-weight:700;padding:0.15rem 0.5rem;border-radius:100px">{{ $pendingCount }}</span>
                @endif
            </a>

            <p class="sidebar-section">Gestión</p>
            <a href="{{ route('patients.create') }}" class="sidebar-link">
                <svg class="sl-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                    <circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/>
                    <line x1="23" y1="11" x2="17" y2="11"/>
                </svg>
                Nuevo Paciente
            </a>

            <p class="sidebar-section">Sistema</p>
            <a href="{{ route('home') }}" class="sidebar-link" target="_blank">
                <svg class="sl-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
                Ver Portafolio
            </a>
        </nav>

        <div class="sidebar-footer">
            <div style="display:flex;align-items:center;gap:0.75rem;padding:0.75rem;margin-bottom:0.5rem">
                <div class="topbar-avatar">{{ strtoupper(substr(session('doctor_name'), 0, 1)) }}{{ strtoupper(substr(explode(' ', session('doctor_name'))[1] ?? '', 0, 1)) }}</div>
                <div>
                    <p style="font-size:0.82rem;font-weight:700;color:white">{{ session('doctor_name') }}</p>
                    <p style="font-size:0.72rem;color:rgba(255,255,255,0.45)">Médico General</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/>
                    </svg>
                    Cerrar sesión
                </button>
            </form>
        </div>
    </aside>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="dashboard-main">
        <div class="dash-topbar">
            <div style="display:flex;align-items:center;gap:1rem">
                <button class="dash-menu-btn" id="dashMenuBtn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/>
                    </svg>
                </button>
                <h1>@yield('page-title', 'Dashboard')</h1>
            </div>
            <div class="topbar-right">
                @php
                    $doctor = session('doctor_id') ? \App\Models\Doctor::find(session('doctor_id')) : null;
                    $unreadCount = $doctor ? $doctor->unreadNotifications->count() : 0;
                @endphp
                <div class="notification-bell" id="notifBell" style="position:relative;cursor:pointer" title="Notificaciones">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--text-lt)" stroke-width="2">
                        <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                        <path d="M13.73 21a2 2 0 01-3.46 0"/>
                    </svg>
                    @if($unreadCount > 0)
                    <span class="notif-badge" style="position:absolute;top:-5px;right:-5px;background:var(--rose);color:white;font-size:0.6rem;font-weight:700;padding:0.1rem 0.35rem;border-radius:100px;min-width:16px;text-align:center">{{ $unreadCount }}</span>
                    @endif
                </div>
                <div class="notif-dropdown" id="notifDropdown" style="display:none;position:absolute;top:100%;right:0;width:320px;background:white;border-radius:12px;box-shadow:0 8px 32px rgba(13,45,58,0.15);border:1px solid var(--gray-2);z-index:200;margin-top:0.5rem">
                    <div style="padding:1rem;border-bottom:1px solid var(--gray-2);display:flex;justify-content:space-between;align-items:center">
                        <p style="font-weight:700;font-size:0.88rem;color:var(--deep)">Notificaciones</p>
                        @if($unreadCount > 0)
                        <form action="/notifications/mark-read" method="POST" style="display:inline">
                            @csrf
                            <button type="submit" style="background:none;border:none;color:var(--teal);font-size:0.75rem;font-weight:600;cursor:pointer">Marcar todas leídas</button>
                        </form>
                        @endif
                    </div>
                    <div style="max-height:300px;overflow-y:auto">
                        @if($doctor && $doctor->notifications->count() > 0)
                            @foreach($doctor->notifications->take(10) as $notif)
                            <a href="{{ $notif->data['url'] ?? '#' }}" style="display:flex;gap:0.75rem;padding:0.85rem 1rem;border-bottom:1px solid var(--gray-1);text-decoration:none;{{ $notif->read_at ? 'opacity:0.6' : '' }}">
                                <div style="width:32px;height:32px;border-radius:50%;background:rgba(26,158,140,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="2"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/></svg>
                                </div>
                                <div>
                                    <p style="font-size:0.8rem;font-weight:600;color:var(--deep);line-height:1.3">{{ $notif->data['message'] ?? 'Nueva notificación' }}</p>
                                    <p style="font-size:0.7rem;color:var(--text-lt);margin-top:0.2rem">{{ $notif->created_at->diffForHumans() }}</p>
                                </div>
                            </a>
                            @endforeach
                        @else
                            <p style="text-align:center;padding:2rem;color:var(--text-lt);font-size:0.82rem">Sin notificaciones</p>
                        @endif
                    </div>
                </div>
                <div style="font-size:0.82rem;color:var(--text-lt)">
                    {{ now()->format('l, d M Y') }}
                </div>
                <div class="topbar-avatar">{{ strtoupper(substr(session('doctor_name'), 0, 1)) }}{{ strtoupper(substr(explode(' ', session('doctor_name'))[1] ?? '', 0, 1)) }}</div>
            </div>
        </div>

        @if (session('success'))
        <div id="flashMessage" style="margin:1rem 2rem 0;padding:0.85rem 1.25rem;background:rgba(76,175,125,0.1);border:1px solid rgba(76,175,125,0.3);border-radius:10px;color:var(--sage);font-weight:600;display:flex;align-items:center;gap:0.5rem">
            ✅ {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div id="flashMessage" style="margin:1rem 2rem 0;padding:0.85rem 1.25rem;background:rgba(232,100,122,0.1);border:1px solid rgba(232,100,122,0.3);border-radius:10px;color:var(--rose);font-weight:600">
            ❌ {{ session('error') }}
        </div>
        @endif

        <div class="dash-content">
            @yield('content')
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>