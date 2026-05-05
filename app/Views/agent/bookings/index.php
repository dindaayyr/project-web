<?= $this->extend('layouts/admin') ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">Menu Agen</div>
<a class="nav-link" href="/agent/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link" href="/agent/packages"><i class="fa-solid fa-box"></i> Kelola Paket</a>
<a class="nav-link" href="/agent/jamaah"><i class="fa-solid fa-users"></i> Data Jamaah</a>
<a class="nav-link active" href="/agent/bookings"><i class="fa-solid fa-ticket-alt"></i> Pemesanan</a>
<a class="nav-link" href="/agent/disbursements"><i class="fa-solid fa-money-bill-wave"></i> Pencairan Dana</a>
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>Kelola Pemesanan<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card-section">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="mb-0 font-weight-bold text-dark"><i class="fa-solid fa-ticket-alt mr-2" style="color:#004d40;"></i>Riwayat Booking Otomatis</h6>
        <div class="text-muted small">Dana masuk otomatis ke Platform Agregator</div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="bg-light">
                <tr>
                    <th>Order ID</th>
                    <th>Jamaah</th>
                    <th>Paket</th>
                    <th>Total</th>
                    <th>Pembayaran</th>
                    <th>Pencairan</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($bookings)): foreach ($bookings as $b): ?>
                <tr>
                    <td><strong><?= esc($b['order_id']) ?></strong></td>
                    <td>
                        <div class="font-weight-bold"><?= esc($b['jamaah_name']) ?></div>
                        <small class="text-muted"><?= esc($b['jamaah_phone'] ?? '-') ?></small>
                    </td>
                    <td>
                        <div class="small font-weight-bold"><?= esc($b['nama_paket']) ?></div>
                        <small class="text-muted">Berangkat: <?= date('d/m/Y', strtotime($b['tanggal_berangkat'])) ?></small>
                    </td>
                    <td><small class="font-weight-bold text-dark">Rp <?= number_format($b['total_price'], 0, ',', '.') ?></small></td>
                    <td>
                        <span class="badge badge-<?= $b['payment_status'] === 'success' ? 'lunas' : ($b['payment_status'] === 'pending' ? 'pending' : 'cancelled') ?> px-3 py-1" style="border-radius:8px;">
                            <?= ucfirst($b['payment_status']) ?>
                        </span>
                        <?php if($b['payment_method']): ?>
                            <div class="x-small text-muted mt-1" style="font-size: 0.7rem;"><?= strtoupper(esc($b['payment_method'])) ?></div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($b['settlement_status'] === 'processed'): ?>
                            <span class="badge badge-success px-2 py-1" style="border-radius: 5px; font-size: 0.7rem;">Sudah Dicairkan</span>
                        <?php else: ?>
                            <span class="badge badge-light px-2 py-1 text-muted" style="border-radius: 5px; font-size: 0.7rem;">Belum Cair (H-14)</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada pemesanan masuk dari sistem otomatis.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
