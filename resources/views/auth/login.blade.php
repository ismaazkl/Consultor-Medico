<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Médico </title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="auth-page">
    <div class="hero-bg" style="position:fixed">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="grid-overlay"></div>
    </div>

    <div class="auth-card">
        <div class="auth-logo">
            <div class="brand-icon auth-logo-img-wrap">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="auth-logo-img">
            </div>
            <div>
                <p class="auth-title">Panel Médico</p>
                <p class="auth-subtitle">Dr. Gary Vergara · Acceso privado</p>
            </div>
        </div>

        @if ($errors->any())
        <div class="auth-error" style="margin-bottom:1rem">
            <strong>Error:</strong> {{ $errors->first() }}
        </div>
        @endif

        @if (session('success'))
        <div style="padding:0.85rem 1rem;background:rgba(76,175,125,0.1);border:1px solid rgba(76,175,125,0.3);border-radius:10px;color:var(--sage);font-size:0.85rem;margin-bottom:1rem">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="auth-form">
            @csrf
            <div class="form-group">
                <label>Usuario</label>
                <input type="text" name="username" 
                       placeholder="Ingrese su usuario" 
                       value="{{ old('username') }}"
                       autocomplete="username" required>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <div style="position:relative">
                    <input type="password" name="password" id="passwordInput"
                           placeholder="••••••••"
                           autocomplete="current-password" required
                           style="width:100%;padding-right:3rem">
                    <button type="button" onclick="togglePass()" 
                            style="position:absolute;right:0.75rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--gray-4)">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" id="eyeIcon">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
            </div>
            <button type="submit" class="btn-primary full-width" style="margin-top:0.5rem">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3"/>
                </svg>
                Ingresar al Panel
            </button>
        </form>

        <a href="{{ route('home') }}" class="auth-back">
            ← Volver al portafolio público
        </a>

        <div style="margin-top:1.5rem;padding:1rem;background:var(--gray-1);border-radius:10px;text-align:center">
            <p style="font-size:0.75rem;color:var(--text-lt)">🔒 Acceso restringido solo para personal médico autorizado</p>
        </div>
    </div>
</div>

<script>
function togglePass() {
    const input = document.getElementById('passwordInput');
    const icon = document.getElementById('eyeIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>';
    } else {
        input.type = 'password';
        icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
    }
}
</script>
</body>
</html>