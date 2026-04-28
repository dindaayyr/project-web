<?= $this->extend('layouts/admin') ?>
<?= $this->section('sidebar') ?>
<div class="nav-section">Menu Keuangan</div>
<a class="nav-link active" href="/finance/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link" href="/finance/transactions"><i class="fa-solid fa-receipt"></i> Transaksi</a>
<a class="nav-link" href="/finance/disbursements"><i class="fa-solid fa-money-bill-wave"></i> Pencairan Dana</a>
<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Dashboard Keuangan<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row mb-4">
    <div class="col-md-3"><div class="stat-card"><div class="stat-icon" style="background:#dcfce7;color:#166534;"><i class="fa-solid fa-check-circle"></i></div><h3><?= $totalSettled ?></h3><small>Transaksi Lunas</small></div></div>
    <div class="col-md-3"><div class="stat-card"><div class="stat-icon" style="background:var(--emerald-50);color:var(--emerald);"><i class="fa-solid fa-wallet"></i></div><h3>Rp <?= number_format($totalAmount, 0, ',', '.') ?></h3><small>Total Pendapatan</small></div></div>
    <div class="col-md-3"><div class="stat-card"><div class="stat-icon" style="background:#dbeafe;color:#1e40af;"><i class="fa-solid fa-paper-plane"></i></div><h3><?= $totalDisbursed ?></h3><small>Sudah Dicairkan</small></div></div>
    <div class="col-md-3"><div class="stat-card"><div class="stat-icon" style="background:#fef9c3;color:#854d0e;"><i class="fa-solid fa-clock"></i></div><h3><?= $pendingDisburse ?></h3><small>Menunggu Pencairan</small></div></div>
</div>
<div class="card-section">
    <h6><i class="fa-solid fa-receipt mr-2" style="color:var(--emerald);"></i>Transaksi Lunas Terbaru</h6>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead><tr><th>Kode</th><th>Paket</th><th>Agen</th><th>Total</th><th>Berangkat</th><th>Bayar</th></tr></thead>
            <tbody>
            <?php if (!empty($recentBookings)): foreach ($recentBookings as $b): ?>
                <tr>
                    <td><strong><?= esc($b['booking_code']) ?></strong></td>
                    <td><?= esc($b['package_name']) ?></td>
                    <td><?= esc($b['travel_name']) ?></td>
                    <td>Rp <?= number_format($b['total_price'], 0, ',', '.') ?></td>
                    <td><?= $b['tanggal_berangkat'] ? date('d/m/Y', strtotime($b['tanggal_berangkat'])) : '-' ?></td>
                    <td><?= $b['paid_at'] ? date('d/m/Y', strtotime($b['paid_at'])) : '-' ?></td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada transaksi lunas.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
