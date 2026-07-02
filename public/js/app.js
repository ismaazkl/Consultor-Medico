/* ============================================
   MEDICAL PORTFOLIO — MAIN JAVASCRIPT
============================================ */

document.addEventListener('DOMContentLoaded', () => {

    // ========== NAVBAR SCROLL ==========
    const navbar = document.getElementById('navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        });
    }

    // ========== MOBILE NAV ==========
    const navToggle = document.getElementById('navToggle');
    const navMobile = document.getElementById('navMobile');
    if (navToggle && navMobile) {
        navToggle.addEventListener('click', () => {
            navMobile.classList.toggle('open');
        });
        // Close on link click
        navMobile.querySelectorAll('a').forEach(a => {
            a.addEventListener('click', () => navMobile.classList.remove('open'));
        });
    }

    // ========== SMOOTH SCROLL (for anchor links) ==========
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            const target = document.querySelector(anchor.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // ========== AOS (Animate On Scroll) ==========
    const aosElements = document.querySelectorAll('[data-aos]');
    if (aosElements.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('aos-animate');
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
        aosElements.forEach(el => observer.observe(el));
    }

    // ========== COUNTERS ==========
    function animateCounter(el) {
        const target = parseInt(el.dataset.target);
        const duration = 2000;
        const start = performance.now();
        const update = (time) => {
            const elapsed = time - start;
            const progress = Math.min(elapsed / duration, 1);
            // Ease out cubic
            const eased = 1 - Math.pow(1 - progress, 3);
            el.textContent = Math.round(eased * target).toLocaleString();
            if (progress < 1) requestAnimationFrame(update);
        };
        requestAnimationFrame(update);
    }

    const counterEls = document.querySelectorAll('.stat-num[data-target], .counter[data-target]');
    if (counterEls.length) {
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.dataset.animated) {
                    entry.target.dataset.animated = 'true';
                    animateCounter(entry.target);
                }
            });
        }, { threshold: 0.5 });
        counterEls.forEach(el => counterObserver.observe(el));
    }

    // ========== TESTIMONIALS SLIDER ==========
    const track = document.getElementById('track');
    const prevBtn = document.getElementById('prev');
    const nextBtn = document.getElementById('next');
    const dots = document.querySelectorAll('.dot');
    
    if (track && prevBtn && nextBtn) {
        let current = 0;
        const cards = track.querySelectorAll('.testimonial-card');
        const total = cards.length;
        const isMobile = () => window.innerWidth <= 768;

        const updateSlider = () => {
            const offset = isMobile() ? current * 100 : current * (100 / total);
            track.style.transform = `translateX(-${offset}%)`;
            dots.forEach((d, i) => d.classList.toggle('active', i === current));
        };

        prevBtn.addEventListener('click', () => {
            current = (current - 1 + total) % total;
            updateSlider();
        });
        nextBtn.addEventListener('click', () => {
            current = (current + 1) % total;
            updateSlider();
        });
        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => { current = i; updateSlider(); });
        });

        // Auto-play
        let autoplay = setInterval(() => {
            current = (current + 1) % total;
            updateSlider();
        }, 4500);
        track.addEventListener('mouseenter', () => clearInterval(autoplay));
        track.addEventListener('mouseleave', () => {
            autoplay = setInterval(() => {
                current = (current + 1) % total;
                updateSlider();
            }, 4500);
        });
    }

    // ========== CONTACT FORM ==========
    const contactForm = document.getElementById('contactForm');
    const formSuccess = document.getElementById('formSuccess');
    if (contactForm) {
        contactForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = contactForm.querySelector('button[type="submit"]');
            const originalHTML = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '⏳ Enviando...';

            try {
                const formData = new FormData(contactForm);
                const response = await fetch('/appointments', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': formData.get('_token'),
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    contactForm.reset();
                    if (formSuccess) {
                        formSuccess.style.display = 'block';
                        setTimeout(() => formSuccess.style.display = 'none', 5000);
                    }
                } else {
                    alert(result.message || 'Error al enviar. Intente de nuevo.');
                }
            } catch (err) {
                alert('Error de conexión. Intente de nuevo.');
            } finally {
                btn.disabled = false;
                btn.innerHTML = originalHTML;
            }
        });
    }

    // ========== DASHBOARD SIDEBAR MOBILE ==========
    const dashMenuBtn = document.getElementById('dashMenuBtn');
    const sidebar = document.getElementById('sidebar');
    if (dashMenuBtn && sidebar) {
        dashMenuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('open');
        });
        // Overlay click
        document.addEventListener('click', (e) => {
            if (sidebar.classList.contains('open') && 
                !sidebar.contains(e.target) && 
                e.target !== dashMenuBtn) {
                sidebar.classList.remove('open');
            }
        });
    }

    // ========== CALENDAR ==========
    initCalendar();

    // ========== PATIENT TABS ==========
    const tabBtns = document.querySelectorAll('[data-tab]');
    const tabPanels = document.querySelectorAll('[data-panel]');
    if (tabBtns.length) {
        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const target = btn.dataset.tab;
                tabBtns.forEach(b => b.classList.remove('active'));
                tabPanels.forEach(p => p.style.display = 'none');
                btn.classList.add('active');
                const panel = document.querySelector(`[data-panel="${target}"]`);
                if (panel) panel.style.display = 'block';
            });
        });
    }

    // ========== PATIENT SEARCH ==========
    const searchInput = document.getElementById('patientSearch');
    if (searchInput) {
        searchInput.addEventListener('input', () => {
            const query = searchInput.value.toLowerCase();
            document.querySelectorAll('.patient-row').forEach(row => {
                const name = row.querySelector('.patient-name-text')?.textContent.toLowerCase() || '';
                row.style.display = name.includes(query) ? '' : 'none';
            });
        });
    }

    // ========== FLASH MESSAGES ==========
    const flash = document.getElementById('flashMessage');
    if (flash) {
        setTimeout(() => {
            flash.style.opacity = '0';
            flash.style.transition = 'opacity 0.5s';
            setTimeout(() => flash.remove(), 500);
        }, 4000);
    }

    // ========== NOTIFICATION BELL TOGGLE ==========
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
});

