<?= $this->extend('layouts/admin') ?>
<?= $this->section('sidebar') ?>
<div class="nav-section">Menu Keuangan</div>
<a class="nav-link" href="/finance/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link active" href="/finance/transactions"><i class="fa-solid fa-receipt"></i> Transaksi</a>
<a class="nav-link" href="/finance/disbursements"><i class="fa-solid fa-money-bill-wave"></i> Pencairan Dana</a>
<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Semua Transaksi Lunas<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="card-section">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead><tr><th>Kode</th><th>Paket</th><th>Agen</th><th>Total</th><th>Metode Bayar</th><th>Tanggal Bayar</th><th>Berangkat</th></tr></thead>
            <tbody>
            <?php if (!empty($bookings)): foreach ($bookings as $b): ?>
                <tr>
                    <td><strong><?= esc($b['booking_code']) ?></strong></td>
                    <td><?= esc($b['package_name']) ?></td>
                    <td><?= esc($b['travel_name']) ?></td>
                    <td>Rp <?= number_format($b['total_price'], 0, ',', '.') ?></td>
                    <td><?= esc($b['payment_type'] ?? '-') ?></td>
                    <td><?= $b['paid_at'] ? date('d/m/Y H:i', strtotime($b['paid_at'])) : '-' ?></td>
                    <td><?= $b['tanggal_berangkat'] ? date('d/m/Y', strtotime($b['tanggal_berangkat'])) : '-' ?></td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="7" class="text-center text-muted py-4">Belum ada transaksi.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
