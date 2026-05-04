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
        <h6 class="mb-0 font-weight-bold text-dark"><i class="fa-solid fa-ticket-alt mr-2 text-emerald"></i>Riwayat Booking Jamaah</h6>
        <a href="/agent/bookings/create" class="btn btn-emerald btn-sm px-4 shadow-sm" style="border-radius:10px;">
            <i class="fa fa-plus mr-1"></i> Tambah Booking Manual
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="bg-light">
                <tr>
                    <th>Kode</th>
                    <th>Jamaah</th>
                    <th>Paket</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($bookings)): foreach ($bookings as $b): ?>
                <tr>
                    <td><strong><?= esc($b['booking_code']) ?></strong></td>
                    <td>
                        <div class="font-weight-bold"><?= esc($b['user_name']) ?></div>
                        <small class="text-muted"><?= esc($b['user_phone'] ?? '-') ?></small>
                    </td>
                    <td><small><?= esc($b['package_name']) ?></small></td>
                    <td><small class="font-weight-bold">Rp <?= number_format($b['total_price'], 0, ',', '.') ?></small></td>
                    <td>
                        <span class="badge badge-<?= $b['status'] === 'lunas' ? 'lunas' : ($b['status'] === 'pending' ? 'pending' : 'cancelled') ?> px-3 py-1" style="border-radius:8px;">
                            <?= ucfirst($b['status']) ?>
                        </span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="/agent/bookings/edit/<?= $b['id'] ?>" class="btn btn-sm btn-outline-emerald" title="Edit/Update Status">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="/agent/bookings/delete/<?= $b['id'] ?>" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Hapus booking ini?')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada pemesanan masuk.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
