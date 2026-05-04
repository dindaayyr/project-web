<?= $this->extend('layouts/admin') ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">Super Admin</div>
<a class="nav-link" href="/superadmin/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link" href="/superadmin/agents"><i class="fa-solid fa-building"></i> Agen Travel</a>
<a class="nav-link" href="/superadmin/users"><i class="fa-solid fa-users"></i> Data Jamaah</a>
<a class="nav-link" href="/superadmin/packages"><i class="fa-solid fa-box"></i> Semua Paket</a>
<a class="nav-link active" href="/superadmin/transactions"><i class="fa-solid fa-file-invoice-dollar"></i> Transaksi</a>
<a class="nav-link" href="/superadmin/ai-config"><i class="fa-solid fa-robot"></i> Konfigurasi AI</a>
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>Laporan Transaksi (Global)<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card-section">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Kode Booking</th>
                    <th>Jamaah</th>
                    <th>Paket Umroh</th>
                    <th>Total Bayar</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($bookings)): foreach ($bookings as $b): ?>
                <tr>
                    <td><span class="font-weight-bold text-primary"><?= esc($b['booking_code']) ?></span></td>
                    <td><?= esc($b['user_name']) ?></td>
                    <td><?= esc($b['package_name']) ?></td>
                    <td><strong>Rp <?= number_format($b['total_price'], 0, ',', '.') ?></strong></td>
                    <td>
                        <span class="badge badge-<?= $b['status'] === 'lunas' ? 'lunas' : ($b['status'] === 'pending' ? 'pending' : 'cancelled') ?> px-3 py-1" style="border-radius:12px;">
                            <?= ucfirst($b['status']) ?>
                        </span>
                    </td>
                    <td><?= date('d/m/Y H:i', strtotime($b['created_at'])) ?></td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada transaksi terekam.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
