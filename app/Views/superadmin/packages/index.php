<?= $this->extend('layouts/admin') ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">Super Admin</div>
<a class="nav-link" href="/superadmin/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link" href="/superadmin/agents"><i class="fa-solid fa-building"></i> Agen Travel</a>
<a class="nav-link" href="/superadmin/users?role=jamaah"><i class="fa-solid fa-users"></i> Data Jamaah</a>
<a class="nav-link" href="/superadmin/users"><i class="fa-solid fa-user-shield"></i> Manajemen User</a>
<a class="nav-link active" href="/superadmin/packages"><i class="fa-solid fa-box"></i> Semua Paket</a>
<a class="nav-link" href="/superadmin/transactions"><i class="fa-solid fa-file-invoice-dollar"></i> Transaksi</a>
<a class="nav-link" href="/superadmin/ai-config"><i class="fa-solid fa-robot"></i> Konfigurasi AI</a>
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>Semua Paket (Global)<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card-section">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="mb-0 font-weight-bold" style="color:var(--emerald-dark);"><i class="fa-solid fa-box mr-2"></i>Daftar Seluruh Paket</h6>
        <a href="/superadmin/packages/create" class="btn btn-emerald btn-sm px-4 shadow-sm" style="border-radius:10px;">
            <i class="fa fa-plus mr-1"></i> Tambah Paket Baru
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="bg-light">
                <tr>
                    <th>Info Paket</th>
                    <th>Agen</th>
                    <th>Harga</th>
                    <th>Detail</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($packages)): foreach ($packages as $p): ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="<?= esc($p['image']) ?>" class="rounded mr-3" width="50" height="50" style="object-fit: cover;">
                            <div>
                                <div class="font-weight-bold text-dark"><?= esc($p['nama_paket']) ?></div>
                                <small class="text-muted"><i class="fa fa-plane mr-1"></i><?= esc($p['maskapai'] ?? '-') ?></small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-light p-2" style="font-weight:500;"><?= esc($p['travel_name']) ?></span>
                    </td>
                    <td>
                        <div class="font-weight-bold text-emerald">Rp <?= number_format($p['harga_jual'], 0, ',', '.') ?></div>
                    </td>
                    <td>
                        <small class="d-block"><strong><?= $p['program_hari'] ?></strong> Hari</small>
                        <small class="text-muted"><?= date('d/m/Y', strtotime($p['tanggal_berangkat'])) ?></small>
                    </td>
                    <td>
                        <span class="badge px-3 py-1" style="border-radius:20px; background:<?= $p['status']==='active'?'#dcfce7':'#fee2e2'?>; color:<?= $p['status']==='active'?'#166534':'#991b1b'?>;">
                            <?= ucfirst($p['status']) ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="btn-group shadow-sm" style="border-radius:8px; overflow:hidden;">
                            <a href="/superadmin/packages/edit/<?= $p['id'] ?>" class="btn btn-sm btn-white text-primary border-right" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="/superadmin/packages/delete/<?= $p['id'] ?>" class="btn btn-sm btn-white text-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus paket ini?')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="6" class="text-center text-muted py-5">
                    <i class="fa-solid fa-box-open d-block mb-2" style="font-size:2rem;opacity:0.3;"></i>
                    Belum ada paket yang terdaftar.
                </td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
