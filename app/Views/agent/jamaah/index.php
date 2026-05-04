<?= $this->extend('layouts/admin') ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">Menu Agen</div>
<a class="nav-link" href="/agent/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link" href="/agent/packages"><i class="fa-solid fa-box"></i> Kelola Paket</a>
<a class="nav-link active" href="/agent/jamaah"><i class="fa-solid fa-users"></i> Data Jamaah</a>
<a class="nav-link" href="/agent/bookings"><i class="fa-solid fa-ticket-alt"></i> Pemesanan</a>
<a class="nav-link" href="/agent/disbursements"><i class="fa-solid fa-money-bill-wave"></i> Pencairan Dana</a>
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>Data Jamaah Anda<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card-section">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <h6 class="mb-0 font-weight-bold text-dark"><i class="fa-solid fa-users mr-2 text-emerald"></i>Pelanggan / Jamaah Terdaftar</h6>
        
        <form action="/agent/jamaah" method="GET" class="d-flex flex-wrap align-items-center">
            <div class="input-group input-group-sm mr-2 mb-2 mb-md-0" style="width: 200px;">
                <input type="text" name="search" class="form-control" placeholder="Cari nama..." value="<?= esc($search ?? '') ?>" style="border-radius: 8px 0 0 8px;">
                <div class="input-group-append">
                    <button class="btn btn-emerald" type="submit" style="border-radius: 0 8px 8px 0;">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            
            <select name="package" class="form-control form-control-sm mr-2 mb-2 mb-md-0" style="width: 180px; border-radius: 8px;" onchange="this.form.submit()">
                <option value="">Semua Paket</option>
                <?php foreach ($packages as $p): ?>
                    <option value="<?= $p['id_paket'] ?>" <?= ($package_id ?? '') == $p['id_paket'] ? 'selected' : '' ?>>
                        <?= esc($p['nama_paket']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select name="status" class="form-control form-control-sm mr-2 mb-2 mb-md-0" style="width: 130px; border-radius: 8px;" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="pending" <?= ($status ?? '') === 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="lunas" <?= ($status ?? '') === 'lunas' ? 'selected' : '' ?>>Lunas</option>
                <option value="cancelled" <?= ($status ?? '') === 'cancelled' ? 'selected' : '' ?>>Batal</option>
            </select>

            <?php if (!empty($search) || !empty($package_id) || !empty($status)): ?>
                <a href="/agent/jamaah" class="btn btn-sm btn-link text-danger" title="Reset Filter">
                    <i class="fa fa-times-circle"></i>
                </a>
            <?php endif; ?>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="bg-light">
                <tr>
                    <th>Nama Jamaah</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($jamaah)): foreach ($jamaah as $j): ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($j['name']) ?>&background=047857&color=fff" class="rounded-circle mr-3" width="36" height="36">
                            <div class="font-weight-bold"><?= esc($j['name']) ?></div>
                        </div>
                    </td>
                    <td><small><?= esc($j['email']) ?></small></td>
                    <td><small><?= esc($j['phone']) ?></small></td>
                    <td>
                        <a href="/agent/jamaah/edit/<?= $j['id'] ?>" class="btn btn-sm btn-outline-emerald" title="Edit Profil Jamaah">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="4" class="text-center text-muted py-4">Belum ada jamaah yang memesan paket Anda.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
