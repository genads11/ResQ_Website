// Smooth scrolling for anchor links
document.addEventListener('DOMContentLoaded', function() {
    // Theme toggle with persistence and accessibility
    const body = document.body;
    const toggle = document.querySelector('.theme-toggle');
    const icon = document.querySelector('.toggle-icon');
    const label = document.querySelector('.toggle-label');
    
    // Debug logs removed for production
    
    let savedTheme = null;
    try { savedTheme = localStorage.getItem('resq-theme'); } catch (e) { /* ignore storage errors */ }

    const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;

    const applyTheme = (isDark) => {
        if (isDark) {
            body.classList.add('dark');
            if (icon) icon.textContent = '☀️';
            if (label) label.textContent = 'Light mode';
            if (toggle) toggle.setAttribute('aria-pressed', 'true');
        } else {
            body.classList.remove('dark');
            if (icon) icon.textContent = '🌙';
            if (label) label.textContent = 'Dark mode';
            if (toggle) toggle.setAttribute('aria-pressed', 'false');
        }
    };

    // Use saved preference or system preference as default
    const initialIsDark = (savedTheme === 'dark') || (savedTheme === null && prefersDark);
    applyTheme(initialIsDark);

    if (toggle) {
        // Ensure the element behaves as a button for accessibility
        if (toggle.tagName === 'BUTTON' && !toggle.hasAttribute('type')) toggle.type = 'button';

        // Make sure ARIA state exists
        if (!toggle.hasAttribute('aria-pressed')) toggle.setAttribute('aria-pressed', body.classList.contains('dark') ? 'true' : 'false');

        toggle.addEventListener('click', () => {
            const isDark = !body.classList.contains('dark');
            applyTheme(isDark);
            try { localStorage.setItem('resq-theme', isDark ? 'dark' : 'light'); } catch (e) { /* ignore */ }
        });

        // Support keyboard activation (Enter / Space)
        toggle.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggle.click();
            }
        });
    } else {
        console.warn('Theme toggle element not found!');
    }

    // Smooth scroll for navigation links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href.length > 1) {
                e.preventDefault();
                const targetId = href.substring(1);
                const targetElement = document.getElementById(targetId);
                
                if (targetElement) {
                    const headerOffset = 80;
                    const elementPosition = targetElement.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });

    // Fade in animation for elements
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Animate elements on scroll
    const animateElements = document.querySelectorAll('.news-card, .coverage-card, .news-item, .featured-article, .section-title');
    animateElements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        observer.observe(el);
    });

    // Smooth page transitions
    const pageLinks = document.querySelectorAll('a[href$=".php"]');
    pageLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href && !href.startsWith('#')) {
                e.preventDefault();
                document.body.style.opacity = '0';
                document.body.style.transition = 'opacity 0.3s ease';
                
                setTimeout(() => {
                    window.location.href = href;
                }, 300);
            }
        });
    });

    // Active navigation highlight based on scroll position
    const updateActiveNav = () => {
        const navLinks = document.querySelectorAll('.nav-link');
        const sections = document.querySelectorAll('article, section');
        
        let currentSection = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (window.pageYOffset >= sectionTop - 100) {
                currentSection = section.getAttribute('id');
            }
        });
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            const href = link.getAttribute('href');
            if (href === `#${currentSection}` || (currentSection === '' && link.getAttribute('href') === '#home')) {
                link.classList.add('active');
            }
        });
    };
    
    // Set initial active link
    updateActiveNav();
    
    // Update active link on scroll
    window.addEventListener('scroll', updateActiveNav);
    
    // Also update when clicking nav links
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Parallax effect for header
    let lastScroll = 0;
    window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset;
        const header = document.querySelector('.main-header');
        
        if (header) {
            if (currentScroll > lastScroll && currentScroll > 100) {
                header.style.transform = 'translateY(-100%)';
                header.style.transition = 'transform 0.3s ease';
            } else {
                header.style.transform = 'translateY(0)';
            }
        }
        lastScroll = currentScroll;
    });

    // Smooth fade in on page load
    window.addEventListener('load', function() {
        document.body.style.opacity = '0';
        document.body.style.transition = 'opacity 0.5s ease';
        
        setTimeout(() => {
            document.body.style.opacity = '1';
        }, 100);
    });

    // Hover effect for cards
    const cards = document.querySelectorAll('.news-card, .coverage-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
            this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Featured article carousel - rotate showcase every 8 seconds
    (function(){
        const featured = document.querySelector('.featured-article');
        if (!featured) return;

        const items = [];
        // original featured as first item
        items.push({
            title: featured.querySelector('.article-title')?.innerText || '',
            excerpt: featured.querySelector('.lead')?.innerText || '',
            image: featured.querySelector('.article-image img')?.src || 'images/relief-distribution.jpg',
            date: featured.querySelector('.article-meta .article-date')?.innerText || '',
            category: featured.querySelector('.article-meta .article-category')?.innerText || ''
        });

        // pull from news cards
        document.querySelectorAll('.news-card').forEach(n => {
            items.push({
                title: n.querySelector('.news-title')?.innerText || '',
                excerpt: n.querySelector('.news-excerpt')?.innerText || '',
                image: n.querySelector('img')?.src || 'images/relief-distribution.jpg',
                date: n.querySelector('.news-meta .news-date')?.innerText || '',
                category: n.querySelector('.news-meta .news-category')?.innerText || ''
            });
        });

        // pull from coverage cards
        document.querySelectorAll('.coverage-card').forEach(c => {
            items.push({
                title: c.querySelector('.coverage-title')?.innerText || '',
                excerpt: c.querySelector('.coverage-excerpt')?.innerText || '',
                image: c.querySelector('.coverage-image img')?.src || 'images/relief-distribution.jpg',
                date: '', category: ''
            });
        });

        let idx = 0;
        let timer = null;

        function show(i){
            const it = items[i];
            if (!it) return;
            const titleEl = featured.querySelector('.article-title');
            const leadEl = featured.querySelector('.lead');
            const imgEl = featured.querySelector('.article-image img');
            const dateEl = featured.querySelector('.article-meta .article-date');
            const catEl = featured.querySelector('.article-meta .article-category');

            if (titleEl) titleEl.textContent = it.title;
            if (leadEl) leadEl.textContent = it.excerpt; else if (featured.querySelector('.article-content')) featured.querySelector('.article-content').innerHTML = `<p class="lead">${it.excerpt}</p>`;
            if (imgEl) imgEl.src = it.image;
            if (dateEl) dateEl.textContent = it.date;
            if (catEl) catEl.textContent = it.category;

            // apply small fade animation
            featured.style.opacity = '0';
            featured.style.transform = 'translateY(10px)';
            setTimeout(()=>{ featured.style.transition = 'all 0.6s ease'; featured.style.opacity = '1'; featured.style.transform = 'translateY(0)'; }, 60);
        }

        function start(){ timer = setInterval(()=>{ idx = (idx+1) % items.length; show(idx); }, 8000); }
        function stop(){ if (timer) { clearInterval(timer); timer = null; } }

        featured.addEventListener('mouseenter', stop);
        featured.addEventListener('mouseleave', start);

        // kick off
        show(0);
        start();
    })();

        // Auth modal handlers: open modal, switch tabs, close
        (function(){
            const modal = document.getElementById('auth-modal');
            if (!modal) return;
            const backdrop = modal.querySelector('.auth-modal-backdrop');
            const closeBtn = modal.querySelector('.auth-modal-close');
            const tabButtons = modal.querySelectorAll('.auth-tab-buttons [data-tab]');
            const loginFormWrap = modal.querySelector('.auth-form-login');
            const registerFormWrap = modal.querySelector('.auth-form-register');
            const loginForm = modal.querySelector('#modal-login-form');
            const registerForm = modal.querySelector('#modal-register-form');
            const loginErrors = modal.querySelector('#login-errors');
            const loginSuccess = modal.querySelector('#login-success');
            const registerErrors = modal.querySelector('#register-errors');
            const registerSuccess = modal.querySelector('#register-success');

            function open(tab){
                modal.setAttribute('aria-hidden','false');
                document.body.classList.add('modal-open');
                modal.style.display = 'block';
                if (tab === 'register') switchTab('register');
                else switchTab('login');
            }
            function close(){
                // Don't close if there are error messages displayed
                if (loginErrors.style.display === 'block' || registerErrors.style.display === 'block') return;

                modal.setAttribute('aria-hidden','true');
                document.body.classList.remove('modal-open');
                modal.style.display = 'none';
                // Clear messages
                loginErrors.style.display = 'none';
                loginSuccess.style.display = 'none';
                registerErrors.style.display = 'none';
                registerSuccess.style.display = 'none';
            }
            function switchTab(tab){
                tabButtons.forEach(b => b.classList.toggle('active', b.dataset.tab===tab));
                if (tab==='login'){
                    loginFormWrap.style.display = '';
                    registerFormWrap.style.display = 'none';
                } else {
                    loginFormWrap.style.display = 'none';
                    registerFormWrap.style.display = '';
                }
            }

            // AJAX form submission
            function submitForm(form, errorsDiv, successDiv, callback){
                const formData = new FormData(form);
                fetch(window.location.href, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        if (data.errors && data.errors.length > 0) {
                            errorsDiv.innerHTML = '<ul>' + data.errors.map(err => '<li>' + err + '</li>').join('') + '</ul>';
                            errorsDiv.style.display = 'block';
                            successDiv.style.display = 'none';
                        } else if (data.success) {
                            successDiv.textContent = data.success;
                            successDiv.style.display = 'block';
                            errorsDiv.style.display = 'none';
                            if (callback) callback();
                        }
                    }
                })
                .catch(error => {
                    errorsDiv.innerHTML = '<ul><li>Network error. Please try again.</li></ul>';
                    errorsDiv.style.display = 'block';
                    successDiv.style.display = 'none';
                });
            }

            // Login form submit
            loginForm.addEventListener('submit', e => {
                e.preventDefault();
                submitForm(loginForm, loginErrors, loginSuccess, () => {
                    // On successful registration, switch to login tab
                    setTimeout(() => {
                        switchTab('login');
                        registerSuccess.style.display = 'none';
                    }, 2000);
                });
            });

            // Register form submit
            registerForm.addEventListener('submit', e => {
                e.preventDefault();
                submitForm(registerForm, registerErrors, registerSuccess, () => {
                    // On successful registration, switch to login tab
                    setTimeout(() => {
                        switchTab('login');
                        registerSuccess.style.display = 'none';
                    }, 2000);
                });
            });

            // Attach header triggers
            document.querySelectorAll('.open-auth').forEach(el => {
                el.addEventListener('click', e => {
                    e.preventDefault();
                    const tab = el.dataset.auth || 'login';
                    open(tab);
                });
            });

            // Tab buttons
            tabButtons.forEach(b => b.addEventListener('click', ()=> switchTab(b.dataset.tab)));
            // Close actions
            backdrop.addEventListener('click', close);
            closeBtn.addEventListener('click', close);
            document.addEventListener('keydown', e => { if (e.key === 'Escape') close(); });
        })();

    // Smooth scroll to top button (optional enhancement)
    const scrollTopBtn = document.createElement('button');
    scrollTopBtn.innerHTML = '↑';
    scrollTopBtn.className = 'scroll-top-btn';
    scrollTopBtn.style.cssText = `
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #3498db;
        color: white;
        border: none;
        font-size: 24px;
        cursor: pointer;
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 1000;
        box-shadow: 0 4px 15px rgba(52, 152, 219, 0.4);
    `;
    
    document.body.appendChild(scrollTopBtn);
    
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            scrollTopBtn.style.opacity = '1';
            scrollTopBtn.style.transform = 'scale(1)';
        } else {
            scrollTopBtn.style.opacity = '0';
            scrollTopBtn.style.transform = 'scale(0.8)';
        }
    });
    
    scrollTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});

