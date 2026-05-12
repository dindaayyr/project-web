<?= $this->extend('layouts/admin') ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">Menu Jamaah</div>
<a class="nav-link" href="/user/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link" href="/user/bookings"><i class="fa-solid fa-kaaba"></i> Booking Saya</a>
<a class="nav-link" href="/user/documents"><i class="fa-solid fa-file-invoice"></i> Dokumen</a>
<a class="nav-link active" href="/user/payments"><i class="fa-solid fa-credit-card"></i> Riwayat Bayar</a>

<div class="nav-section">Layanan</div>
<a class="nav-link" href="/katalog"><i class="fa-solid fa-search"></i> Cari Paket</a>
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>Riwayat Pembayaran<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card-section">
    <h6><i class="fa-solid fa-history mr-2" style="color:#d4af37;"></i>Daftar Pembayaran</h6>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Paket</th>
                    <th>Metode</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($bookings)): foreach ($bookings as $b): ?>
                <tr>
                    <td><strong><?= esc($b['booking_code']) ?></strong></td>
                    <td><?= esc($b['nama_paket']) ?></td>
                    <td><?= esc($b['payment_method'] ?: '-') ?></td>
                    <td>Rp <?= number_format($b['total_price'], 0, ',', '.') ?></td>
                    <td>
                        <?php if ($b['payment_status'] === 'success'): ?>
                            <span class="badge badge-success px-3 py-2" style="border-radius:20px;">Berhasil</span>
                        <?php elseif ($b['payment_status'] === 'pending'): ?>
                            <span class="badge badge-warning px-3 py-2" style="border-radius:20px;">Menunggu</span>
                        <?php else: ?>
                            <span class="badge badge-danger px-3 py-2" style="border-radius:20px;">Gagal</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $b['transaction_time'] ? date('d/m/Y H:i', strtotime($b['transaction_time'])) : '-' ?></td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada riwayat pembayaran.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
