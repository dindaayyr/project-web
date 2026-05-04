<?= $this->extend('layouts/admin') ?>
<?= $this->section('sidebar') ?>
<div class="nav-section">Super Admin</div>
<a class="nav-link" href="/superadmin/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link active" href="/superadmin/agents"><i class="fa-solid fa-building"></i> Agen Travel</a>
<a class="nav-link" href="/superadmin/users"><i class="fa-solid fa-users"></i> Data Jamaah</a>
<a class="nav-link" href="/superadmin/packages"><i class="fa-solid fa-box"></i> Semua Paket</a>
<a class="nav-link" href="/superadmin/transactions"><i class="fa-solid fa-file-invoice-dollar"></i> Transaksi</a>
<a class="nav-link" href="/superadmin/ai-config"><i class="fa-solid fa-robot"></i> Konfigurasi AI</a>
<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Manajemen Agen Travel<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="card-section">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead><tr><th>Nama</th><th>No. PPIU</th><th>Kota</th><th>Email</th><th>Telepon</th><th>Status</th></tr></thead>
            <tbody>
            <?php if (!empty($agents)): foreach ($agents as $a): ?>
                <tr>
                    <td><strong><?= esc($a['name']) ?></strong></td>
                    <td><?= esc($a['ppiu_number'] ?? '-') ?></td>
                    <td><?= esc($a['city'] ?? '-') ?></td>
                    <td><?= esc($a['email'] ?? '-') ?></td>
                    <td><?= esc($a['phone'] ?? '-') ?></td>
                    <td><span class="badge px-3 py-1" style="border-radius:8px;background:<?= ($a['status']??'')=='active'?'#dcfce7':'#fef9c3'?>;color:<?= ($a['status']??'')=='active'?'#166534':'#854d0e'?>;"><?= ucfirst($a['status'] ?? 'pending') ?></span></td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada agen.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
