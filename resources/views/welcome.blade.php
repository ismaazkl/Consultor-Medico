<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr. Gary Vergara — Médico General & Familiar</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<!-- ===== NAVBAR ===== -->
<nav class="navbar" id="navbar">
    <div class="nav-container">
        <div class="nav-brand">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Dr. Vergara" class="nav-logo-img">
            <span class="brand-text">Dr. <strong>Vergara</strong></span>
        </div>
        <ul class="nav-links">
            <li><a href="#inicio" class="nav-link">Inicio</a></li>
            <li><a href="#servicios" class="nav-link">Servicios</a></li>
            <li><a href="#sobre-mi" class="nav-link">Sobre Mí</a></li>
            <li><a href="#estadisticas" class="nav-link">Logros</a></li>
            <li><a href="#contacto" class="nav-link">Contacto</a></li>
            <li><a href="{{ route('login') }}" class="nav-btn">Panel Médico</a></li>
        </ul>
        <button class="nav-toggle" id="navToggle">
            <span></span><span></span><span></span>
        </button>
    </div>
    <div class="nav-mobile" id="navMobile">
        <a href="#inicio">Inicio</a>
        <a href="#servicios">Servicios</a>
        <a href="#sobre-mi">Sobre Mí</a>
        <a href="#estadisticas">Logros</a>
        <a href="#contacto">Contacto</a>
        <a href="{{ route('login') }}" class="mobile-btn">Panel Médico</a>
    </div>
</nav>

<!-- ===== HERO ===== -->
<section class="hero" id="inicio">
    <div class="hero-bg">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
        <div class="grid-overlay"></div>
    </div>

    <div class="hero-container">
        <div class="hero-content" data-aos="fade-right">
            <div class="hero-badge">
                <span class="badge-dot"></span>
                Disponible para consultas
            </div>
            <h1 class="hero-title">
                Su salud es<br>
                nuestra <span class="highlight">prioridad</span>
            </h1>
            <p class="hero-subtitle">
                Comprometido en ayudar a los pacientes a mejorar su salud de manera integral mediante tratamientos farmacológicos, no farmacológicos y herramientas de prevención a largo plazo..
            </p>
            <div class="hero-actions">
                <a href="#contacto" class="btn-primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 2v4M16 2v4M3 10h18M5 4h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z"/></svg>
                    Agendar Cita
                </a>
                <a href="#sobre-mi" class="btn-secondary">Conocer más</a>
            </div>
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-num" data-target="1500">0</span><span class="stat-sym">+</span>
                    <span class="stat-label">Pacientes</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <span class="stat-num" data-target="15">0</span><span class="stat-sym">+</span>
                    <span class="stat-label">Años Exp.</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <span class="stat-num" data-target="98">0</span><span class="stat-sym">%</span>
                    <span class="stat-label">Satisfacción</span>
                </div>
            </div>
        </div>

        <div class="hero-visual" data-aos="fade-left">
            <div class="hero-card main-card">
                <div class="card-header">
                    <div class="avatar-ring">
                        <div class="avatar-inner">
                            <img src="{{ asset('images/doctor-perfil.jpg') }}" alt="Dr. Gary Vergara" class="hero-avatar-img">
                        </div>
                    </div>
                    <div>
                        <p class="card-name">Gary Vergara</p>
                        <p class="card-role">Médico General & Familiar</p>
                    </div>
                    <div class="card-status">
                        <span class="status-dot"></span>En línea
                    </div>
                </div>
                <div class="card-divider"></div>
                <div class="vitals-grid">
                    <div class="vital-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                        <div>
                            <p class="vital-val">72 bpm</p>
                            <p class="vital-key">Ritmo cardíaco</p>
                        </div>
                    </div>
                    <div class="vital-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--sage)" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                        <div>
                            <p class="vital-val">8:00–17:00</p>
                            <p class="vital-key">Horario</p>
                        </div>
                    </div>
                    <div class="vital-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--gold)" stroke-width="2"><path d="M17 21v-2a4 4 0 00-8 0v2M12 11a4 4 0 100-8 4 4 0 000 8z"/></svg>
                        <div>
                            <p class="vital-val">+8 hoy</p>
                            <p class="vital-key">Consultas</p>
                        </div>
                    </div>
                    <div class="vital-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--rose)" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        <div>
                            <p class="vital-val">Verified</p>
                            <p class="vital-key">Certificado</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="floating-card card-next">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                <div>
                    <p class="fc-label">Próxima cita</p>
                    <p class="fc-val">Hoy, 15:30</p>
                </div>
            </div>

            <div class="floating-card card-rating">
                <div class="stars">★★★★★</div>
                <p class="fc-label">4.9 · 320 reseñas</p>
            </div>
        </div>
    </div>

    <div class="scroll-hint">
        <span>Explorar</span>
        <div class="scroll-arrow"></div>
    </div>
