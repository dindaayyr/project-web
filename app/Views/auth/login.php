<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | UmrohQueens</title>
    <meta name="description" content="Masuk ke akun UmrohQueens Anda untuk melihat paket umroh dan mengelola pemesanan.">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        :root {
            --emerald-dark: #064e3b;
            --emerald: #047857;
            --emerald-light: #0f766e;
            --gold-accent: #d4af37;
            --gold-light: #f5e6b8;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #064e3b 0%, #022c22 50%, #064e3b 100%);
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23d4af37' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
            animation: floatPattern 60s linear infinite;
        }
        @keyframes floatPattern {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(-50px, -50px) rotate(5deg); }
        }
        .login-container {
            width: 100%;
            max-width: 460px;
            padding: 15px;
            position: relative;
            z-index: 2;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 50px 40px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.3);
            border: 1px solid rgba(212, 175, 55, 0.2);
        }
        .brand-logo {
            text-align: center;
            margin-bottom: 35px;
        }
        .brand-logo h2 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--emerald-dark);
            font-size: 2rem;
            margin-bottom: 5px;
        }
        .brand-logo h2 span {
            color: var(--gold-accent);
        }
        .brand-logo p {
            color: #6b7280;
            font-size: 0.85rem;
        }
        .form-group label {
            font-weight: 500;
            font-size: 0.85rem;
            color: #374151;
            margin-bottom: 8px;
        }
        .form-control {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px 18px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: #f9fafb;
        }
        .form-control:focus {
            border-color: var(--emerald);
            box-shadow: 0 0 0 4px rgba(4, 120, 87, 0.1);
            background: #fff;
        }
        .input-icon-group {
            position: relative;
        }
        .input-icon-group i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            transition: color 0.3s;
        }
        .input-icon-group .form-control {
            padding-left: 45px;
        }
        .input-icon-group .form-control:focus + i,
        .input-icon-group:focus-within i {
            color: var(--emerald);
        }
        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--emerald-dark), var(--emerald));
            color: #fff;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            transition: left 0.5s;
        }
        .btn-login:hover::before {
            left: 100%;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(6, 78, 59, 0.4);
        }
        .divider {
            text-align: center;
            margin: 25px 0;
            position: relative;
        }
        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e5e7eb;
        }
        .divider span {
            background: rgba(255,255,255,0.95);
            padding: 0 15px;
            color: #9ca3af;
            font-size: 0.85rem;
            position: relative;
        }
        .register-link {
            text-align: center;
            margin-top: 20px;
        }
        .register-link a {
            color: var(--emerald);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s;
        }
        .register-link a:hover {
            color: var(--gold-accent);
        }
        .alert {
            border-radius: 12px;
            font-size: 0.9rem;
            border: none;
        }
        .alert-danger { background: #fef2f2; color: #dc2626; }
        .alert-success { background: #f0fdf4; color: #16a34a; }
        .floating-ornament {
            position: fixed;
            opacity: 0.08;
            color: var(--gold-accent);
            z-index: 0;
        }
        .ornament-1 { top: 10%; left: 5%; font-size: 6rem; animation: float 6s ease-in-out infinite; }
        .ornament-2 { bottom: 15%; right: 8%; font-size: 5rem; animation: float 8s ease-in-out infinite reverse; }
        .ornament-3 { top: 60%; left: 80%; font-size: 4rem; animation: float 7s ease-in-out infinite 1s; }
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            z-index: 5;
        }
        .password-toggle:hover { color: var(--emerald); }
    </style>
</head>
<body>
    <i class="fa-solid fa-mosque floating-ornament ornament-1"></i>
    <i class="fa-solid fa-star-and-crescent floating-ornament ornament-2"></i>
    <i class="fa-solid fa-kaaba floating-ornament ornament-3"></i>

    <div class="login-container animate__animated animate__fadeInUp">
        <div class="login-card">
            <div class="brand-logo">
                <h2>Umroh<span>Queens</span></h2>
                <p>Selamat datang kembali, masuk ke akun Anda</p>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger animate__animated animate__headShake">
                    <i class="fa fa-exclamation-circle mr-2"></i>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success animate__animated animate__fadeIn">
                    <i class="fa fa-check-circle mr-2"></i>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <form action="/login" method="POST" id="loginForm">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-icon-group">
                        <input type="email" class="form-control" id="email" name="email"
                               placeholder="Masukkan email Anda" value="<?= old('email') ?>" required>
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-icon-group">
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="Masukkan password" required>
                        <i class="fa-solid fa-lock"></i>
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="fa-solid fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="remember">
                        <label class="custom-control-label small" for="remember">Ingat saya</label>
                    </div>
                </div>

                <button type="submit" class="btn-login" id="loginBtn">
                    <i class="fa-solid fa-right-to-bracket mr-2"></i> Masuk
                </button>
            </form>

            <div class="divider">
                <span>atau</span>
            </div>

            <div class="register-link">
                <p>Belum punya akun? <a href="/register">Daftar Sekarang</a></p>
                <div class="mt-4 pt-3 border-top">
                    <p class="small text-muted mb-2">Ingin memasarkan paket umroh Anda?</p>
                    <a href="/register-agent" class="font-weight-bold" style="color: var(--emerald-dark);">
                        <i class="fa-solid fa-handshake mr-1"></i> Daftar sebagai Mitra
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const pwd = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
            if (pwd.type === 'password') {
                pwd.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                pwd.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>
