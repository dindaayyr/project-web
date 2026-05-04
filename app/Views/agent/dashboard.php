<?= $this->extend('layouts/admin') ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">Menu Agen</div>
<a class="nav-link active" href="/agent/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link" href="/agent/packages"><i class="fa-solid fa-box"></i> Kelola Paket</a>
<a class="nav-link" href="/agent/jamaah"><i class="fa-solid fa-users"></i> Data Jamaah</a>
<a class="nav-link" href="/agent/bookings"><i class="fa-solid fa-ticket-alt"></i> Pemesanan</a>
<a class="nav-link" href="/agent/disbursements"><i class="fa-solid fa-money-bill-wave"></i> Pencairan Dana</a>
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>Dashboard Agen<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Welcome Header -->
<div class="card-section mb-4" style="background: linear-gradient(90deg, #064e3b 0%, #047857 100%); color: white; border: none;">
    <div class="d-flex align-items-center">
        <div class="mr-4 d-none d-md-block">
            <img src="https://ui-avatars.com/api/?name=<?= urlencode(session()->get('user_name')) ?>&background=fff&color=064e3b&size=80" class="rounded-circle shadow" alt="Avatar">
        </div>
        <div>
            <h4 class="mb-1 font-weight-bold">Assalamu'alaikum, <?= esc(session()->get('user_name')) ?>!</h4>
            <p class="mb-0 opacity-75">Kelola paket umroh dan pantau jamaah Anda dengan mudah dalam satu dashboard.</p>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="stat-card shadow-sm h-100">
            <div class="stat-icon" style="background:rgba(4, 120, 87, 0.1); color:#047857;">
                <i class="fa-solid fa-box"></i>
            </div>
            <h3><?= $totalPackages ?></h3>
            <small>Total Paket</small>
            <div class="mt-2 text-muted small"><?= $activePackages ?> Paket Aktif</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card shadow-sm h-100">
            <div class="stat-icon" style="background:rgba(59, 130, 246, 0.1); color:#3b82f6;">
                <i class="fa-solid fa-users"></i>
            </div>
            <h3><?= $totalBookings ?></h3>
            <small>Total Jamaah</small>
            <div class="mt-2 text-muted small">Pemesanan Masuk</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card shadow-sm h-100">
            <div class="stat-icon" style="background:rgba(16, 185, 129, 0.1); color:#10b981;">
                <i class="fa-solid fa-wallet"></i>
            </div>
            <h3>Rp <?= number_format($totalRevenue, 0, ',', '.') ?></h3>
            <small>Total Omzet</small>
            <div class="mt-2 text-muted small">Dari Booking Lunas</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card shadow-sm h-100">
            <div class="stat-icon" style="background:rgba(245, 158, 11, 0.1); color:#f59e0b;">
                <i class="fa-solid fa-clock"></i>
            </div>
            <h3><?= count(array_filter($bookings, fn($b) => $b['status'] === 'pending')) ?></h3>
            <small>Pending</small>
            <div class="mt-2 text-muted small">Perlu Verifikasi</div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Bookings -->
    <div class="col-lg-8">
        <div class="card-section shadow-sm h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="mb-0 font-weight-bold text-dark"><i class="fa-solid fa-clock mr-2 text-emerald"></i>Booking Terbaru</h6>
                <a href="/agent/bookings" class="small text-emerald font-weight-bold">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th style="font-size: 0.75rem;">Jamaah</th>
                            <th style="font-size: 0.75rem;">Paket</th>
                            <th style="font-size: 0.75rem;">Status</th>
                            <th style="font-size: 0.75rem;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($bookings)): foreach ($bookings as $b): ?>
                        <tr>
                            <td>
                                <div class="font-weight-bold"><?= esc($b['user_name']) ?></div>
                                <small class="text-muted"><?= esc($b['booking_code']) ?></small>
                            </td>
                            <td><small><?= esc($b['package_name']) ?></small></td>
                            <td>
                                <span class="badge badge-<?= $b['status'] === 'lunas' ? 'lunas' : ($b['status'] === 'pending' ? 'pending' : 'cancelled') ?> px-2 py-1" style="border-radius:6px; font-size:0.75rem;">
                                    <?= ucfirst($b['status']) ?>
                                </span>
                            </td>
                            <td><small class="font-weight-bold">Rp <?= number_format($b['total_price'], 0, ',', '.') ?></small></td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="4" class="text-center text-muted py-4">Belum ada booking.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="card-section shadow-sm mb-4">
            <h6 class="font-weight-bold mb-3">Aksi Cepat</h6>
            <div class="list-group list-group-flush">
                <a href="/agent/packages/create" class="list-group-item list-group-item-action border-0 px-0 py-3 d-flex align-items-center">
                    <div class="rounded-circle bg-emerald-50 text-emerald d-flex align-items-center justify-content-center mr-3" style="width:36px; height:36px;">
                        <i class="fa fa-plus"></i>
                    </div>
                    <div>
                        <div class="font-weight-bold text-dark" style="font-size:0.9rem;">Buat Paket Baru</div>
                        <small class="text-muted">Tambah katalog umroh Anda</small>
                    </div>
                </a>
                <a href="/agent/disbursements" class="list-group-item list-group-item-action border-0 px-0 py-3 d-flex align-items-center">
                    <div class="rounded-circle bg-light text-primary d-flex align-items-center justify-content-center mr-3" style="width:36px; height:36px;">
                        <i class="fa fa-money-bill-wave"></i>
                    </div>
                    <div>
                        <div class="font-weight-bold text-dark" style="font-size:0.9rem;">Pencairan Dana</div>
                        <small class="text-muted">Tarik saldo hasil penjualan</small>
                    </div>
                </a>
            </div>
        </div>

        <div class="card-section shadow-sm" style="border-left: 4px solid var(--gold-accent);">
            <h6 class="font-weight-bold mb-2">Bantuan Support</h6>
            <p class="small text-muted mb-3">Butuh bantuan mengelola dashboard atau verifikasi paket?</p>
            <a href="https://wa.me/628123456789" class="btn btn-emerald btn-sm btn-block py-2" style="border-radius:8px;">
                <i class="fab fa-whatsapp mr-1"></i> Hubungi Admin
            </a>
        </div>
    </div>
</div>

<style>
    .opacity-75 { opacity: 0.75; }
    .text-emerald { color: #047857; }
    .bg-emerald-50 { background-color: #ecfdf5; }
    .btn-emerald { background-color: #047857; color: white; border: none; }
    .btn-emerald:hover { background-color: #065f46; color: white; }
</style>
<?= $this->endSection() ?>