</section>

<!-- ===== SERVICIOS ===== -->
<section class="services" id="servicios">
    <div class="section-container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag">¿Qué ofrezco?</span>
            <h2 class="section-title">Servicios <span class="highlight">Médicos</span></h2>
            <p class="section-sub">Atención integral para toda la familia con los más altos estándares de calidad</p>
        </div>

        <div class="services-grid">
            <div class="service-card" data-aos="fade-up" data-delay="0">
                <div class="service-icon" style="--ic: var(--teal)">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                </div>
                <h3>Consulta General</h3>
                <p>Evaluación completa de su estado de salud, diagnóstico y plan de tratamiento personalizado.</p>
                <ul class="service-features">
                    <li>✓ Examen físico completo</li>
                    <li>✓ Historial clínico detallado</li>
                    <li>✓ Recetas y referencias</li>
                </ul>
                <div class="service-footer">
                    <span class="service-duration">⏱ 30–45 min</span>
                </div>
            </div>

            <div class="service-card featured" data-aos="fade-up" data-delay="100">
                <div class="featured-badge">Más solicitado</div>
                <div class="service-icon" style="--ic: white">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 00-8 0v2M12 11a4 4 0 100-8 4 4 0 000 8zM23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                </div>
                <h3>Medicina Familiar</h3>
                <p>Atención preventiva y curativa para todos los miembros de su familia en todas las etapas de vida.</p>
                <ul class="service-features">
                    <li>✓ Pediatría básica</li>
                    <li>✓ Geriatría</li>
                    <li>✓ Control prenatal</li>
                </ul>
                <div class="service-footer">
                    <span class="service-duration">⏱ 45–60 min</span>
                </div>
            </div>

            <div class="service-card" data-aos="fade-up" data-delay="200">
                <div class="service-icon" style="--ic: var(--sage)">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 3H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2h-4M9 3a2 2 0 004 0M9 3a2 2 0 014 0M12 12v6M9 15h6"/></svg>
                </div>
                <h3>Chequeo Preventivo</h3>
                <p>Revisiones periódicas para detectar enfermedades a tiempo y mantener su salud óptima.</p>
                <ul class="service-features">
                    <li>✓ Análisis de laboratorio</li>
                    <li>✓ Control de presión</li>
                    <li>✓ Perfil lipídico</li>
                </ul>
                <div class="service-footer">
                    <span class="service-duration">⏱ 60 min</span>
                </div>
            </div>

            <div class="service-card" data-aos="fade-up" data-delay="300">
                <div class="service-icon" style="--ic: var(--gold)">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h3>Manejo de Enfermedades Crónicas</h3>
                <p>Seguimiento y control de diabetes, hipertensión, y otras condiciones de larga duración.</p>
                <ul class="service-features">
                    <li>✓ Plan de tratamiento</li>
                    <li>✓ Monitoreo continuo</li>
                    <li>✓ Ajuste de medicación</li>
                </ul>
                <div class="service-footer">
                    <span class="service-duration">⏱ 30 min</span>
                </div>
            </div>

            <div class="service-card" data-aos="fade-up" data-delay="400">
                <div class="service-icon" style="--ic: var(--rose)">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                </div>
                <h3>Urgencias Menores</h3>
                <p>Atención rápida para fiebre, infecciones, heridas leves y otras urgencias del día a día.</p>
                <ul class="service-features">
                    <li>✓ Atención prioritaria</li>
                    <li>✓ Sin cita previa</li>
                    <li>✓ Seguimiento posterior</li>
                </ul>
                <div class="service-footer">
                    <span class="service-duration">⏱ 20–30 min</span>
                </div>
            </div>

            <div class="service-card" data-aos="fade-up" data-delay="500">
                <div class="service-icon" style="--ic: var(--teal)">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
                </div>
                <h3>Teleconsulta</h3>
                <p>Consultas médicas en línea desde la comodidad de su hogar, con la misma calidad presencial.</p>
                <ul class="service-features">
                    <li>✓ Video consulta HD</li>
                    <li>✓ Receta digital</li>
                    <li>✓ Seguimiento virtual</li>
                </ul>
                <div class="service-footer">
                    <span class="service-duration">⏱ 20–30 min</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== SOBRE MÍ ===== -->
