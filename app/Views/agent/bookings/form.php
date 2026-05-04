<?= $this->extend('layouts/admin') ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">Menu Agen</div>
<a class="nav-link" href="/agent/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link" href="/agent/bookings"><i class="fa-solid fa-ticket-alt"></i> Pemesanan</a>
<?= $this->endSection() ?>

<?= $this->section('page_title') ?><?= isset($booking) ? 'Edit Booking' : 'Tambah Booking Manual' ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card-section shadow-sm">
            <h6 class="font-weight-bold mb-4 text-emerald"><i class="fa <?= isset($booking) ? 'fa-edit' : 'fa-plus-circle' ?> mr-2"></i>Informasi Pemesanan</h6>
            
            <form action="/agent/bookings/<?= isset($booking) ? 'update/'.$booking['id'] : 'store' ?>" method="POST">
                <div class="row">
                    <?php if (!isset($booking)): ?>
                    <div class="col-md-12 form-group">
                        <label class="small font-weight-bold text-muted">Pilih Jamaah</label>
                        <select name="user_id" class="form-control" required>
                            <option value="">-- Pilih Jamaah Terdaftar --</option>
                            <?php foreach ($users as $u): ?>
                                <option value="<?= $u['id'] ?>"><?= esc($u['name']) ?> (<?= esc($u['email']) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-muted">Hanya jamaah yang sudah terdaftar di sistem.</small>
                    </div>

                    <div class="col-md-12 form-group">
                        <label class="small font-weight-bold text-muted">Pilih Paket Umroh</label>
                        <select name="package_id" class="form-control" required>
                            <option value="">-- Pilih Paket Anda --</option>
                            <?php foreach ($packages as $p): ?>
                                <option value="<?= $p['id_paket'] ?>"><?= esc($p['nama_paket']) ?> - Rp <?= number_format($p['harga_jual'], 0, ',', '.') ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php else: ?>
                    <div class="col-md-12 mb-4">
                        <div class="p-3 bg-light rounded">
                            <div class="small text-muted mb-1">Kode Booking: <strong><?= $booking['booking_code'] ?></strong></div>
                            <div class="small text-muted">Jamaah: <strong><?= esc($users[array_search($booking['user_id'], array_column($users, 'id'))]['name'] ?? 'N/A') ?></strong></div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="col-md-12 form-group">
                        <label class="small font-weight-bold text-muted">Status Pembayaran</label>
                        <select name="status" class="form-control" required>
                            <option value="pending" <?= (isset($booking) && $booking['status']=='pending') ? 'selected' : '' ?>>Pending (Menunggu Pembayaran)</option>
                            <option value="lunas" <?= (isset($booking) && $booking['status']=='lunas') ? 'selected' : '' ?>>Lunas (Terverifikasi)</option>
                            <option value="cancelled" <?= (isset($booking) && $booking['status']=='cancelled') ? 'selected' : '' ?>>Batal</option>
                        </select>
                    </div>
                </div>

                <hr class="my-4">
                
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/agent/bookings" class="text-muted small font-weight-bold">Batal</a>
                    <button type="submit" class="btn btn-emerald px-5 shadow-sm" style="border-radius:10px;">
                        <?= isset($booking) ? 'Update Status' : 'Buat Pesanan' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .btn-emerald { background-color: #047857; color: white; border: none; }
    .btn-emerald:hover { background-color: #065f46; color: white; }
    .form-control { border-radius: 8px; border: 1px solid #e2e8f0; padding: 10px 15px; }
</style>
<?= $this->endSection() ?>
