<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Jamaah | UmrohQueens</title>
    <meta name="description" content="Daftar sebagai jamaah di UmrohQueens dan temukan paket umroh terbaik untuk perjalanan suci Anda.">
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
            overflow-x: hidden;
            padding: 30px 0;
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
        .register-container {
            width: 100%;
            max-width: 500px;
            padding: 15px;
            position: relative;
            z-index: 2;
        }
        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 45px 40px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.3);
            border: 1px solid rgba(212, 175, 55, 0.2);
        }
        .brand-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .brand-logo h2 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--emerald-dark);
            font-size: 2rem;
            margin-bottom: 5px;
        }
        .brand-logo h2 span { color: var(--gold-accent); }
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
        .input-icon-group:focus-within i {
            color: var(--emerald);
        }
        .btn-register {
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
        .btn-register::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            transition: left 0.5s;
        }
        .btn-register:hover::before { left: 100%; }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(6, 78, 59, 0.4);
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
        .login-link a {
            color: var(--emerald);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s;
        }
        .login-link a:hover { color: var(--gold-accent); }
        .alert {
            border-radius: 12px;
            font-size: 0.85rem;
            border: none;
        }
        .alert-danger { background: #fef2f2; color: #dc2626; }
        .floating-ornament {
            position: fixed;
            opacity: 0.08;
            color: var(--gold-accent);
            z-index: 0;
        }
        .ornament-1 { top: 10%; left: 5%; font-size: 6rem; animation: float 6s ease-in-out infinite; }
        .ornament-2 { bottom: 15%; right: 8%; font-size: 5rem; animation: float 8s ease-in-out infinite reverse; }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
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
        .invalid-feedback-custom {
            color: #dc2626;
            font-size: 0.8rem;
            margin-top: 4px;
        }
    </style>
</head>
<body>
    <i class="fa-solid fa-mosque floating-ornament ornament-1"></i>
    <i class="fa-solid fa-star-and-crescent floating-ornament ornament-2"></i>

    <div class="register-container animate__animated animate__fadeInUp">
        <div class="register-card">
            <div class="brand-logo">
                <h2>Umroh<span>Queens</span></h2>
                <p>Daftar sebagai jamaah dan mulai perjalanan suci Anda</p>
            </div>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger animate__animated animate__headShake">
                    <ul class="mb-0 pl-3">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="/register" method="POST" id="registerForm">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <div class="input-icon-group">
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="Masukkan nama lengkap" value="<?= old('name') ?>" required>
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-icon-group">
                        <input type="email" class="form-control" id="email" name="email"
                               placeholder="Masukkan email Anda" value="<?= old('email') ?>" required>
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone">Nomor Telepon</label>
                    <div class="input-icon-group">
                        <input type="tel" class="form-control" id="phone" name="phone"
                               placeholder="08xxxxxxxxxx" value="<?= old('phone') ?>" required>
                        <i class="fa-solid fa-phone"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-icon-group">
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="Minimal 6 karakter" required>
                        <i class="fa-solid fa-lock"></i>
                        <button type="button" class="password-toggle" onclick="togglePassword('password', 'toggleIcon1')">
                            <i class="fa-solid fa-eye" id="toggleIcon1"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirm">Konfirmasi Password</label>
                    <div class="input-icon-group">
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm"
                               placeholder="Ulangi password Anda" required>
                        <i class="fa-solid fa-shield-halved"></i>
                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirm', 'toggleIcon2')">
                            <i class="fa-solid fa-eye" id="toggleIcon2"></i>
                        </button>
                    </div>
                </div>

                <div class="custom-control custom-checkbox mb-4">
                    <input type="checkbox" class="custom-control-input" id="terms" required>
                    <label class="custom-control-label small" for="terms">
                        Saya menyetujui <a href="#" class="text-success font-weight-bold">Syarat & Ketentuan</a>
                    </label>
                </div>

                <button type="submit" class="btn-register">
                    <i class="fa-solid fa-user-plus mr-2"></i> Daftar Sekarang
                </button>
            </form>

            <div class="login-link mt-4">
                <p>Sudah punya akun? <a href="/login">Masuk di sini</a></p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId, iconId) {
            const pwd = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
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
