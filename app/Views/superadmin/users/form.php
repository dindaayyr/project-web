<?= $this->extend('layouts/admin') ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">Super Admin</div>
<a class="nav-link" href="/superadmin/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link" href="/superadmin/agents"><i class="fa-solid fa-building"></i> Agen Travel</a>
<a class="nav-link active" href="/superadmin/users"><i class="fa-solid fa-users"></i> User & Jamaah</a>
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>Edit User<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card-section">
            <h6 class="font-weight-bold mb-4 text-emerald"><i class="fa fa-user-edit mr-2"></i>Edit Informasi User</h6>
            
            <form action="/superadmin/users/update/<?= $user['id'] ?>" method="POST">
                <div class="form-group">
                    <label class="small font-weight-bold text-muted">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="<?= esc($user['name']) ?>" required>
                </div>
                <div class="form-group">
                    <label class="small font-weight-bold text-muted">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= esc($user['email']) ?>" required>
                </div>
                <div class="form-group">
                    <label class="small font-weight-bold text-muted">Nomor Telepon</label>
                    <input type="text" name="phone" class="form-control" value="<?= esc($user['phone']) ?>" required>
                </div>
                <div class="form-group">
                    <label class="small font-weight-bold text-muted">Role / Hak Akses</label>
                    <select name="role" class="form-control" required>
                        <option value="jamaah" <?= $user['role']==='jamaah'?'selected':'' ?>>Jamaah</option>
                        <option value="agent" <?= $user['role']==='agent'?'selected':'' ?>>Agent Travel</option>
                        <option value="finance" <?= $user['role']==='finance'?'selected':'' ?>>Finance Admin</option>
                        <option value="superadmin" <?= $user['role']==='superadmin'?'selected':'' ?>>Super Admin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="small font-weight-bold text-muted">Password Baru (Opsional)</label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin diubah">
                    <small class="text-muted">Minimal 6 karakter.</small>
                </div>

                <hr class="my-4">
                
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/superadmin/users" class="text-muted small font-weight-bold">Kembali</a>
                    <button type="submit" class="btn btn-emerald px-5" style="border-radius:10px;">Simpan User</button>
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
