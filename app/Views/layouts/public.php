<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'UmrohQueens - Agregator Paket Umroh Terpercaya' ?></title>
    <meta name="description" content="<?= $pageDescription ?? 'UmrohQueens - Platform agregator travel umroh terpercaya dengan AI Assistant. Bandingkan harga, cek kuota real-time, dan temukan paket umroh terbaik.' ?>">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        :root {
            --emerald-dark: #064e3b;
            --emerald: #047857;
            --emerald-light: #0f766e;
            --emerald-50: #ecfdf5;
            --gold-accent: #d4af37;
            --gold-light: #f5e6b8;
            --gold-dark: #b8941f;
            --glass: rgba(255, 255, 255, 0.95);
            --body-bg: #fafbfc;
            --text-dark: #1a1a2e;
            --text-muted: #6b7280;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            background: var(--body-bg);
            overflow-x: hidden;
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
        }

        /* ===== NAVBAR ===== */
        .navbar-umroh {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(15px);
            padding: 12px 0;
            box-shadow: 0 2px 20px rgba(0,0,0,0.06);
            transition: all 0.3s ease;
            z-index: 1000;
        }
        .navbar-umroh.scrolled {
            padding: 8px 0;
            box-shadow: 0 4px 30px rgba(0,0,0,0.1);
        }
        .navbar-brand-custom {
            font-family: 'Playfair Display', serif;
            font-weight: 800;
            font-size: 1.6rem;
            color: var(--emerald-dark) !important;
            text-decoration: none !important;
        }
        .navbar-brand-custom span { color: var(--gold-accent); }
        .nav-link-custom {
            color: #374151 !important;
            font-weight: 500;
            font-size: 0.95rem;
            padding: 8px 18px !important;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .nav-link-custom:hover {
            color: var(--emerald) !important;
            background: var(--emerald-50);
        }
        .btn-nav-login {
            background: transparent;
            color: var(--emerald-dark) !important;
            border: 2px solid var(--emerald-dark);
            padding: 8px 24px !important;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-nav-login:hover {
            background: var(--emerald-dark);
            color: #fff !important;
        }
        .btn-nav-register {
            background: linear-gradient(135deg, var(--emerald-dark), var(--emerald));
            color: #fff !important;
            padding: 8px 24px !important;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(6, 78, 59, 0.3);
        }
        .btn-nav-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(6, 78, 59, 0.4);
            color: #fff !important;
        }

        /* ===== FOOTER ===== */
        .footer-section {
            background: linear-gradient(135deg, #022c22, var(--emerald-dark));
            color: rgba(255,255,255,0.8);
            padding: 60px 0 0;
        }
        .footer-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 800;
            font-size: 1.8rem;
            color: #fff;
        }
        .footer-brand span { color: var(--gold-accent); }
        .footer-section h5 {
            font-family: 'Poppins', sans-serif;
            color: var(--gold-accent);
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }
        .footer-links { list-style: none; padding: 0; }
        .footer-links li { margin-bottom: 10px; }
        .footer-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        .footer-links a:hover {
            color: var(--gold-accent);
            padding-left: 5px;
        }
        .footer-social a {
            display: inline-flex;
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-decoration: none;
            margin-right: 8px;
            transition: all 0.3s;
        }
        .footer-social a:hover {
            background: var(--gold-accent);
            color: var(--emerald-dark);
            transform: translateY(-3px);
        }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding: 20px 0;
            margin-top: 40px;
            text-align: center;
            font-size: 0.85rem;
            color: rgba(255,255,255,0.5);
        }
        .footer-contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            font-size: 0.9rem;
        }
        .footer-contact-item i {
            width: 35px;
            height: 35px;
            background: rgba(212, 175, 55, 0.15);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold-accent);
            margin-right: 12px;
            font-size: 0.85rem;
        }

        /* ===== GLOBAL HELPERS ===== */
        .section-heading {
            text-align: center;
            margin-bottom: 50px;
        }
        .section-heading h2 {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--emerald-dark);
            margin-bottom: 10px;
        }
        .section-heading p {
            font-size: 1.05rem;
            color: var(--text-muted);
            max-width: 550px;
            margin: 0 auto;
        }
        .gold-line {
            width: 60px;
            height: 3px;
            background: var(--gold-accent);
            margin: 12px auto 18px;
            border-radius: 3px;
        }
        .btn-emerald {
            background: linear-gradient(135deg, var(--emerald-dark), var(--emerald));
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-emerald:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(6, 78, 59, 0.4);
            color: #fff;
        }
        .btn-gold {
            background: linear-gradient(135deg, var(--gold-accent), var(--gold-dark));
            color: var(--emerald-dark);
            border: none;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
            color: var(--emerald-dark);
        }

        @media (max-width: 768px) {
            .section-heading h2 { font-size: 1.6rem; }
        }
    </style>
    <?= $this->renderSection('styles') ?>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-umroh fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand-custom" href="/">Umroh<span>Queens</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navContent"
                    aria-controls="navContent" aria-expanded="false" aria-label="Toggle navigation"
                    style="border: 2px solid var(--emerald-dark); padding: 4px 10px;">
                <i class="fa-solid fa-bars" style="color: var(--emerald-dark);"></i>
            </button>
            <div class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="/">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="/katalog">Katalog Paket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#">Tentang</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center mt-3 mt-lg-0">
                    <?php if (session()->get('logged_in')): ?>
                        <div class="dropdown">
                            <a class="nav-link-custom dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                                <img src="https://ui-avatars.com/api/?name=<?= urlencode(session()->get('user_name')) ?>&background=064e3b&color=fff" class="rounded-circle mr-2" width="32" height="32">
                                <?= esc(session()->get('user_name')) ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow-sm border-0" style="border-radius: 12px;">
                                <a class="dropdown-item py-2" href="/user/dashboard"><i class="fa fa-tachometer-alt mr-2 text-muted"></i>Dashboard</a>
                                <a class="dropdown-item py-2" href="/user/bookings"><i class="fa fa-ticket-alt mr-2 text-muted"></i>Pemesanan</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item py-2 text-danger" href="/logout"><i class="fa fa-sign-out-alt mr-2"></i>Logout</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="/login" class="btn btn-nav-login mr-2">Masuk</a>
                        <a href="/register" class="btn btn-nav-register">Daftar</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- PAGE CONTENT -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <!-- FOOTER -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="footer-brand mb-3">Umroh<span>Queens</span></div>
                    <p class="small" style="line-height: 1.8;">Platform agregator travel umroh terpercaya di Indonesia. Bandingkan harga, cek kuota real-time, dan temukan paket umroh terbaik untuk perjalanan suci Anda.</p>
                    <div class="footer-social mt-3">
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-4">
                    <h5>Menu</h5>
                    <ul class="footer-links">
                        <li><a href="/">Beranda</a></li>
                        <li><a href="/katalog">Katalog Paket</a></li>
                        <li><a href="#">Berita Umroh</a></li>
                        <li><a href="#">Tentang Kami</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 mb-4">
                    <h5>Bantuan</h5>
                    <ul class="footer-links">
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="/login">Login Jamaah</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 mb-4">
                    <h5>Hubungi Kami</h5>
                    <div class="footer-contact-item">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>Jl. Masjid Al-Haram No. 1, Jakarta</span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="fa-solid fa-phone"></i>
                        <span>+62 812-3456-7890</span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="fa-solid fa-envelope"></i>
                        <span>info@umrohqueens.com</span>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="mb-0">&copy; <?= date('Y') ?> UmrohQueens. All Rights Reserved. Dibuat dengan <i class="fa fa-heart text-danger"></i> untuk umat.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('mainNav');
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });
    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
