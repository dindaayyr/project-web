<?= $this->extend('layouts/admin') ?>
<?= $this->section('sidebar') ?>
<div class="nav-section">Super Admin</div>
<a class="nav-link active" href="/superadmin/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link" href="/superadmin/agents"><i class="fa-solid fa-building"></i> Agen Travel</a>
<a class="nav-link" href="/superadmin/packages"><i class="fa-solid fa-box"></i> Semua Paket</a>
<a class="nav-link" href="/superadmin/ai-config"><i class="fa-solid fa-robot"></i> Konfigurasi AI</a>
<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Dashboard Super Admin<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row mb-4">
    <div class="col-md-3"><div class="stat-card"><div class="stat-icon" style="background:var(--emerald-50);color:var(--emerald);"><i class="fa-solid fa-building"></i></div><h3><?= $totalAgents ?></h3><small>Total Agen</small></div></div>
    <div class="col-md-3"><div class="stat-card"><div class="stat-icon" style="background:#dbeafe;color:#1e40af;"><i class="fa-solid fa-box"></i></div><h3><?= $totalPackages ?></h3><small>Total Paket</small></div></div>
    <div class="col-md-3"><div class="stat-card"><div class="stat-icon" style="background:#fef9c3;color:#854d0e;"><i class="fa-solid fa-ticket-alt"></i></div><h3><?= $totalBookings ?></h3><small>Total Booking</small></div></div>
    <div class="col-md-3"><div class="stat-card"><div class="stat-icon" style="background:#dcfce7;color:#166534;"><i class="fa-solid fa-users"></i></div><h3><?= $totalUsers ?></h3><small>Jamaah Terdaftar</small></div></div>
</div>
<div class="card-section">
    <h6><i class="fa-solid fa-clock mr-2" style="color:var(--emerald);"></i>Booking Terbaru (Global)</h6>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead><tr><th>Kode</th><th>Jamaah</th><th>Paket</th><th>Total</th><th>Status</th><th>Tanggal</th></tr></thead>
            <tbody>
            <?php if (!empty($latestBookings)): foreach ($latestBookings as $b): ?>
                <tr>
                    <td><strong><?= esc($b['booking_code']) ?></strong></td>
                    <td><?= esc($b['user_name']) ?></td>
                    <td><?= esc($b['package_name']) ?></td>
                    <td>Rp <?= number_format($b['total_price'], 0, ',', '.') ?></td>
                    <td><span class="badge badge-<?= $b['status'] === 'lunas' ? 'lunas' : ($b['status'] === 'pending' ? 'pending' : 'cancelled') ?> px-3 py-1" style="border-radius:8px;"><?= ucfirst($b['status']) ?></span></td>
                    <td><?= date('d/m/Y', strtotime($b['created_at'])) ?></td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada booking.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
