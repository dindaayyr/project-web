<?= $this->extend('layouts/user') ?>

<?= $this->section('content') ?>
<div class="card card-elegant animate__animated animate__fadeInUp">
    <div class="card-body p-4">
        <h6 class="font-weight-bold text-dark mb-4">Upload Dokumen Perjalanan</h6>
        <p class="text-muted small mb-4">Upload dokumen yang diperlukan untuk perjalanan umroh Anda. Pastikan semua dokumen jelas dan masih berlaku.</p>

        <div class="row">
            <!-- KTP -->
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm" style="border-radius: 14px;">
                    <div class="card-body text-center py-5">
                        <div class="mb-3" style="width: 70px; height: 70px; background: var(--emerald-50); border-radius: 16px; display: inline-flex; align-items: center; justify-content: center;">
                            <i class="fa-solid fa-id-card fa-2x" style="color: var(--emerald-dark);"></i>
                        </div>
                        <h6 class="font-weight-bold">KTP</h6>
                        <p class="text-muted small">Kartu Tanda Penduduk</p>
                        <span class="badge-status badge-pending mb-3 d-inline-block">Belum Upload</span>
                        <div>
                            <label for="uploadKtp" class="btn btn-sm px-4" style="background: var(--emerald-dark); color: #fff; border-radius: 10px; cursor: pointer;">
                                <i class="fa fa-upload mr-1"></i> Upload
                            </label>
                            <input type="file" id="uploadKtp" class="d-none" accept="image/*,.pdf">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Paspor -->
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm" style="border-radius: 14px;">
                    <div class="card-body text-center py-5">
                        <div class="mb-3" style="width: 70px; height: 70px; background: #ede9fe; border-radius: 16px; display: inline-flex; align-items: center; justify-content: center;">
                            <i class="fa-solid fa-passport fa-2x" style="color: #7c3aed;"></i>
                        </div>
                        <h6 class="font-weight-bold">Paspor</h6>
                        <p class="text-muted small">Passport (min. 7 bulan berlaku)</p>
                        <span class="badge-status badge-pending mb-3 d-inline-block">Belum Upload</span>
                        <div>
                            <label for="uploadPaspor" class="btn btn-sm px-4" style="background: var(--emerald-dark); color: #fff; border-radius: 10px; cursor: pointer;">
                                <i class="fa fa-upload mr-1"></i> Upload
                            </label>
                            <input type="file" id="uploadPaspor" class="d-none" accept="image/*,.pdf">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Foto -->
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm" style="border-radius: 14px;">
                    <div class="card-body text-center py-5">
                        <div class="mb-3" style="width: 70px; height: 70px; background: rgba(212,175,55,0.1); border-radius: 16px; display: inline-flex; align-items: center; justify-content: center;">
                            <i class="fa-solid fa-camera fa-2x" style="color: var(--gold-accent);"></i>
                        </div>
                        <h6 class="font-weight-bold">Pas Foto</h6>
                        <p class="text-muted small">4x6 background putih</p>
                        <span class="badge-status badge-pending mb-3 d-inline-block">Belum Upload</span>
                        <div>
                            <label for="uploadFoto" class="btn btn-sm px-4" style="background: var(--emerald-dark); color: #fff; border-radius: 10px; cursor: pointer;">
                                <i class="fa fa-upload mr-1"></i> Upload
                            </label>
                            <input type="file" id="uploadFoto" class="d-none" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert mt-3 border-0" style="background: #fef3c7; color: #92400e; border-radius: 12px;">
            <i class="fa fa-info-circle mr-2"></i>
            <strong>Catatan:</strong> Fitur upload dokumen akan aktif setelah integrasi backend file storage selesai.
        </div>
    </div>
</div>
<?= $this->endSection() ?>
