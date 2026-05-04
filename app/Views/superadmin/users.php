<?= $this->extend('layouts/admin') ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">Super Admin</div>
<a class="nav-link" href="/superadmin/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link" href="/superadmin/agents"><i class="fa-solid fa-building"></i> Agen Travel</a>
<a class="nav-link active" href="/superadmin/users"><i class="fa-solid fa-users"></i> Data Jamaah</a>
<a class="nav-link" href="/superadmin/packages"><i class="fa-solid fa-box"></i> Semua Paket</a>
<a class="nav-link" href="/superadmin/transactions"><i class="fa-solid fa-file-invoice-dollar"></i> Transaksi</a>
<a class="nav-link" href="/superadmin/ai-config"><i class="fa-solid fa-robot"></i> Konfigurasi AI</a>
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>Manajemen Data Jamaah<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card-section">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Nomor HP</th>
                    <th>Terdaftar Pada</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($users)): foreach ($users as $u): ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mr-3" style="width:40px; height:40px; color:var(--emerald);">
                                <i class="fa fa-user"></i>
                            </div>
                            <strong><?= esc($u['name']) ?></strong>
                        </div>
                    </td>
                    <td><?= esc($u['email']) ?></td>
                    <td><?= esc($u['phone'] ?? '-') ?></td>
                    <td><?= date('d M Y', strtotime($u['created_at'])) ?></td>
                    <td><span class="badge badge-success px-3" style="border-radius:12px;">Active</span></td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="5" class="text-center text-muted py-4">Belum ada jamaah terdaftar.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
