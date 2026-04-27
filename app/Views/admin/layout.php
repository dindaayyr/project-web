<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Umroh Hub | Aggregator Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        :root {
            --emerald-dark: #064e3b;
            --emerald-light: #0f766e;
            --gold-accent: #d4af37;
            --glass: rgba(255, 255, 255, 0.95);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        #wrapper { display: flex; width: 100%; }
        
        #sidebar {
            min-width: 280px;
            max-width: 280px;
            background: linear-gradient(135deg, var(--emerald-dark) 0%, #022c22 100%);
            color: #fff;
            min-height: 100vh;
            transition: all 0.3s;
            position: sticky;
            top: 0;
        }

        .sidebar-header {
            padding: 40px 25px;
            text-align: center;
            border-bottom: 1px solid rgba(212, 175, 55, 0.2);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.7) !important;
            padding: 12px 25px !important;
            margin: 8px 15px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .nav-link i { width: 30px; font-size: 1.1rem; }

        .nav-link:hover {
            background: rgba(212, 175, 55, 0.1);
            color: var(--gold-accent) !important;
            transform: translateX(8px);
        }

        .nav-link.active {
            background: var(--gold-accent) !important;
            color: var(--emerald-dark) !important;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }

        /* Content Area */
        #content { width: 100%; padding: 30px; }

        .card-elegant {
            background: var(--glass);
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
            overflow: hidden;
        }

        .card-elegant:hover { transform: translateY(-5px); }

        .icon-shape {
            width: 60px;
            height: 60px;
            background: rgba(6, 78, 59, 0.08);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--emerald-dark);
        }
    </style>
</head>
<body>

<div id="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3 class="font-weight-bold mb-0">Umroh<span style="color: var(--gold-accent)">Hub</span></h3>
            <p class="small opacity-50 mb-0">Aggregator Exclusive</p>
        </div>
        
        <div class="mt-4">
            <a href="/admin/dashboard" class="nav-link active">
                <i class="fa-solid fa-house-chimney"></i> Dashboard
            </a>
            <a href="/admin/travel" class="nav-link">
                <i class="fa-solid fa-kaaba"></i> Kelola Travel
            </a>
            <a href="/admin/paket" class="nav-link">
                <i class="fa-solid fa-box-archive"></i> Paket & Kuota
            </a>
            <a href="/admin/berita" class="nav-link">
                <i class="fa-solid fa-newspaper"></i> Konten Berita
            </a>
            <a href="/admin/api-ai" class="nav-link">
                <i class="fa-solid fa-robot"></i> Pengaturan API & AI
            </a>
        </div>
    </nav>

    <div id="content">
        <div class="d-flex justify-content-between align-items-center mb-5 animate__animated animate__fadeIn">
            <div>
                <h4 class="font-weight-bold">Dashboard Ringkasan</h4>
                <p class="text-muted mb-0">Selamat datang kembali, Admin.</p>
            </div>
            <div class="d-flex align-items-center">
                <div class="text-right mr-3">
                    <p id="clock" class="mb-0 font-weight-bold" style="color: var(--emerald-dark)"></p>
                    <small class="text-muted"><?= date('d M Y') ?></small>
                </div>
                <div class="dropdown">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=064e3b&color=fff" class="rounded-circle shadow-sm" width="45" data-toggle="dropdown" style="cursor:pointer">
                </div>
            </div>
        </div>

        <?= $this->renderSection('content') ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function updateClock() {
        const now = new Date();
        document.getElementById('clock').textContent = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' }) + " WIB";
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>

</body>
</html>