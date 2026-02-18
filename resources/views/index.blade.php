<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RGRR WebMaker - Professional Web Development & Digital Solutions</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Laravel CSS -->
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    
    <style>
        /* Enhanced Logo Styles */
        .logo-img {
            height: 60px; /* Made bigger */
            width: auto;
            transition: transform 0.3s ease;
        }
        
        .logo-img-2 {
            height: 200px; /* Made bigger */
            width: 200px;
            object-fit: contain;
            animation: float 3s ease-in-out infinite;
        }
        
        .logo-rgrr {
            font-size: 28px; /* Increased size */
        }
        
        .logo-webmaker {
            font-size: 18px; /* Increased size */
        }
        
        /* Bootstrap overrides for your design */
        .btn-cta {
            padding: 10px 24px;
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));
            border: none;
            color: white;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px var(--glow-blue);
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px var(--glow-purple);
            color: white;
        }
        
        /* Service card improvements */
        .service-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            color: inherit;
        }
        
        /* Hero section enhancements */
        .hero-buttons .btn {
            padding: 12px 32px;
            font-weight: 600;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .logo-img {
                height: 50px;
            }
            
            .logo-img-2 {
                height: 150px;
                width: 150px;
            }
            
            .navbar-brand .logo-text {
                display: none;
            }
        }
    </style>
</head>
<body>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <div class="logo-container">
                    <img src="{{ asset('assets/logo_main.png') }}" alt="RGRR WebMaker Logo" class="logo-img me-2" onerror="this.style.display='none'">
                    <div class="logo-text">
                        <span class="logo-rgrr">RGRR</span>
                        <span class="logo-webmaker">WebMaker</span>
                    </div>
                </div>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="#forum">Forum</a>
                    </li>
                </ul>
                
                <div class="d-lg-flex ms-lg-3">
                    <a href="/login" class="btn btn-hero">
    Join Now <i class="fas fa-arrow-right ms-2"></i>
