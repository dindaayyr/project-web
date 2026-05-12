<?= $this->extend('layouts/admin') ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">Menu Keuangan</div>
<a class="nav-link" href="/finance/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link active" href="/finance/transactions"><i class="fa-solid fa-receipt"></i> Transaksi</a>
<a class="nav-link" href="/finance/disbursements"><i class="fa-solid fa-money-bill-wave"></i> Pencairan Dana</a>
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>Daftar Transaksi Berhasil<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card-section">
    <h6><i class="fa-solid fa-receipt mr-2" style="color:#d4af37;"></i>Data Transaksi (Settled)</h6>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Booking Code</th>
                    <th>Nama Jamaah</th>
                    <th>Paket Umroh</th>
                    <th>Total Bayar</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($bookings)): foreach ($bookings as $b): ?>
                <tr>
                    <td><strong><?= esc($b['booking_code']) ?></strong></td>
                    <td><?= esc($b['jamaah_name']) ?></td>
                    <td><?= esc($b['nama_paket']) ?></td>
                    <td>Rp <?= number_format($b['total_price'], 0, ',', '.') ?></td>
                    <td>
                        <span class="badge badge-success px-3 py-2" style="border-radius:20px;">
                            <i class="fa-solid fa-check-circle mr-1"></i> Success
                        </span>
                    </td>
                    <td><?= date('d/m/Y H:i', strtotime($b['created_at'])) ?></td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data transaksi berhasil.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
