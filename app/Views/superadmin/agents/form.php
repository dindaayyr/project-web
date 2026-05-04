<?= $this->extend('layouts/admin') ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">Super Admin</div>
<a class="nav-link" href="/superadmin/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link active" href="/superadmin/agents"><i class="fa-solid fa-building"></i> Agen Travel</a>
<a class="nav-link" href="/superadmin/users"><i class="fa-solid fa-users"></i> User & Jamaah</a>
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>Edit Agen Travel<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-section">
            <h6 class="font-weight-bold mb-4 text-emerald"><i class="fa fa-edit mr-2"></i>Edit Informasi Agen</h6>
            
            <form action="/superadmin/agents/update/<?= $agent['id'] ?>" method="POST">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label class="small font-weight-bold text-muted">Nama Perusahaan</label>
                        <input type="text" name="name" class="form-control" value="<?= esc($agent['name']) ?>" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="small font-weight-bold text-muted">No. PPIU/PIHK</label>
                        <input type="text" name="ppiu_number" class="form-control" value="<?= esc($agent['ppiu_number']) ?>" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="small font-weight-bold text-muted">Status Akun</label>
                        <select name="status" class="form-control" required>
                            <option value="pending" <?= ($agent['status']??'')==='pending'?'selected':'' ?>>Pending (Verifikasi)</option>
                            <option value="active" <?= ($agent['status']??'')==='active'?'selected':'' ?>>Active (Aktif)</option>
                            <option value="inactive" <?= ($agent['status']??'')==='inactive'?'selected':'' ?>>Inactive (Nonaktif)</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="small font-weight-bold text-muted">Kota</label>
                        <input type="text" name="city" class="form-control" value="<?= esc($agent['city']) ?>" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="small font-weight-bold text-muted">Telepon/WA</label>
                        <input type="text" name="phone" class="form-control" value="<?= esc($agent['phone']) ?>" required>
                    </div>
                    <div class="col-12 form-group">
                        <label class="small font-weight-bold text-muted">Alamat Lengkap</label>
                        <textarea name="address" class="form-control" rows="3" required><?= esc($agent['address']) ?></textarea>
                    </div>
                </div>

                <hr class="my-4">
                
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/superadmin/agents" class="text-muted small font-weight-bold">Kembali</a>
                    <button type="submit" class="btn btn-emerald px-5" style="border-radius:10px;">Simpan Perubahan</button>
                </div>
            </form>
        </div>

        <?php if (!empty($agent['npwp_file']) || !empty($agent['legal_file'])): ?>
        <div class="card-section mt-4">
            <h6 class="font-weight-bold mb-3 small text-muted">Dokumen Legalitas</h6>
            <div class="row">
                <?php if (!empty($agent['npwp_file'])): ?>
                <div class="col-md-6 mb-2">
                    <a href="<?= $agent['npwp_file'] ?>" target="_blank" class="btn btn-sm btn-block btn-outline-secondary">Lihat NPWP</a>
                </div>
                <?php endif; ?>
                <?php if (!empty($agent['legal_file'])): ?>
                <div class="col-md-6 mb-2">
                    <a href="<?= $agent['legal_file'] ?>" target="_blank" class="btn btn-sm btn-block btn-outline-secondary">Lihat Akta/Izin</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .btn-emerald { background-color: #047857; color: white; border: none; }
    .btn-emerald:hover { background-color: #065f46; color: white; }
    .form-control { border-radius: 8px; border: 1px solid #e2e8f0; padding: 10px 15px; }
</style>
<?= $this->endSection() ?>
