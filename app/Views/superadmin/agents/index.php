<?= $this->extend('layouts/admin') ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">Super Admin</div>
<a class="nav-link" href="/superadmin/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link active" href="/superadmin/agents"><i class="fa-solid fa-building"></i> Agen Travel</a>
<a class="nav-link" href="/superadmin/users?role=jamaah"><i class="fa-solid fa-users"></i> Data Jamaah</a>
<a class="nav-link" href="/superadmin/users"><i class="fa-solid fa-user-shield"></i> Manajemen User</a>
<a class="nav-link" href="/superadmin/packages"><i class="fa-solid fa-box"></i> Semua Paket</a>
<a class="nav-link" href="/superadmin/transactions"><i class="fa-solid fa-file-invoice-dollar"></i> Transaksi</a>
<a class="nav-link" href="/superadmin/ai-config"><i class="fa-solid fa-robot"></i> Konfigurasi AI</a>
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>Manajemen Agen Travel<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card-section">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="mb-0 font-weight-bold text-dark"><i class="fa-solid fa-building mr-2 text-emerald"></i>Daftar Seluruh Agen</h6>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="bg-light">
                <tr>
                    <th>Info Agen</th>
                    <th>Kontak</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($agents)): foreach ($agents as $a): ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="<?= $a['logo'] ?? 'https://ui-avatars.com/api/?name='.urlencode($a['name']) ?>" class="rounded mr-3" width="40" height="40" style="object-fit:cover;">
                            <div>
                                <div class="font-weight-bold"><?= esc($a['name']) ?></div>
                                <small class="text-muted"><?= esc($a['ppiu_number'] ?? 'Tanpa PPIU') ?></small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="small font-weight-bold"><?= esc($a['email']) ?></div>
                        <div class="small text-muted"><?= esc($a['phone']) ?></div>
                    </td>
                    <td><small><?= esc($a['city'] ?? '-') ?></small></td>
                    <td>
                        <span class="badge badge-<?= ($a['status']??'')==='active'?'lunas':(($a['status']??'')==='pending'?'pending':'cancelled') ?> px-3 py-1" style="border-radius:8px;">
                            <?= ucfirst($a['status'] ?? 'pending') ?>
                        </span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <?php if (($a['status']??'') === 'pending'): ?>
                                <a href="/superadmin/agents/verify/<?= $a['id'] ?>" class="btn btn-sm btn-success" title="Verifikasi" onclick="return confirm('Verifikasi agen ini?')">
                                    <i class="fa fa-check"></i>
                                </a>
                            <?php endif; ?>
                            <a href="/superadmin/agents/edit/<?= $a['id'] ?>" class="btn btn-sm btn-outline-emerald" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="/superadmin/agents/delete/<?= $a['id'] ?>" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Hapus agen ini? Seluruh akun terkait akan ikut terhapus.')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="5" class="text-center text-muted py-4">Belum ada agen terdaftar.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
