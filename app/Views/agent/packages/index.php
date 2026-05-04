<?= $this->extend('layouts/admin') ?>
<?= $this->section('sidebar') ?>
<div class="nav-section">Menu Agen</div>
<a class="nav-link" href="/agent/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link active" href="/agent/packages"><i class="fa-solid fa-box"></i> Kelola Paket</a>
<a class="nav-link" href="/agent/jamaah"><i class="fa-solid fa-users"></i> Data Jamaah</a>
<a class="nav-link" href="/agent/bookings"><i class="fa-solid fa-ticket-alt"></i> Pemesanan</a>
<a class="nav-link" href="/agent/disbursements"><i class="fa-solid fa-money-bill-wave"></i> Pencairan Dana</a>
<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Kelola Paket<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="card-section">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="mb-0"><i class="fa-solid fa-box mr-2" style="color:var(--emerald);"></i>Daftar Paket</h6>
        <a href="/agent/packages/create" class="btn btn-sm text-white px-4" style="background:var(--emerald);border-radius:10px;"><i class="fa fa-plus mr-1"></i> Tambah Paket</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead><tr><th>Nama Paket</th><th>Harga</th><th>Berangkat</th><th>Maskapai</th><th>Kuota</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
            <?php if (!empty($packages)): foreach ($packages as $p): ?>
                <tr>
                    <td><strong><?= esc($p['nama_paket']) ?></strong></td>
                    <td>Rp <?= number_format($p['harga_jual'], 0, ',', '.') ?></td>
                    <td><?= $p['tanggal_berangkat'] ? date('d/m/Y', strtotime($p['tanggal_berangkat'])) : '-' ?></td>
                    <td><?= esc($p['maskapai'] ?? '-') ?></td>
                    <td><?= $p['available_seat'] ?>/<?= $p['total_seat'] ?></td>
                    <td><span class="badge px-3 py-1" style="border-radius:8px;background:<?= $p['status']==='active'?'#dcfce7':'#fee2e2' ?>;color:<?= $p['status']==='active'?'#166534':'#991b1b' ?>;"><?= ucfirst($p['status']) ?></span></td>
                    <td>
                        <a href="/agent/packages/edit/<?= $p['id'] ?>" class="btn btn-sm btn-outline-primary" style="border-radius:8px;"><i class="fa fa-edit"></i></a>
                        <a href="/agent/packages/delete/<?= $p['id'] ?>" class="btn btn-sm btn-outline-danger" style="border-radius:8px;" onclick="return confirm('Hapus paket ini?')"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="7" class="text-center text-muted py-4">Belum ada paket.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
