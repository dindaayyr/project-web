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
                        <th>Status Pembayaran</th>
                        <th>Bukti Transfer</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($bookings)): ?>
                        <?php foreach ($bookings as $booking): ?>
                            <tr>
                                <td><span class="font-weight-bold"><?= esc($booking['booking_code']) ?></span></td>
                                <td><?= esc($booking['package_name']) ?></td>
                                <td>Rp <?= number_format($booking['total_price'], 0, ',', '.') ?></td>
                                <td>
                                    <?php
                                        $paymentStatus = [
                                            'pending'   => ['Belum Bayar', 'badge-pending'],
                                            'verified'  => ['Terverifikasi', 'badge-verified'],
                                            'completed' => ['Lunas', 'badge-completed'],
                                            'cancelled' => ['Dibatalkan', 'badge-cancelled'],
                                        ];
                                        $status = $paymentStatus[$booking['status']] ?? ['Pending', 'badge-pending'];
                                    ?>
                                    <span class="badge-status <?= $status[1] ?>"><?= $status[0] ?></span>
                                </td>
                                <td>
                                    <?php if ($booking['payment_proof']): ?>
                                        <a href="#" class="text-success small"><i class="fa fa-file-image mr-1"></i>Lihat</a>
                                    <?php else: ?>
                                        <span class="text-muted small">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($booking['status'] === 'pending'): ?>
                                        <button class="btn btn-sm px-3" style="background: var(--gold-accent); color: var(--emerald-dark); border-radius: 8px; font-weight: 600; font-size: 0.8rem;">
                                            <i class="fa fa-upload mr-1"></i> Upload Bukti
                                        </button>
                                    <?php else: ?>
                                        <span class="text-muted small">-</span>
                                    <?php endif; ?>
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
