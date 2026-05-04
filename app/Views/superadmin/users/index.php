<?= $this->extend('layouts/admin') ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">Super Admin</div>
<a class="nav-link" href="/superadmin/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link" href="/superadmin/agents"><i class="fa-solid fa-building"></i> Agen Travel</a>
<a class="nav-link <?= ($role ?? '') === 'jamaah' ? 'active' : '' ?>" href="/superadmin/users?role=jamaah"><i class="fa-solid fa-users"></i> Data Jamaah</a>
<a class="nav-link <?= empty($role) ? 'active' : '' ?>" href="/superadmin/users"><i class="fa-solid fa-user-shield"></i> Manajemen User</a>
<a class="nav-link" href="/superadmin/packages"><i class="fa-solid fa-box"></i> Semua Paket</a>
<a class="nav-link" href="/superadmin/transactions"><i class="fa-solid fa-file-invoice-dollar"></i> Transaksi</a>
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>Manajemen User & Jamaah<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card-section">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="mb-0 font-weight-bold text-dark"><i class="fa-solid fa-users mr-2 text-emerald"></i>Seluruh Pengguna Sistem</h6>
        
        <form action="/superadmin/users" method="GET" class="d-flex align-items-center">
            <div class="input-group input-group-sm mr-2" style="width: 250px;">
                <input type="text" name="search" class="form-control" placeholder="Cari nama, email, hp..." value="<?= esc($search ?? '') ?>" style="border-radius: 8px 0 0 8px;">
                <div class="input-group-append">
                    <button class="btn btn-emerald" type="submit" style="border-radius: 0 8px 8px 0;">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            
            <select name="role" class="form-control form-control-sm" style="width: 150px; border-radius: 8px;" onchange="this.form.submit()">
                <option value="">Semua Role</option>
                <option value="jamaah" <?= ($role ?? '') === 'jamaah' ? 'selected' : '' ?>>Jamaah</option>
                <option value="agent" <?= ($role ?? '') === 'agent' ? 'selected' : '' ?>>Agent</option>
                <option value="finance" <?= ($role ?? '') === 'finance' ? 'selected' : '' ?>>Finance</option>
                <option value="superadmin" <?= ($role ?? '') === 'superadmin' ? 'selected' : '' ?>>SuperAdmin</option>
            </select>

            <?php if (!empty($search) || !empty($role)): ?>
                <a href="/superadmin/users" class="btn btn-sm btn-link text-danger ml-2" title="Reset Filter">
                    <i class="fa fa-times-circle"></i>
                </a>
            <?php endif; ?>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="bg-light">
                <tr>
                    <th>User</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($users)): foreach ($users as $u): ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($u['name']) ?>&background=random" class="rounded-circle mr-3" width="36" height="36">
                            <div class="font-weight-bold"><?= esc($u['name']) ?></div>
                        </div>
                    </td>
                    <td><small><?= esc($u['email']) ?></small></td>
                    <td><small><?= esc($u['phone']) ?></small></td>
                    <td>
                        <span class="badge badge-outline-secondary px-2 py-1" style="border-radius:6px; font-size:0.7rem; border: 1px solid #ddd;">
                            <?= strtoupper($u['role']) ?>
                        </span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="/superadmin/users/edit/<?= $u['id'] ?>" class="btn btn-sm btn-outline-emerald" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            <?php if ($u['id'] != session()->get('user_id')): ?>
                            <a href="/superadmin/users/delete/<?= $u['id'] ?>" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Hapus user ini?')">
                                <i class="fa fa-trash"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="5" class="text-center text-muted py-4">Belum ada pengguna.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
