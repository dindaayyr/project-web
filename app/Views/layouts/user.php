<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Dashboard Jamaah' ?> | UmrohQueens</title>
    <meta name="description" content="Dashboard jamaah UmrohQueens - Kelola pemesanan, dokumen, dan pembayaran umroh Anda.">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            --glass: rgba(255, 255, 255, 0.95);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            overflow-x: hidden;
        }

        #wrapper { display: flex; width: 100%; }

        /* Sidebar */
        #sidebar {
            min-width: 270px;
            max-width: 270px;
            background: linear-gradient(180deg, var(--emerald-dark) 0%, #022c22 100%);
            color: #fff;
            min-height: 100vh;
            position: sticky;
            top: 0;
            transition: all 0.3s;
        }
        .sidebar-header {
            padding: 35px 25px 30px;
            border-bottom: 1px solid rgba(212, 175, 55, 0.15);
        }
        .sidebar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: #fff;
            text-decoration: none !important;
        }
        .sidebar-brand span { color: var(--gold-accent); }
        .sidebar-brand:hover { color: #fff; }
        .sidebar-user {
            display: flex;
            align-items: center;
            padding: 20px 25px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        .sidebar-user img {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            margin-right: 12px;
            border: 2px solid rgba(212, 175, 55, 0.3);
        }
        .sidebar-user .user-info .name {
            font-weight: 600;
            font-size: 0.9rem;
        }
        .sidebar-user .user-info .role {
            font-size: 0.75rem;
            opacity: 0.6;
        }
        .sidebar-nav {
            padding: 15px 0;
        }
        .sidebar-nav .nav-link {
            color: rgba(255, 255, 255, 0.65) !important;
            padding: 12px 25px !important;
            margin: 4px 15px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .sidebar-nav .nav-link i {
            width: 28px;
            font-size: 1rem;
            margin-right: 10px;
        }
        .sidebar-nav .nav-link:hover {
            background: rgba(212, 175, 55, 0.1);
            color: var(--gold-accent) !important;
            transform: translateX(5px);
        }
        .sidebar-nav .nav-link.active {
            background: var(--gold-accent) !important;
            color: var(--emerald-dark) !important;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }
        .sidebar-nav .nav-divider {
            border-top: 1px solid rgba(255,255,255,0.06);
            margin: 12px 25px;
        }

        /* Content */
        #content {
            width: 100%;
            padding: 30px;
        }
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .content-header h4 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--emerald-dark);
        }

        .card-elegant {
            background: var(--glass);
            border: none;
            border-radius: 18px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.04);
            transition: all 0.3s ease;
            overflow: hidden;
            border: 1px solid #f1f5f9;
        }
        .card-elegant:hover {
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .stat-card {
            padding: 25px;
        }
        .stat-card .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }
        .stat-card h3 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin-bottom: 0;
        }
        .stat-card .stat-label {
            font-size: 0.8rem;
            color: #6b7280;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table thead th {
            border-top: none;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6b7280;
            font-weight: 600;
            padding: 15px 20px;
        }
        .table tbody td {
            padding: 15px 20px;
            vertical-align: middle;
            font-size: 0.9rem;
        }
        .badge-status {
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .badge-pending {
            background: #fef3c7;
            color: #92400e;
        }
        .badge-verified {
            background: #dbeafe;
            color: #1e40af;
        }
        .badge-completed {
            background: #d1fae5;
            color: #065f46;
        }
        .badge-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .recommend-card {
            border-radius: 14px;
            overflow: hidden;
            transition: all 0.3s;
            border: 1px solid #f1f5f9;
        }
        .recommend-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }
        .recommend-card img {
            height: 120px;
            object-fit: cover;
            width: 100%;
        }

        @media (max-width: 768px) {
            #sidebar {
                min-width: 0;
                max-width: 0;
                overflow: hidden;
            }
            #sidebar.show {
                min-width: 270px;
                max-width: 270px;
                position: fixed;
                z-index: 999;
                height: 100vh;
            }
            .mobile-toggle {
                display: block !important;
            }
        }
        .mobile-toggle {
            display: none;
        }
    </style>
</head>
<body>

<div id="wrapper">
    <!-- SIDEBAR -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <a href="/" class="sidebar-brand">Umroh<span>Queens</span></a>
        </div>

        <div class="sidebar-user">
            <img src="https://ui-avatars.com/api/?name=<?= urlencode(session()->get('user_name') ?? 'User') ?>&background=064e3b&color=fff" alt="Avatar">
            <div class="user-info">
                <div class="name"><?= esc(session()->get('user_name') ?? 'User') ?></div>
                <div class="role">Jamaah</div>
            </div>
        </div>

        <div class="sidebar-nav">
            <a href="/user/dashboard" class="nav-link <?= (uri_string() == 'user/dashboard') ? 'active' : '' ?>">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>
            <a href="/user/bookings" class="nav-link <?= (uri_string() == 'user/bookings') ? 'active' : '' ?>">
                <i class="fa-solid fa-ticket"></i> My Bookings
            </a>
            <a href="/user/documents" class="nav-link <?= (uri_string() == 'user/documents') ? 'active' : '' ?>">
                <i class="fa-solid fa-file-arrow-up"></i> Upload Documents
            </a>
            <a href="/user/payments" class="nav-link <?= (uri_string() == 'user/payments') ? 'active' : '' ?>">
                <i class="fa-solid fa-credit-card"></i> Payments
            </a>
            <div class="nav-divider"></div>
            <a href="/katalog" class="nav-link">
                <i class="fa-solid fa-search"></i> Cari Paket
            </a>
            <a href="/logout" class="nav-link">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </div>
    </nav>

    <!-- CONTENT -->
    <div id="content">
        <div class="content-header animate__animated animate__fadeIn">
            <div>
                <button class="btn btn-sm btn-outline-dark mobile-toggle mr-3" onclick="document.getElementById('sidebar').classList.toggle('show')">
                    <i class="fa fa-bars"></i>
                </button>
                <h4 class="d-inline"><?= $pageTitle ?? 'Dashboard' ?></h4>
                <p class="text-muted mb-0 small">Selamat datang kembali, <?= esc(session()->get('user_name') ?? 'User') ?> 👋</p>
            </div>
            <div class="text-right">
                <p class="mb-0 font-weight-bold small" style="color: var(--emerald-dark);" id="userClock"></p>
                <small class="text-muted"><?= date('d M Y') ?></small>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success border-0 animate__animated animate__fadeIn" style="border-radius: 12px;">
                <i class="fa fa-check-circle mr-2"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function updateClock() {
        const now = new Date();
        const el = document.getElementById('userClock');
        if (el) {
            el.textContent = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' }) + " WIB";
        }
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>
</body>
</html>