</a>

                </div>

            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero pt-5">
        <div class="hero-bg">
            <div class="wave wave-1"></div>
            <div class="wave wave-2"></div>
            <div class="wave wave-3"></div>
            <div class="stars"></div>
        </div>
        
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-text">
                        <div class="badge">
                            <span><i class="fas fa-hat-wizard me-2"></i>Your Digital Wizard</span>
                        </div>
                        <h1 class="hero-title mb-4">
                            Transforming Ideas Into<br>
                            <span class="gradient-text">Digital Magic</span>
                        </h1>
                        <p class="hero-subtitle mb-4">
                            Professional web development, game creation, database management, and digital solutions crafted with expertise and innovation.
                        </p>
                        <div class="hero-buttons d-flex flex-wrap gap-3">
                            <a href="/login" class="btn btn-hero">
                                Join Now <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                            <a href="#services" class="btn btn-secondary">
                                View Services
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="hero-visual">
                        <div class="magic-circles">
                            <div class="magic-circle circle-1"></div>
                            <div class="magic-circle circle-2"></div>
                            <div class="magic-circle circle-3"></div>
                        </div>
                        <div class="wizard-icon">
                            <img src="{{ asset('assets/logo_main.png') }}" alt="RGRR WebMaker Logo" class="logo-img-2" onerror="this.style.display='none'">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services py-5" id="services">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="section-title mb-3">Our Magical Services</h2>
                <p class="section-subtitle">Comprehensive digital solutions tailored to bring your vision to life</p>
            </div>
            
            <div class="row g-4">
                <!-- Webinar Services -->
                <div class="col-md-6 col-lg-3">
                    <div class="service-card card-blue h-100">
                        <div class="service-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h3>Webinar Services</h3>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-play-circle me-2"></i> Video Tutorials</li>
                            <li><i class="fas fa-paint-brush me-2"></i> Graphic Design</li>
                            <li><i class="fas fa-code me-2"></i> Visual Code Training</li>
                            <li><i class="fas fa-palette me-2"></i> Canva / Figma Workshops</li>
                        </ul>
                    </div>
                </div>

                <!-- Database Services -->
                <div class="col-md-6 col-lg-3">
                    <div class="service-card card-purple h-100">
                        <div class="service-icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <h3>Database Solutions</h3>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-file-signature me-2"></i> Registration Forms</li>
                            <li><i class="fas fa-mail-bulk me-2"></i> Mailing Systems</li>
                            <li><i class="fas fa-table me-2"></i> Data Management</li>
                            <li><i class="fas fa-server me-2"></i> Custom Databases</li>
                        </ul>
                    </div>
                </div>

                <!-- Game Development -->
                <div class="col-md-6 col-lg-3">
                    <div class="service-card card-red h-100">
                        <div class="service-icon">
                            <i class="fas fa-gamepad"></i>
                        </div>
                        <h3>Game Development</h3>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-gamepad me-2"></i> 2D Game Design</li>
                            <li><i class="fas fa-cube me-2"></i> 3D Game Creation</li>
                            <li><i class="fas fa-graduation-cap me-2"></i> DRR Educational Games</li>
                            <li><i class="fas fa-mobile-alt me-2"></i> Mobile Development</li>
                        </ul>
                    </div>
                </div>

                <!-- Forum & Community -->
                <div class="col-md-6 col-lg-3">
                    <div class="service-card card-cyan h-100">
                        <div class="service-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h3>Forum Solutions</h3>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-comments me-2"></i> Web-Based Forums</li>
                            <li><i class="fas fa-tools me-2"></i> Technical Support</li>
                            <li><i class="fas fa-wrench me-2"></i> Troubleshooting</li>
                            <li><i class="fas fa-users me-2"></i> Community Building</li>
                        </ul>
                    </div>
                </div>

                <!-- WordPress Development -->
                <div class="col-md-6 col-lg-3">
                    <div class="service-card card-indigo h-100">
                        <div class="service-icon">
                            <i class="fab fa-wordpress"></i>
                        </div>
                        <h3>WordPress Development</h3>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-laptop-code me-2"></i> Website Creation</li>
                            <li><i class="fas fa-briefcase me-2"></i> Portfolio Sites</li>
                            <li><i class="fas fa-shopping-cart me-2"></i> E-Commerce</li>
                            <li><i class="fas fa-cogs me-2"></i> Custom Solutions</li>
                        </ul>
                    </div>
                </div>

                <!-- Medical Records System -->
                <div class="col-md-6 col-lg-3">
                    <div class="service-card card-green h-100">
                        <div class="service-icon">
                            <i class="fas fa-hospital"></i>
                        </div>
                        <h3>Medical Records System</h3>
                        <ul class="list-unstyled">
                            <li><i class="fab fa-java me-2"></i> Java Development</li>
                            <li><i class="fas fa-database me-2"></i> SQLite Management</li>
                            <li><i class="fas fa-desktop me-2"></i> JFrame Interface</li>
                            <li><i class="fas fa-shield-alt me-2"></i> Secure Systems</li>
                        </ul>
                    </div>
                </div>

                <!-- ROTC Management System -->
                <div class="col-md-6 col-lg-3">
                    <div class="service-card card-yellow h-100">
                        <div class="service-icon">
                            <i class="fas fa-medal"></i>
                        </div>
                        <h3>Data Management</h3>
                        <ul class="list-unstyled">
                            <li><i class="fab fa-html5 me-2"></i> HTML/CSS/JavaScript</li>
                            <li><i class="fab fa-php me-2"></i> PHP Backend</li>
                            <li><i class="fas fa-database me-2"></i> MySQL Database</li>
                            <li><i class="fas fa-globe me-2"></i> Web-Based Platform</li>
                        </ul>
                    </div>
                </div>

                <!-- Additional Services -->
                <div class="col-md-6 col-lg-3">
                    <div class="service-card card-pink h-100">
                        <div class="service-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h3>Additional Services</h3>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-laptop-code me-2"></i> Custom Web Apps</li>
                            <li><i class="fas fa-plug me-2"></i> API Integration</li>
                            <li><i class="fas fa-search me-2"></i> SEO Optimization</li>
                            <li><i class="fas fa-plus-circle me-2"></i> And Much More!</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
   <section class="about py-5" id="about">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-8">
                <div class="about-text">
                    <h2 class="mb-4">Your Digital Solutions Partner</h2>
                    <p class="mb-4">
                        RGRR WebMaker is your trusted wizard in the digital realm, transforming complex ideas into elegant, functional solutions. With expertise spanning web development, game creation, database management, and beyond, we bring magic to every project.
                    </p>
                    <p class="mb-5">
                        Whether you're looking to build a stunning website, develop an engaging game, or implement a robust data management system, our team combines technical excellence with creative innovation to exceed your expectations.
                    </p>
                    <div class="row stats">
                        <div class="col-md-6 mb-4">
                            <div class="stat">
                                <div class="stat-number">100+</div>
                                <div class="stat-label">Projects Completed</div>
                            </div>
                            
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="stat">
                                <div class="stat-number">50+</div>
                                <div class="stat-label">Happy Clients</div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-4">  
                <div class="about-visual text-center">
                    <div class="target-icon">
                        <i class="fas fa-bullseye" style="font-size: 8rem;"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- New 4-Column Section -->
        <div class="row mt-5 pt-5">
            <div class="col-12 mb-4">
                <h3 class="text-center mb-3">Why Choose RGRR WebMaker?</h3>
                <p class="text-center text-light opacity-75 mb-5">Discover what makes us different in the digital solutions space</p>
            </div>
            
            <!-- Column 1 -->
            <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                <div class="feature-card text-center p-4 h-100">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-magic fa-3x" style="color: #3b82f6;"></i>
                    </div>
                    <h4 class="mb-3">Innovative Approach</h4>
                    <p class="text-light opacity-75">We combine cutting-edge technology with creative thinking to deliver solutions that stand out from the crowd.</p>
                </div>
            </div>
            
            <!-- Column 2 -->
            <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                <div class="feature-card text-center p-4 h-100">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-bolt fa-3x" style="color: #8b5cf6;"></i>
                    </div>
                    <h4 class="mb-3">Fast Delivery</h4>
                    <p class="text-light opacity-75">Rapid development without compromising quality. We respect deadlines and deliver on time, every time.</p>
                </div>
            </div>
            
            <!-- Column 3 -->
            <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                <div class="feature-card text-center p-4 h-100">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-headset fa-3x" style="color: #ec4899;"></i>
                    </div>
                    <h4 class="mb-3">24/7 Support</h4>
                    <p class="text-light opacity-75">Round-the-clock technical support to ensure your digital solutions run smoothly at all times.</p>
                </div>
            </div>
            
            <!-- Column 4 -->
            <div class="col-md-6 col-lg-3">
                <div class="feature-card text-center p-4 h-100">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-shield-alt fa-3x" style="color: #06b6d4;"></i>
                    </div>
                    <h4 class="mb-3">Secure Solutions</h4>
                    <p class="text-light opacity-75">Top-notch security protocols to protect your data and ensure compliance with industry standards.</p>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Contact Section -->
    <section class="contact py-5" id="contact">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="section-title mb-3">Get In Touch</h2>
                <p class="section-subtitle">Ready to start your magical digital journey? Contact us today!</p>
            </div>
            
            <div class="row g-4">
                <!-- Location -->
                <div class="col-md-4">
                    <div class="contact-card h-100">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3>Location</h3>
                        <p class="mb-0">
                            3rd Floor HR Building II<br>
                            Quezon Ave. Corner Gomez<br>
                            Lucena City, Philippines<br>
                            4301
                        </p>
                    </div>
                </div>

                <!-- Phone -->
                <div class="col-md-4">
                    <div class="contact-card h-100">
                        <div class="contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h3>Phone</h3>
                        <p>
                            <a href="tel:09996540792" class="text-decoration-none">09996540792</a>
                        </p>
                    </div>
                </div>

                <!-- Hours -->
                <div class="col-md-4">
                    <div class="contact-card h-100">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Business Hours</h3>
                        <p class="mb-0">
                            Monday – Friday<br>
                            9:00 AM – 5:00 PM
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta py-5">
        <div class="cta-bg"></div>
        <div class="container">
            <div class="cta-content text-center">
                <div class="cta-icon mb-4">
                    <i class="fas fa-sparkles" style="font-size: 4rem;"></i>
                </div>
                <h2 class="mb-4">Ready to Create Magic Together?</h2>
                <p class="mb-5">Join our community and let's transform your digital dreams into reality</p>
                <a href="/login" class="btn btn-cta-large">
                    Join Now <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="footer-brand">
                        <div class="logo d-flex align-items-center mb-3">
                            <img src="{{ asset('assets/logo_main.png') }}" alt="RGRR WebMaker Logo" class="logo-img me-3" onerror="this.style.display='none'">
                            <div class="logo-text">
                                <span class="logo-rgrr">RGRR</span>
                                <span class="logo-webmaker">WebMaker</span>
                            </div>
                        </div>
                        <p>Transforming digital dreams into reality with expertise, innovation, and a touch of magic.</p>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="footer-column">
                                <h4 class="mb-3">Quick Links</h4>
                                <a href="#services" class="d-block mb-2">Services</a>
                                <a href="#about" class="d-block mb-2">About Us</a>
                                <a href="#contact" class="d-block">Contact</a>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="footer-column">
                                <h4 class="mb-3">Services</h4>
                                <a href="#services" class="d-block mb-2">Web Development</a>
                                <a href="#services" class="d-block mb-2">Game Development</a>
                                <a href="#services" class="d-block">Database Solutions</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom pt-4 border-top border-secondary">
                <p class="text-center mb-0">&copy; 2024 RGRR WebMaker. All rights reserved. Made with <i class="fas fa-sparkles text-warning"></i> magic</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Your existing JS -->
    <script src="{{ asset('js/script.js') }}"></script>
    
    <script>
        // Add smooth scrolling for Bootstrap navigation
        document.addEventListener('DOMContentLoaded', function() {
            // Add active class to navbar on scroll
            const navbar = document.querySelector('.navbar');
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    if(targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if(targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>