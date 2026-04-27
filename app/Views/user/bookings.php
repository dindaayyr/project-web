<?= $this->extend('layouts/user') ?>

<?= $this->section('content') ?>
<div class="card card-elegant animate__animated animate__fadeInUp">
    <div class="card-body p-0">
        <div class="d-flex justify-content-between align-items-center px-4 pt-4 pb-2">
            <h6 class="font-weight-bold text-dark mb-0">Semua Pemesanan</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th>ID Booking</th>
                        <th>Nama Paket</th>
                        <th>Travel</th>
                        <th>Tanggal Berangkat</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Tanggal Booking</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($bookings)): ?>
                        <?php foreach ($bookings as $booking): ?>
                            <tr>
                                <td><span class="font-weight-bold"><?= esc($booking['booking_code']) ?></span></td>
                                <td><?= esc($booking['package_name']) ?></td>
                                <td><span class="small text-muted"><?= esc($booking['travel_name']) ?></span></td>
                                <td><?= date('d M Y', strtotime($booking['departure_date'])) ?></td>
                                <td>Rp <?= number_format($booking['total_price'], 0, ',', '.') ?></td>
                                <td>
                                    <?php
                                        $statusClass = [
                                            'pending'   => 'badge-pending',
                                            'verified'  => 'badge-verified',
                                            'completed' => 'badge-completed',
                                            'cancelled' => 'badge-cancelled',
                                        ];
                                        $class = $statusClass[$booking['status']] ?? 'badge-pending';
                                    ?>
                                    <span class="badge-status <?= $class ?>"><?= ucfirst($booking['status']) ?></span>
                                </td>
                                <td class="small text-muted"><?= date('d M Y H:i', strtotime($booking['created_at'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-inbox fa-3x mb-3 d-block" style="color: #d1d5db;"></i>
                                <h6>Belum Ada Pemesanan</h6>
                                <p class="small">Mulai cari paket umroh yang sesuai dengan kebutuhan Anda.</p>
                                <a href="/katalog" class="btn btn-sm px-4" style="background: var(--emerald-dark); color: #fff; border-radius: 10px;">
                                    <i class="fa fa-search mr-1"></i> Cari Paket
                                </a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
