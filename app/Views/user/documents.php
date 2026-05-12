<?= $this->extend('layouts/admin') ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">Menu Jamaah</div>
<a class="nav-link" href="/user/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link" href="/user/bookings"><i class="fa-solid fa-kaaba"></i> Booking Saya</a>
<a class="nav-link active" href="/user/documents"><i class="fa-solid fa-file-invoice"></i> Dokumen</a>
<a class="nav-link" href="/user/payments"><i class="fa-solid fa-credit-card"></i> Riwayat Bayar</a>

<div class="nav-section">Layanan</div>
<a class="nav-link" href="/katalog"><i class="fa-solid fa-search"></i> Cari Paket</a>
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>Dokumen Perjalanan<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="alert alert-warning" style="border-radius:12px; border:none; background:#fff8e1; color:#f57c00;">
    <i class="fa-solid fa-circle-exclamation mr-2"></i>
    Mohon lengkapi dokumen di bawah ini untuk proses administrasi keberangkatan Anda.
</div>

<form action="/user/documents/upload" method="POST" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card-section h-100">
                <h6><i class="fa-solid fa-passport mr-2" style="color:#d4af37;"></i>Paspor & Identitas</h6>
                <ul class="list-group list-group-flush mt-3">
                    <!-- PASPOR -->
                    <li class="list-group-item bg-transparent px-0 border-light pb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <div class="font-weight-bold">Scan Paspor</div>
                                <small class="text-muted">Format: JPG/PDF, Max 2MB</small>
                            </div>
                            <?php if (isset($docs['paspor'])): ?>
                                <span class="badge badge-<?= $docs['paspor']['status'] === 'verified' ? 'success' : ($docs['paspor']['status'] === 'rejected' ? 'danger' : 'warning') ?> px-2 py-1">
                                    <?= ucfirst($docs['paspor']['status']) ?>
                                </span>
                            <?php else: ?>
                                <span class="badge badge-danger px-2 py-1">Belum Upload</span>
                            <?php endif; ?>
                        </div>
                        <div class="custom-file custom-file-sm">
                            <input type="file" name="paspor" class="custom-file-input" id="inputPaspor" accept=".jpg,.jpeg,.png,.pdf">
                            <label class="custom-file-label" for="inputPaspor">Pilih file paspor...</label>
                        </div>
                        <?php if (isset($docs['paspor'])): ?>
                            <small class="text-primary mt-1 d-block"><i class="fa fa-eye mr-1"></i> <a href="/<?= $docs['paspor']['file_path'] ?>" target="_blank">Lihat file saat ini</a></small>
                        <?php endif; ?>
                    </li>

                    <!-- KTP -->
                    <li class="list-group-item bg-transparent px-0 border-light pb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <div class="font-weight-bold">Scan KTP</div>
                                <small class="text-muted">Format: JPG, Max 1MB</small>
                            </div>
                            <?php if (isset($docs['ktp'])): ?>
                                <span class="badge badge-<?= $docs['ktp']['status'] === 'verified' ? 'success' : ($docs['ktp']['status'] === 'rejected' ? 'danger' : 'warning') ?> px-2 py-1">
                                    <?= ucfirst($docs['ktp']['status']) ?>
                                </span>
                            <?php else: ?>
                                <span class="badge badge-danger px-2 py-1">Belum Upload</span>
                            <?php endif; ?>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="ktp" class="custom-file-input" id="inputKTP" accept=".jpg,.jpeg,.png">
                            <label class="custom-file-label" for="inputKTP">Pilih file KTP...</label>
                        </div>
                        <?php if (isset($docs['ktp'])): ?>
                            <small class="text-primary mt-1 d-block"><i class="fa fa-eye mr-1"></i> <a href="/<?= $docs['ktp']['file_path'] ?>" target="_blank">Lihat file saat ini</a></small>
                        <?php endif; ?>
                    </li>

                    <!-- FOTO -->
                    <li class="list-group-item bg-transparent px-0 border-light pb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <div class="font-weight-bold">Foto 4x6 (Background Putih)</div>
                                <small class="text-muted">Format: JPG, Max 1MB</small>
                            </div>
                            <?php if (isset($docs['foto'])): ?>
                                <span class="badge badge-<?= $docs['foto']['status'] === 'verified' ? 'success' : ($docs['foto']['status'] === 'rejected' ? 'danger' : 'warning') ?> px-2 py-1">
                                    <?= ucfirst($docs['foto']['status']) ?>
                                </span>
                            <?php else: ?>
                                <span class="badge badge-danger px-2 py-1">Belum Upload</span>
                            <?php endif; ?>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="foto" class="custom-file-input" id="inputFoto" accept=".jpg,.jpeg,.png">
                            <label class="custom-file-label" for="inputFoto">Pilih file foto...</label>
                        </div>
                        <?php if (isset($docs['foto'])): ?>
                            <small class="text-primary mt-1 d-block"><i class="fa fa-eye mr-1"></i> <a href="/<?= $docs['foto']['file_path'] ?>" target="_blank">Lihat file saat ini</a></small>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card-section h-100">
                <h6><i class="fa-solid fa-notes-medical mr-2" style="color:#d4af37;"></i>Kesehatan & Vaksin</h6>
                <ul class="list-group list-group-flush mt-3">
                    <!-- MENINGITIS -->
                    <li class="list-group-item bg-transparent px-0 border-light pb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <div class="font-weight-bold">Sertifikat Vaksin Meningitis</div>
                                <small class="text-muted">Wajib untuk visa umroh</small>
                            </div>
                            <?php if (isset($docs['meningitis'])): ?>
                                <span class="badge badge-<?= $docs['meningitis']['status'] === 'verified' ? 'success' : ($docs['meningitis']['status'] === 'rejected' ? 'danger' : 'warning') ?> px-2 py-1">
                                    <?= ucfirst($docs['meningitis']['status']) ?>
                                </span>
                            <?php else: ?>
                                <span class="badge badge-danger px-2 py-1">Belum Upload</span>
                            <?php endif; ?>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="meningitis" class="custom-file-input" id="inputMeningitis" accept=".jpg,.jpeg,.png,.pdf">
                            <label class="custom-file-label" for="inputMeningitis">Pilih file sertifikat...</label>
                        </div>
                        <?php if (isset($docs['meningitis'])): ?>
                            <small class="text-primary mt-1 d-block"><i class="fa fa-eye mr-1"></i> <a href="/<?= $docs['meningitis']['file_path'] ?>" target="_blank">Lihat file saat ini</a></small>
                        <?php endif; ?>
                    </li>
                </ul>
                
                <div class="mt-auto">
                    <button type="submit" class="btn btn-primary btn-block mt-4" style="border-radius:12px; height:50px; font-weight:600; background:linear-gradient(135deg, #004d40 0%, #00695c 100%); border:none; box-shadow: 0 4px 15px rgba(0,77,64,0.3);">
                        <i class="fa-solid fa-cloud-arrow-up mr-2"></i> Simpan & Unggah Dokumen
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    // Update label with filename
    document.querySelectorAll('.custom-file-input').forEach(input => {
        input.addEventListener('change', function(e) {
            var fileName = e.target.files[0].name;
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
    });
</script>
<?= $this->endSection() ?>