<section class="about" id="sobre-mi">
    <div class="section-container">
        <div class="about-grid">
            <div class="about-visual" data-aos="fade-right">
                <div class="about-card-wrap">
                    <div class="about-img-placeholder" style="border:none;background:none;overflow:hidden">
                        <img src="{{ asset('images/doctor-perfil.jpg') }}" alt="Dr. Gary Vergara" loading="lazy" style="width:100%;height:100%;object-fit:cover;border-radius:var(--radius-lg);display:block">
                    </div>
                    <div class="cert-badge">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        <div>
                            <p style="font-size:0.75rem;font-weight:600;color:var(--deep)">Certificado</p>
                            <p style="font-size:0.7rem;color:#666">Universidad de Guayaquil</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="about-content" data-aos="fade-left">
                <span class="section-tag">Sobre Mí</span>
                <h2 class="section-title">Un médico que <span class="highlight">le escucha</span></h2>
                <p class="about-text">
                    Soy tu medico de confianza, Gary Vergara , médico general y familiar graduado de la Universidad Central con especialización en medicina preventiva. Durante más de 4 años he dedicado mi práctica a brindar atención integral y humana a pacientes de todas las edades.
                </p>
                <p class="about-text">
                    Creo firmemente que la relación médico-paciente debe basarse en la confianza, la comunicación y el respeto. Mi objetivo no es solo tratar enfermedades, sino acompañarle en su camino hacia una vida más saludable.
                </p>

                <div class="credentials-grid">
                    <div class="credential">
                        <div class="cred-icon">🎓</div>
                        <div>
                            <p class="cred-title">Médico General</p>
                            <p class="cred-sub">Universidad de Guayaquil — 2022</p>
                        </div>
                    </div>
                    <div class="credential">
                        <div class="cred-icon">📋</div>
                        <div>
                            <p class="cred-title">Medicina Familiar</p>
                            <p class="cred-sub">Especialización — 2022</p>
                        </div>
                    </div>
                    <div class="credential">
                        <div class="cred-icon">🏆</div>
                        <div>
                            <p class="cred-title">Premio Excelencia</p>
                            <p class="cred-sub">Colegio Médico — 2019</p>
                        </div>
                    </div>
                    <div class="credential">
                        <div class="cred-icon">🌍</div>
                        <div>
                            <p class="cred-title">Miembro Internacional</p>
                            <p class="cred-sub">WONCA — desde 2015</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== ESTADÍSTICAS ===== -->
<section class="stats-section" id="estadisticas">
    <div class="stats-bg">
        <div class="blob blob-4"></div>
    </div>
    <div class="section-container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag">Mis logros</span>
            <h2 class="section-title">Números que <span class="highlight">importan</span></h2>
        </div>
        <div class="big-stats" data-aos="fade-up">
            <div class="big-stat">
                <span class="big-num counter" data-target="1500">0</span><span class="big-sym">+</span>
                <p>Pacientes atendidos</p>
            </div>
            <div class="big-stat">
                <span class="big-num counter" data-target="15">0</span><span class="big-sym">+</span>
                <p>Años de experiencia</p>
            </div>
            <div class="big-stat">
                <span class="big-num counter" data-target="320">0</span><span class="big-sym">+</span>
                <p>Consultas al mes</p>
            </div>
            <div class="big-stat">
                <span class="big-num counter" data-target="98">0</span><span class="big-sym">%</span>
                <p>Pacientes satisfechos</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== TESTIMONIOS ===== -->
<section class="testimonials">
    <div class="section-container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag">Testimonios</span>
            <h2 class="section-title">Lo que dicen mis <span class="highlight">pacientes</span></h2>
        </div>
        <div class="testimonials-slider" id="slider">
            <div class="testimonials-track" id="track">
                <div class="testimonial-card">
                    <div class="t-stars">★★★★★</div>
                    <p class="t-text">"El Med.Gary es un médico excepcional. Me tomó el tiempo necesario para explicarme mi diagnóstico con paciencia y claridad. Me siento en muy buenas manos."</p>
                    <div class="t-author">
                        <div class="t-avatar" style="background:var(--teal)">AM</div>
                        <div><p class="t-name">Ana María P.</p><p class="t-role">Paciente desde 2025</p></div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="t-stars">★★★★★</div>
                    <p class="t-text">"Llevo toda mi familia con el Med. Vergara, desde mis hijos hasta mi madre. Siempre nos atiende con mucho profesionalismo y calidez humana."</p>
                    <div class="t-author">
                        <div class="t-avatar" style="background:var(--sage)">JR</div>
                        <div><p class="t-name">Juan Roberto V.</p><p class="t-role">Paciente desde 2026</p></div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="t-stars">★★★★★</div>
                    <p class="t-text">"Gracias al seguimiento del medico Gary Vergara, pudimos detectar a tiempo mi diabetes. Su dedicación y conocimiento marcaron la diferencia en mi vida."</p>
                    <div class="t-author">
                        <div class="t-avatar" style="background:var(--gold)">LC</div>
                        <div><p class="t-name">Laura C.</p><p class="t-role">Paciente desde 2023</p></div>
                    </div>
                </div>
            </div>
            <div class="slider-controls">
                <button class="slider-btn" id="prev">‹</button>
                <div class="slider-dots" id="dots">
                    <span class="dot active"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
                <button class="slider-btn" id="next">›</button>
            </div>
        </div>
    </div>
