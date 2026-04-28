<?= $this->extend('layouts/admin') ?>
<?= $this->section('sidebar') ?>
<div class="nav-section">Menu Agen</div>
<a class="nav-link active" href="/agent/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link" href="/agent/packages"><i class="fa-solid fa-box"></i> Kelola Paket</a>
<a class="nav-link" href="/agent/bookings"><i class="fa-solid fa-ticket-alt"></i> Data Jamaah</a>
<a class="nav-link" href="/agent/disbursements"><i class="fa-solid fa-money-bill-wave"></i> Pencairan Dana</a>
<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Dashboard Agen Travel<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row mb-4">
    <div class="col-md-3"><div class="stat-card"><div class="stat-icon" style="background:var(--emerald-50);color:var(--emerald);"><i class="fa-solid fa-box"></i></div><h3><?= $totalPackages ?></h3><small>Total Paket</small></div></div>
    <div class="col-md-3"><div class="stat-card"><div class="stat-icon" style="background:#dbeafe;color:#1e40af;"><i class="fa-solid fa-check-circle"></i></div><h3><?= $activePackages ?></h3><small>Paket Aktif</small></div></div>
    <div class="col-md-3"><div class="stat-card"><div class="stat-icon" style="background:#fef9c3;color:#854d0e;"><i class="fa-solid fa-users"></i></div><h3><?= $totalBookings ?></h3><small>Total Booking</small></div></div>
    <div class="col-md-3"><div class="stat-card"><div class="stat-icon" style="background:#dcfce7;color:#166534;"><i class="fa-solid fa-wallet"></i></div><h3>Rp <?= number_format($totalRevenue, 0, ',', '.') ?></h3><small>Total Revenue</small></div></div>
</div>
<div class="card-section">
    <h6><i class="fa-solid fa-clock mr-2" style="color:var(--emerald);"></i>Booking Terbaru</h6>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead><tr><th>Kode</th><th>Jamaah</th><th>Paket</th><th>Status</th><th>Tanggal</th></tr></thead>
            <tbody>
            <?php if (!empty($bookings)): foreach ($bookings as $b): ?>
                <tr>
                    <td><strong><?= esc($b['booking_code']) ?></strong></td>
                    <td><?= esc($b['user_name']) ?></td>
                    <td><?= esc($b['package_name']) ?></td>
                    <td><span class="badge badge-<?= $b['status'] === 'lunas' ? 'lunas' : ($b['status'] === 'pending' ? 'pending' : 'cancelled') ?> px-3 py-1" style="border-radius:8px;"><?= ucfirst($b['status']) ?></span></td>
                    <td><?= date('d/m/Y', strtotime($b['created_at'])) ?></td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="5" class="text-center text-muted py-4">Belum ada booking.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
