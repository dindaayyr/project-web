<?= $this->extend('layouts/user') ?>

<?= $this->section('content') ?>
<!-- Stats Row -->
<div class="row mb-4 animate__animated animate__fadeInUp">
    <div class="col-md-4 mb-3">
        <div class="card card-elegant stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="stat-label mb-1">Booking Aktif</p>
                    <h3 class="text-dark"><?= $activeBookings ?? 0 ?></h3>
                </div>
                <div class="stat-icon" style="background: var(--emerald-50); color: var(--emerald-dark);">
                    <i class="fa-solid fa-ticket"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card card-elegant stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="stat-label mb-1">Total Pemesanan</p>
                    <h3 class="text-dark"><?= count($bookings ?? []) ?></h3>
                </div>
                <div class="stat-icon" style="background: #ede9fe; color: #7c3aed;">
                    <i class="fa-solid fa-clipboard-list"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card card-elegant stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="stat-label mb-1">Total Pengeluaran</p>
                    <h3 class="text-dark" style="font-size: 1.2rem;">Rp <?= number_format($totalSpent ?? 0, 0, ',', '.') ?></h3>
                </div>
                <div class="stat-icon" style="background: rgba(212, 175, 55, 0.1); color: var(--gold-accent);">
                    <i class="fa-solid fa-wallet"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bookings Table -->
<div class="row animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
    <div class="col-lg-8 mb-4">
        <div class="card card-elegant">
            <div class="card-body p-0">
                <div class="d-flex justify-content-between align-items-center px-4 pt-4 pb-2">
                    <h6 class="font-weight-bold text-dark mb-0">Riwayat Pemesanan</h6>
                    <a href="/user/bookings" class="btn btn-sm btn-outline-dark px-3" style="border-radius: 8px;">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>ID Booking</th>
                                <th>Nama Paket</th>
                                <th>Berangkat</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($bookings)): ?>
                                <?php foreach ($bookings as $booking): ?>
                                    <tr>
                                        <td><span class="font-weight-bold"><?= esc($booking['booking_code']) ?></span></td>
                                        <td><?= esc($booking['package_name']) ?></td>
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
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="fa-solid fa-inbox fa-2x mb-2 d-block"></i>
                                        Belum ada pemesanan. <a href="/katalog" class="text-success font-weight-bold">Cari Paket</a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Recommended Packages Widget -->
    <div class="col-lg-4 mb-4">
        <div class="card card-elegant p-4">
            <h6 class="font-weight-bold text-dark mb-3">
                <i class="fa-solid fa-sparkles text-warning mr-1"></i> Rekomendasi Paket
            </h6>
            <p class="text-muted small mb-3">Berdasarkan aktivitas Anda sebelumnya</p>

            <?php if (!empty($recommended)): ?>
                <?php foreach ($recommended as $rec): ?>
                    <div class="recommend-card bg-white mb-3">
                        <img src="<?= esc($rec['image']) ?>" alt="<?= esc($rec['nama_paket']) ?>" loading="lazy">
                        <div class="p-3">
                            <small class="text-muted"><?= esc($rec['travel_name']) ?></small>
                            <h6 class="font-weight-bold mb-1" style="font-size: 0.85rem;"><?= esc($rec['nama_paket']) ?></h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="font-weight-bold small" style="color: var(--emerald-dark);">
                                    Rp <?= number_format($rec['harga_jual'], 0, ',', '.') ?>
                                </span>
                                <span class="small text-muted"><?= esc($rec['program_hari']) ?> hari</span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted small text-center py-3">Belum ada rekomendasi.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