</section>

<!-- ===== CONTACTO ===== -->
<section class="contact" id="contacto">
    <div class="section-container">
        <div class="contact-grid">
            <div class="contact-info" data-aos="fade-right">
                <span class="section-tag">Contácteme</span>
                <h2 class="section-title">Agende su <span class="highlight">consulta</span></h2>
                <p class="about-text">Complete el formulario y me pondré en contacto con usted a la brevedad para confirmar su cita.</p>

                <div class="info-cards">
                    <div class="info-card">
                        <div class="info-icon">📍</div>
                        <div>
                            <p class="info-title">Consultorio</p>
                            
                            <li> 
                                <a href="https://maps.app.goo.gl/tWmcCdQu3FrNtDwn7"  target="_blue" 
                                rel="noopener noreferrer" 
                                class="text-blue-600 underline font-semibold hover:text-blue-800 transition-colors">  Ver Ubicacion (Google Maps)</a>   

                            </li>
                            
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-icon">📞</div>
                        <div>
                            <p class="info-title">Teléfono</p>
                            <p class="info-val"><a href="https://wa.me/593981428288">Contactame directamente en WhatsApp</a>  </p>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-icon">🕐</div>
                        <div>
                            <p class="info-title">Horario</p>
                            <p class="info-val">Lun–Vie: 8:00–17:00 · </p>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-icon">✉️</div>
                        <div>
                            <p class="info-title">Email</p>
                            <p class="info-val">consultoriomedicovergara@hotmail.com</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-form-wrap" data-aos="fade-left">
                <form class="contact-form" id="contactForm">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nombre completo</label>
                            <input type="text" name="nombre" placeholder="Ej: María García" required>
                        </div>
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="tel" name="telefono" placeholder="+593 99 000 0000">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Correo electrónico</label>
                        <input type="email" name="email" placeholder="su@email.com" required>
                    </div>
                    <div class="form-group">
                        <label>Fecha deseada para la cita</label>
                        <input type="date" name="fecha_deseada" min="{{ now()->format('Y-m-d') }}">
                    </div>
                    <div class="form-group">
                        <label>Tipo de consulta</label>
                        <select name="tipo">
                            <option value="">— Seleccione —</option>
                            <option>Consulta General</option>
                            <option>Medicina Familiar</option>
                            <option>Chequeo Preventivo</option>
                            <option>Urgencia Menor</option>
                            <option>Teleconsulta</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mensaje (opcional)</label>
                        <textarea name="mensaje" rows="4" placeholder="Cuénteme brevemente el motivo de su consulta..."></textarea>
                    </div>
                    <button type="submit" class="btn-primary full-width">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13M22 2L15 22l-4-9-9-4 20-7z"/></svg>
                        Enviar solicitud de cita
                    </button>
                    <div class="form-success" id="formSuccess">
                        ✅ ¡Solicitud enviada! Me pondré en contacto pronto.
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- ===== FOOTER ===== -->
<footer class="footer">
    <div class="footer-container">
        <div class="footer-brand">
            <div class="nav-brand">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="footer-logo-img">
                <span class="brand-text" style="color:white">Med. <strong>Gary Vergara </strong></span>
            </div>
            <p class="footer-tagline">Salud con compromiso y corazón</p>
        </div>
        <div class="footer-links">
            <a href="#inicio">Inicio</a>
            <a href="#servicios">Servicios</a>
            <a href="#sobre-mi">Sobre Mí</a>
            <a href="#contacto">Contacto</a>
            <a href="{{ route('login') }}">Panel Médico</a>
        </div>
        <p class="footer-copy">© 2025 Gary Vergara · Todos los derechos reservados</p>
    </div>
</footer>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>