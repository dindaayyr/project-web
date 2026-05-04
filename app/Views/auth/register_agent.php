<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <div class="row no-gutters">
                    <!-- Left Side: Info -->
                    <div class="col-md-4 d-none d-md-flex flex-column justify-content-center p-5 text-white" style="background: linear-gradient(135deg, #064e3b 0%, #047857 100%);">
                        <h2 class="font-weight-bold mb-4">Mari Bergabung!</h2>
                        <p class="lead mb-5" style="font-size: 1rem; opacity: 0.9;">Daftarkan Travel Umroh Anda dan jangkau ribuan jamaah di seluruh Indonesia melalui platform UmrohQueens.</p>
                        
                        <div class="d-flex align-items-center mb-4">
                            <div class="rounded-circle bg-white text-emerald d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px; color: #047857;">
                                <i class="fa fa-check"></i>
                            </div>
                            <span>Verifikasi Cepat</span>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <div class="rounded-circle bg-white text-emerald d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px; color: #047857;">
                                <i class="fa fa-check"></i>
                            </div>
                            <span>Dashboard Mandiri</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-white text-emerald d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px; color: #047857;">
                                <i class="fa fa-check"></i>
                            </div>
                            <span>AI Integrated Search</span>
                        </div>
                    </div>

                    <!-- Right Side: Form -->
                    <div class="col-md-8 p-4 p-md-5 bg-white">
                        <div class="text-center mb-4">
                            <h3 class="font-weight-bold text-dark">Registrasi Mitra Agen</h3>
                            <p class="text-muted">Lengkapi data berikut untuk pengajuan kemitraan</p>
                        </div>

                        <?php if (session()->getFlashdata('errors')): ?>
                            <div class="alert alert-danger" style="border-radius: 10px;">
                                <ul class="mb-0 small">
                                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                        <li><?= $error ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form action="/register-agent" method="POST" enctype="multipart/form-data">
                            <!-- Bagian 1: Identitas Perusahaan -->
                            <div class="mb-4">
                                <h6 class="text-emerald font-weight-bold mb-3"><i class="fa fa-building mr-2"></i> Identitas Perusahaan</h6>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="small font-weight-bold">Nama Travel/Perusahaan</label>
                                        <input type="text" name="name" class="form-control" value="<?= old('name') ?>" required placeholder="PT. Travel Amanah">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="small font-weight-bold">Nomor Izin PPIU/PIHK</label>
                                        <input type="text" name="ppiu_number" class="form-control" value="<?= old('ppiu_number') ?>" required placeholder="PPIU/123/2024">
                                    </div>
                                    <div class="col-12 form-group">
                                        <label class="small font-weight-bold">Alamat Kantor Pusat</label>
                                        <textarea name="address" class="form-control" rows="2" required placeholder="Jl. Raya Utama No. 1..."><?= old('address') ?></textarea>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="small font-weight-bold">Kota</label>
                                        <input type="text" name="city" class="form-control" value="<?= old('city') ?>" required placeholder="Jakarta">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="small font-weight-bold">Nomor Telepon/WA Bisnis</label>
                                        <input type="text" name="phone" class="form-control" value="<?= old('phone') ?>" required placeholder="08123456789">
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Bagian 2: Dokumen Legalitas -->
                            <div class="mb-4">
                                <h6 class="text-emerald font-weight-bold mb-3"><i class="fa fa-file-contract mr-2"></i> Dokumen Legalitas</h6>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="small font-weight-bold">Scan NPWP Perusahaan</label>
                                        <input type="file" name="npwp_file" class="form-control-file" required>
                                        <small class="text-muted">PDF/JPG/PNG (Maks 2MB)</small>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="small font-weight-bold">Scan Akta / Izin Kemenag</label>
                                        <input type="file" name="legal_file" class="form-control-file" required>
                                        <small class="text-muted">PDF/JPG/PNG (Maks 2MB)</small>
                                    </div>
                                    <div class="col-12 form-group mt-2">
                                        <label class="small font-weight-bold">Logo Perusahaan</label>
                                        <input type="file" name="logo" class="form-control-file" required>
                                        <small class="text-muted">Format PNG/JPG square diutamakan</small>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Bagian 3: Akun Dashboard Agen -->
                            <div class="mb-4">
                                <h6 class="text-emerald font-weight-bold mb-3"><i class="fa fa-user-lock mr-2"></i> Akun Dashboard Agen</h6>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label class="small font-weight-bold">Email Resmi (Login ID)</label>
                                        <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required placeholder="admin@travel.com">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="small font-weight-bold">Kata Sandi</label>
                                        <input type="password" name="password" class="form-control" required placeholder="******">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="small font-weight-bold">Konfirmasi Sandi</label>
                                        <input type="password" name="password_confirm" class="form-control" required placeholder="******">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5">
                                <button type="submit" class="btn btn-emerald btn-block py-3 font-weight-bold shadow-sm" style="border-radius: 12px; font-size: 1.1rem; background: #047857; border: none; color: white;">
                                    Ajukan Pendaftaran Mitra
                                </button>
                                <p class="text-center mt-3 small">Sudah punya akun? <a href="/login" class="text-emerald font-weight-bold">Masuk di sini</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .text-emerald { color: #047857; }
    .btn-emerald:hover { background: #065f46 !important; transform: translateY(-2px); transition: all 0.2s; }
    .form-control { border-radius: 10px; padding: 12px 15px; border: 1px solid #e2e8f0; }
    .form-control:focus { border-color: #047857; box-shadow: 0 0 0 0.2rem rgba(4, 120, 87, 0.15); }
    hr { border-top: 1px solid #f1f5f9; margin: 2rem 0; }
</style>
<?= $this->endSection() ?>
