<?= $this->extend('layouts/admin') ?>
<?= $this->section('sidebar') ?>
<div class="nav-section">Super Admin</div>
<a class="nav-link" href="/superadmin/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link" href="/superadmin/agents"><i class="fa-solid fa-building"></i> Agen Travel</a>
<a class="nav-link active" href="/superadmin/packages"><i class="fa-solid fa-box"></i> Semua Paket</a>
<a class="nav-link" href="/superadmin/ai-config"><i class="fa-solid fa-robot"></i> Konfigurasi AI</a>
<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Semua Paket (Global)<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="card-section">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead><tr><th>Nama Paket</th><th>Agen</th><th>Harga</th><th>Hari</th><th>Maskapai</th><th>Berangkat</th><th>Kuota</th><th>Status</th></tr></thead>
            <tbody>
            <?php if (!empty($packages)): foreach ($packages as $p): ?>
                <tr>
                    <td><strong><?= esc($p['nama_paket']) ?></strong></td>
                    <td><?= esc($p['travel_name']) ?></td>
                    <td>Rp <?= number_format($p['harga_jual'], 0, ',', '.') ?></td>
                    <td><?= $p['program_hari'] ?> Hari</td>
                    <td><?= esc($p['maskapai'] ?? '-') ?></td>
                    <td><?= $p['tanggal_berangkat'] ? date('d/m/Y', strtotime($p['tanggal_berangkat'])) : '-' ?></td>
                    <td><?= $p['available_seat'] ?>/<?= $p['total_seat'] ?></td>
                    <td><span class="badge px-3 py-1" style="border-radius:8px;background:<?= $p['status']==='active'?'#dcfce7':'#fee2e2'?>;color:<?= $p['status']==='active'?'#166534':'#991b1b'?>;"><?= ucfirst($p['status']) ?></span></td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="8" class="text-center text-muted py-4">Belum ada paket.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
