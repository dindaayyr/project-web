<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Dashboard | UmrohQueens' ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --emerald-dark:#064e3b; --emerald:#047857; --emerald-50:#ecfdf5; --gold-accent:#d4af37; --text-dark:#1a1a2e; --text-muted:#6b7280; }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Poppins',sans-serif; color:var(--text-dark); background:#f4f6f9; }
        .sidebar { position:fixed; top:0; left:0; width:260px; height:100vh; background:linear-gradient(180deg,#022c22,var(--emerald-dark)); color:#fff; padding-top:20px; overflow-y:auto; z-index:1000; }
        .sidebar .brand { text-align:center; padding:10px 20px 30px; border-bottom:1px solid rgba(255,255,255,0.1); }
        .sidebar .brand h4 { font-weight:700; margin:0; } .sidebar .brand h4 span { color:var(--gold-accent); }
        .sidebar .brand small { color:rgba(255,255,255,0.5); font-size:0.75rem; }
        .sidebar .nav-menu { padding:20px 0; }
        .sidebar .nav-item { display:block; }
        .sidebar .nav-link { color:rgba(255,255,255,0.7); padding:12px 25px; display:flex; align-items:center; font-size:0.9rem; transition:all 0.3s; text-decoration:none; border-left:3px solid transparent; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color:#fff; background:rgba(255,255,255,0.08); border-left-color:var(--gold-accent); }
        .sidebar .nav-link i { width:20px; margin-right:12px; text-align:center; }
        .sidebar .nav-section { color:var(--gold-accent); font-size:0.7rem; font-weight:600; text-transform:uppercase; letter-spacing:1px; padding:20px 25px 8px; }
        .main-content { margin-left:260px; padding:25px 30px; min-height:100vh; }
        .topbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:30px; }
        .topbar h4 { font-weight:600; margin:0; }
        .stat-card { background:#fff; border-radius:16px; padding:22px; box-shadow:0 2px 12px rgba(0,0,0,0.04); border:1px solid #f1f5f9; }
        .stat-card .stat-icon { width:48px; height:48px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.2rem; }
        .stat-card h3 { font-weight:700; margin:8px 0 2px; }
        .stat-card small { color:var(--text-muted); font-size:0.8rem; }
        .card-section { background:#fff; border-radius:16px; padding:25px; box-shadow:0 2px 12px rgba(0,0,0,0.04); border:1px solid #f1f5f9; margin-bottom:25px; }
        .card-section h6 { font-weight:600; margin-bottom:18px; color:var(--text-dark); }
        .table th { font-size:0.8rem; font-weight:600; text-transform:uppercase; color:var(--text-muted); border-top:none; }
        .table td { vertical-align:middle; font-size:0.88rem; }
        .badge-lunas { background:#dcfce7; color:#166534; } .badge-pending { background:#fef9c3; color:#854d0e; }
        .badge-cancelled { background:#fee2e2; color:#991b1b; } .badge-processing { background:#dbeafe; color:#1e40af; }
        @media(max-width:768px) { .sidebar{width:0;overflow:hidden;} .main-content{margin-left:0;} }
    </style>
    <?= $this->renderSection('styles') ?>
</head>
<body>
<div class="sidebar">
    <div class="brand">
        <h4>Umroh<span>Queens</span></h4>
        <small><?= ucfirst(session()->get('user_role') ?? 'user') ?> Panel</small>
    </div>
    <div class="nav-menu">
        <?= $this->renderSection('sidebar') ?>
        <div class="nav-section">Akun</div>
        <a class="nav-link" href="/logout"><i class="fa-solid fa-sign-out-alt"></i> Logout</a>
    </div>
</div>
<div class="main-content">
    <div class="topbar">
        <h4><?= $this->renderSection('page_title') ?></h4>
        <div class="d-flex align-items-center">
            <img src="https://ui-avatars.com/api/?name=<?= urlencode(session()->get('user_name') ?? 'U') ?>&background=064e3b&color=fff" class="rounded-circle mr-2" width="36" height="36">
            <span style="font-size:0.9rem;font-weight:500;"><?= esc(session()->get('user_name') ?? 'User') ?></span>
        </div>
    </div>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius:12px;">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius:12px;">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    <?php endif; ?>
    <?= $this->renderSection('content') ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<?= $this->renderSection('scripts') ?>
</body>
</html>
