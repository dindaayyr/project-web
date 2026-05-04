<?= $this->extend('layouts/admin') ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">Menu Agen</div>
<a class="nav-link" href="/agent/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link" href="/agent/jamaah"><i class="fa-solid fa-users"></i> Data Jamaah</a>
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>Edit Data Jamaah<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card-section shadow-sm">
            <h6 class="font-weight-bold mb-4 text-emerald"><i class="fa fa-user-edit mr-2"></i>Update Kontak Jamaah</h6>
            
            <form action="/agent/jamaah/update/<?= $user['id'] ?>" method="POST">
                <div class="form-group">
                    <label class="small font-weight-bold text-muted">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="<?= esc($user['name']) ?>" required>
                </div>
                <div class="form-group">
                    <label class="small font-weight-bold text-muted">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= esc($user['email']) ?>" required>
                </div>
                <div class="form-group">
                    <label class="small font-weight-bold text-muted">Nomor Telepon/WA</label>
                    <input type="text" name="phone" class="form-control" value="<?= esc($user['phone']) ?>" required>
                </div>

                <hr class="my-4">
                
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/agent/jamaah" class="text-muted small font-weight-bold">Kembali</a>
                    <button type="submit" class="btn btn-emerald px-5" style="border-radius:10px;">Simpan Perubahan</button>
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
