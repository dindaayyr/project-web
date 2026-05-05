<?= $this->extend('layouts/user') ?>

<?= $this->section('content') ?>
<div class="card card-elegant animate__animated animate__fadeInUp">
    <div class="card-body p-0">
        <div class="d-flex justify-content-between align-items-center px-4 pt-4 pb-2">
            <h6 class="font-weight-bold text-dark mb-0">Riwayat Pembayaran</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th>ID Booking</th>
                        <th>Nama Paket</th>
                        <th>Total Harga</th>
                        <th>Metode Bayar</th>
                        <th>Status Pembayaran</th>
                        <th>Waktu Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($bookings)): ?>
                        <?php foreach ($bookings as $booking): ?>
                            <tr>
                                <td><span class="font-weight-bold"><?= esc($booking['order_id']) ?></span></td>
                                <td><?= esc($booking['nama_paket']) ?></td>
                                <td>Rp <?= number_format($booking['total_price'], 0, ',', '.') ?></td>
                                <td><span class="small font-weight-bold text-uppercase"><?= esc($booking['payment_method'] ?? 'Online') ?></span></td>
                                <td>
                                    <?php
                                        $paymentStatus = [
                                            'pending'   => ['Menunggu', 'badge-pending'],
                                            'success'   => ['Lunas', 'badge-verified'],
                                            'failed'    => ['Gagal', 'badge-cancelled'],
                                            'expired'   => ['Kadaluarsa', 'badge-cancelled'],
                                        ];
                                        $status = $paymentStatus[$booking['payment_status']] ?? ['Pending', 'badge-pending'];
                                    ?>
                                    <span class="badge-status <?= $status[1] ?>"><?= $status[0] ?></span>
                                </td>
                                <td class="small text-muted">
                                    <?= $booking['transaction_time'] ? date('d M Y H:i', strtotime($booking['transaction_time'])) : '-' ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-credit-card fa-3x mb-3 d-block" style="color: #d1d5db;"></i>
                                <h6>Belum Ada Riwayat Pembayaran</h6>
                                <p class="small">Pembayaran akan muncul setelah Anda melakukan pemesanan.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