// ========== CALENDAR FUNCTION ==========
function initCalendar() {
    const calGrid = document.getElementById('calGrid');
    const calMonthYear = document.getElementById('calMonthYear');
    const prevMonthBtn = document.getElementById('prevMonth');
    const nextMonthBtn = document.getElementById('nextMonth');
    if (!calGrid) return;

    // Events from data attribute
    let eventDays = [];
    try {
        eventDays = JSON.parse(calGrid.dataset.events || '[]');
    } catch(e) { eventDays = []; }

    let currentDate;
    const serverMonth = parseInt(calGrid.dataset.month, 10);
    const serverYear = parseInt(calGrid.dataset.year, 10);
    if (!isNaN(serverMonth) && !isNaN(serverYear)) {
        currentDate = new Date(serverYear, serverMonth - 1, 1);
    } else {
        currentDate = new Date();
    }

    function renderCalendar(date) {
        const year = date.getFullYear();
        const month = date.getMonth();
        const today = new Date();

        const months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
                        'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        if (calMonthYear) calMonthYear.textContent = `${months[month]} ${year}`;

        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const prevDays = new Date(year, month, 0).getDate();

        calGrid.innerHTML = '';

        // Header row
        ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'].forEach(d => {
            const cell = document.createElement('div');
            cell.className = 'cal-header-cell';
            cell.textContent = d;
            calGrid.appendChild(cell);
        });

        // Prev month days
        for (let i = firstDay - 1; i >= 0; i--) {
            const cell = document.createElement('div');
            cell.className = 'cal-cell other-month';
            cell.textContent = prevDays - i;
            calGrid.appendChild(cell);
        }

        // Current month
        for (let d = 1; d <= daysInMonth; d++) {
            const cell = document.createElement('div');
            cell.className = 'cal-cell';
            
            const isToday = d === today.getDate() && month === today.getMonth() && year === today.getFullYear();
            if (isToday) cell.classList.add('today');

            const dateStr = `${year}-${String(month+1).padStart(2,'0')}-${String(d).padStart(2,'0')}`;
            if (eventDays.includes(dateStr)) cell.classList.add('has-event');

            cell.innerHTML = `<span>${d}</span>`;
            
            if (eventDays.includes(dateStr)) {
                cell.title = 'Tiene consultas este día';
                cell.style.cursor = 'pointer';
                cell.addEventListener('click', () => {
                    window.location.href = `/dashboard/calendar?date=${dateStr}`;
                });
            }
            calGrid.appendChild(cell);
        }

        // Next month fill
        const totalCells = calGrid.children.length - 7; // minus headers
        const remaining = 42 - totalCells;
        for (let d = 1; d <= remaining; d++) {
            const cell = document.createElement('div');
            cell.className = 'cal-cell other-month';
            cell.textContent = d;
            calGrid.appendChild(cell);
        }
    }

    renderCalendar(currentDate);

    if (prevMonthBtn) {
        prevMonthBtn.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar(currentDate);
        });
    }
    if (nextMonthBtn) {
        nextMonthBtn.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar(currentDate);
        });
    }
}