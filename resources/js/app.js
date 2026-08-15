document.addEventListener('DOMContentLoaded', () => {

    /* ═══════════════════════════════════════════════════
       MENÚ MÓVIL
       ═══════════════════════════════════════════════════ */
    const navToggle = document.getElementById('navToggle');
    const navMobile = document.getElementById('navMobile');

    if (navToggle && navMobile) {
        navToggle.addEventListener('click', () => {
            navToggle.classList.toggle('active');
            navMobile.classList.toggle('active');
            document.body.style.overflow = navMobile.classList.contains('active') ? 'hidden' : '';
        });

        navMobile.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                navToggle.classList.remove('active');
                navMobile.classList.remove('active');
                document.body.style.overflow = '';
            });
        });
    }

    /* ═══════════════════════════════════════════════════
       NAVBAR SCROLL EFFECT
       ═══════════════════════════════════════════════════ */
    const navbar = document.getElementById('navbar');

    if (navbar) {
        let ticking = false;

        const handleScroll = () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    navbar.classList.toggle('scrolled', window.scrollY > 50);
                    ticking = false;
                });
                ticking = true;
            }
        };

        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll();
    }

    /* ═══════════════════════════════════════════════════
       ANIMACIONES SCROLL (AOS-like)
       ═══════════════════════════════════════════════════ */
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (!prefersReducedMotion) {
        const aosElements = document.querySelectorAll('[data-aos]');

        if (aosElements.length > 0) {
            const aosObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const delay = entry.target.getAttribute('data-delay') || 0;
                        setTimeout(() => {
                            entry.target.classList.add('aos-animate');
                        }, parseInt(delay));
                        aosObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.15, rootMargin: '0px 0px -50px 0px' });

            aosElements.forEach(el => aosObserver.observe(el));
        }
    } else {
        document.querySelectorAll('[data-aos]').forEach(el => {
            el.classList.add('aos-animate');
        });
    }

    /* ═══════════════════════════════════════════════════
       CONTADORES ANIMADOS
       ═══════════════════════════════════════════════════ */
    const counters = document.querySelectorAll('.counter, .stat-num[data-target]');

    if (counters.length > 0 && !prefersReducedMotion) {
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const target = parseInt(el.getAttribute('data-target'));

                    if (isNaN(target)) {
                        counterObserver.unobserve(el);
                        return;
                    }

                    const duration = 2000;
                    const increment = target / (duration / 16);
                    let current = 0;

                    const updateCounter = () => {
                        current += increment;
                        if (current < target) {
                            el.textContent = Math.floor(current);
                            requestAnimationFrame(updateCounter);
                        } else {
                            el.textContent = target;
                        }
                    };

                    updateCounter();
                    counterObserver.unobserve(el);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(el => counterObserver.observe(el));
    }

    /* ═══════════════════════════════════════════════════
       SLIDER DE TESTIMONIOS
       ═══════════════════════════════════════════════════ */
    const track = document.getElementById('track');
    const prevBtn = document.getElementById('prev');
    const nextBtn = document.getElementById('next');
    const dotsContainer = document.getElementById('dots');

    if (track && prevBtn && nextBtn && dotsContainer) {
        const cards = track.querySelectorAll('.testimonial-card');
        const dots = dotsContainer.querySelectorAll('.dot');
        let currentSlide = 0;
        let autoplayInterval;

        const updateSlider = () => {
            track.style.transform = `translateX(-${currentSlide * 100}%)`;
            dots.forEach((dot, i) => dot.classList.toggle('active', i === currentSlide));
        };

        const goToSlide = (index) => {
            currentSlide = index;
            updateSlider();
        };

        const nextSlide = () => {
            currentSlide = (currentSlide + 1) % cards.length;
            updateSlider();
        };

        const prevSlide = () => {
            currentSlide = (currentSlide - 1 + cards.length) % cards.length;
            updateSlider();
        };

        const startAutoplay = () => {
            autoplayInterval = setInterval(nextSlide, 5000);
        };

        const stopAutoplay = () => {
            clearInterval(autoplayInterval);
        };

        nextBtn.addEventListener('click', () => {
            nextSlide();
            stopAutoplay();
            startAutoplay();
        });

        prevBtn.addEventListener('click', () => {
            prevSlide();
            stopAutoplay();
            startAutoplay();
        });

        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                goToSlide(i);
                stopAutoplay();
                startAutoplay();
            });
        });

        const slider = document.getElementById('slider');
        if (slider) {
            slider.addEventListener('mouseenter', stopAutoplay);
            slider.addEventListener('mouseleave', startAutoplay);
        }

        startAutoplay();
    }

    /* ═══════════════════════════════════════════════════
       CALENDARIO GRID
       ═══════════════════════════════════════════════════ */
    const calGrid = document.getElementById('calGrid');
    const calMonthYear = document.getElementById('calMonthYear');

    if (calGrid) {
        const events = JSON.parse(calGrid.dataset.events || '[]');
        const month = parseInt(calGrid.dataset.month) || new Date().getMonth() + 1;
        const year = parseInt(calGrid.dataset.year) || new Date().getFullYear();

        const monthNames = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        const dayNames = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];

        if (calMonthYear) {
            calMonthYear.textContent = `${monthNames[month - 1]} ${year}`;
        }

        const firstDay = new Date(year, month - 1, 1).getDay();
        const daysInMonth = new Date(year, month, 0).getDate();
        const startDay = firstDay === 0 ? 6 : firstDay - 1;

        let html = dayNames.map(d => `<div class="cal-header">${d}</div>`).join('');

        for (let i = 0; i < startDay; i++) {
            html += '<div class="cal-day empty"></div>';
        }

        const today = new Date();
        const isCurrentMonth = today.getMonth() + 1 === month && today.getFullYear() === year;

        for (let day = 1; day <= daysInMonth; day++) {
            const dateStr = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const hasEvent = events.includes(dateStr);
            const isToday = isCurrentMonth && today.getDate() === day;

            const classes = ['cal-day'];
            if (hasEvent) classes.push('has-event');
            if (isToday) classes.push('today');

            html += `<div class="${classes.join(' ')}" ${hasEvent ? `data-date="${dateStr}"` : ''}>${day}</div>`;
        }

        calGrid.innerHTML = html;
    }

    /* ═══════════════════════════════════════════════════
       DROPDOWN NOTIFICACIONES
       ═══════════════════════════════════════════════════ */
    const notifBell = document.getElementById('notifBell');
    const notifDropdown = document.getElementById('notifDropdown');

    if (notifBell && notifDropdown) {
        notifBell.addEventListener('click', (e) => {
            e.stopPropagation();
            notifDropdown.style.display = notifDropdown.style.display === 'none' ? 'block' : 'none';
        });

        document.addEventListener('click', (e) => {
            if (!notifDropdown.contains(e.target) && e.target !== notifBell) {
                notifDropdown.style.display = 'none';
            }
        });
    }

    /* ═══════════════════════════════════════════════════
       FLASH MESSAGES AUTO-DISMISS
       ═══════════════════════════════════════════════════ */
    const flashMessages = document.querySelectorAll('#flashMessage');

    flashMessages.forEach(msg => {
        setTimeout(() => {
            msg.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            msg.style.opacity = '0';
            msg.style.transform = 'translateY(-10px)';
            setTimeout(() => msg.remove(), 500);
        }, 5000);
    });

    /* ═══════════════════════════════════════════════════
       BÚSQUEDA DE PACIENTES
       ═══════════════════════════════════════════════════ */
    const patientSearch = document.getElementById('patientSearch');

    if (patientSearch) {
        patientSearch.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('.patient-row');

            rows.forEach(row => {
                const name = row.querySelector('.patient-name-text');
                if (name) {
                    const matches = name.textContent.toLowerCase().includes(query);
                    row.style.display = matches ? '' : 'none';
                }
            });
        });
    }

    /* ═══════════════════════════════════════════════════
       DASHBOARD SIDEBAR TOGGLE (MÓVIL)
       ═══════════════════════════════════════════════════ */
    const dashMenuBtn = document.getElementById('dashMenuBtn');
    const sidebar = document.getElementById('sidebar');

    if (dashMenuBtn && sidebar) {
        dashMenuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('open');
        });

        document.addEventListener('click', (e) => {
            if (sidebar.classList.contains('open') &&
                !sidebar.contains(e.target) &&
                e.target !== dashMenuBtn) {
                sidebar.classList.remove('open');
            }
        });
    }

    /* ═══════════════════════════════════════════════════
       FORMULARIO CONTACTO AJAX
       ═══════════════════════════════════════════════════ */
    const contactForm = document.getElementById('contactForm');

    if (contactForm) {
        contactForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span style="animation:pulse 1s infinite">Enviando...</span>';

            try {
                const formData = new FormData(contactForm);
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content ||
                    contactForm.querySelector('input[name="_token"]')?.value;

                const response = await fetch('/appointments', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                const result = await response.json();

                if (result.success) {
                    const successMsg = document.getElementById('formSuccess');
                    if (successMsg) {
                        successMsg.style.display = 'block';
                        contactForm.reset();
                        setTimeout(() => { successMsg.style.display = 'none'; }, 5000);
                    }
                } else {
                    alert('Error al enviar. Por favor intente de nuevo.');
                }
            } catch {
                alert('Error de conexión. Por favor intente de nuevo.');
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });
    }

});
