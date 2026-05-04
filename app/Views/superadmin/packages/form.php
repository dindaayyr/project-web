<?= $this->extend('layouts/admin') ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">Super Admin</div>
<a class="nav-link" href="/superadmin/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link" href="/superadmin/agents"><i class="fa-solid fa-building"></i> Agen Travel</a>
<a class="nav-link" href="/superadmin/users"><i class="fa-solid fa-users"></i> Data Jamaah</a>
<a class="nav-link active" href="/superadmin/packages"><i class="fa-solid fa-box"></i> Semua Paket</a>
<a class="nav-link" href="/superadmin/transactions"><i class="fa-solid fa-file-invoice-dollar"></i> Transaksi</a>
<a class="nav-link" href="/superadmin/ai-config"><i class="fa-solid fa-robot"></i> Konfigurasi AI</a>
<?= $this->endSection() ?>

<?= $this->section('page_title') ?><?= $package ? 'Edit Paket' : 'Tambah Paket Baru' ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card-section">
    <div class="mb-4">
        <a href="/superadmin/packages" class="text-muted text-decoration-none small">
            <i class="fa fa-arrow-left mr-1"></i> Kembali ke Daftar Paket
        </a>
    </div>

    <form action="<?= $package ? '/superadmin/packages/update/' . $package['id_paket'] : '/superadmin/packages/store' ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
            <!-- Basic Information -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4" style="border-radius:15px;">
                    <div class="card-header bg-white font-weight-bold py-3" style="border-radius:15px 15px 0 0;">
                        Informasi Dasar
                    </div>
                    <div class="card-body">
                        <?php if (session()->getFlashdata('errors')): ?>
                            <div class="alert alert-danger">
                                <ul>
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="form-group mb-3">
                            <label class="font-weight-600">Nama Paket <span class="text-danger">*</span></label>
                            <input type="text" name="nama_paket" class="form-control" value="<?= old('nama_paket', $package['nama_paket'] ?? '') ?>" required placeholder="Contoh: Paket Umroh Ramadhan VIP">
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-600">Travel Agent <span class="text-danger">*</span></label>
                            <select name="travel_agent_id" class="form-control" required>
                                <option value="">Pilih Travel Agent</option>
                                <?php foreach ($agents as $agent): ?>
                                    <option value="<?= $agent['id'] ?>" <?= (old('travel_agent_id', $package['travel_agent_id'] ?? '') == $agent['id']) ? 'selected' : '' ?>>
                                        <?= esc($agent['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group mb-0">
                            <label class="font-weight-600">Deskripsi Paket</label>
                            <textarea name="description" class="form-control" rows="6" placeholder="Jelaskan detail paket, keunggulan, dll."><?= old('description', $package['description'] ?? '') ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4" style="border-radius:15px;">
                    <div class="card-header bg-white font-weight-bold py-3" style="border-radius:15px 15px 0 0;">
                        Detail Perjalanan & Hotel
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Hotel Madinah</label>
                                <input type="text" name="hotel_madinah" class="form-control" value="<?= old('hotel_madinah', $package['hotel_madinah'] ?? '') ?>" placeholder="Nama Hotel di Madinah">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Bintang Hotel (Madinah)</label>
                                <select name="bintang_madinah" class="form-control">
                                    <?php for($i=3; $i<=5; $i++): ?>
                                        <option value="<?= $i ?>" <?= (old('bintang_madinah', $package['bintang_madinah'] ?? 3) == $i) ? 'selected' : '' ?>><?= $i ?> Bintang</option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Hotel Mekkah</label>
                                <input type="text" name="hotel_mekkah" class="form-control" value="<?= old('hotel_mekkah', $package['hotel_mekkah'] ?? '') ?>" placeholder="Nama Hotel di Mekkah">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Bintang Hotel (Mekkah)</label>
                                <select name="bintang_mekkah" class="form-control">
                                    <?php for($i=3; $i<=5; $i++): ?>
                                        <option value="<?= $i ?>" <?= (old('bintang_mekkah', $package['bintang_mekkah'] ?? 3) == $i) ? 'selected' : '' ?>><?= $i ?> Bintang</option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="font-weight-600">Miqat Awal</label>
                                <input type="text" name="miqat_awal" class="form-control" value="<?= old('miqat_awal', $package['miqat_awal'] ?? 'MADINAH') ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pricing & Logistics -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4" style="border-radius:15px;">
                    <div class="card-header bg-white font-weight-bold py-3" style="border-radius:15px 15px 0 0;">
                        Harga & Kuota
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label class="font-weight-600">Harga Jual (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="harga_jual" class="form-control" value="<?= old('harga_jual', $package['harga_jual'] ?? '') ?>" required>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="font-weight-600">Total Seat</label>
                                <input type="number" name="total_seat" class="form-control" value="<?= old('total_seat', $package['total_seat'] ?? 0) ?>">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="font-weight-600">Jamaah Terisi</label>
                                <input type="number" name="jumlah_jamaah" class="form-control" value="<?= old('jumlah_jamaah', $package['jumlah_jamaah'] ?? 0) ?>">
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <label class="font-weight-600">Status Paket</label>
                            <select name="status" class="form-control">
                                <option value="active" <?= (old('status', $package['status'] ?? 'active') == 'active') ? 'selected' : '' ?>>Aktif (Muncul)</option>
                                <option value="inactive" <?= (old('status', $package['status'] ?? '') == 'inactive') ? 'selected' : '' ?>>Tidak Aktif (Sembunyi)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4" style="border-radius:15px;">
                    <div class="card-header bg-white font-weight-bold py-3" style="border-radius:15px 15px 0 0;">
                        Transportasi
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label class="font-weight-600">Maskapai</label>
                            <input type="text" name="maskapai" class="form-control" value="<?= old('maskapai', $package['maskapai'] ?? '') ?>" placeholder="Garuda, Saudi, dll">
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-600">Rute</label>
                            <input type="text" name="rute" class="form-control" value="<?= old('rute', $package['rute'] ?? '') ?>" placeholder="CGK-JED-MED">
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-600">Kota Keberangkatan</label>
                            <input type="text" name="departure_city" class="form-control" value="<?= old('departure_city', $package['departure_city'] ?? '') ?>" placeholder="Jakarta, Surabaya, dll">
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-600">Durasi (Hari)</label>
                            <input type="number" name="program_hari" class="form-control" value="<?= old('program_hari', $package['program_hari'] ?? 9) ?>">
                        </div>
                        <div class="form-group mb-0">
                            <label class="font-weight-600">Tanggal Berangkat</label>
                            <input type="date" name="tanggal_berangkat" class="form-control" value="<?= old('tanggal_berangkat', $package['tanggal_berangkat'] ?? '') ?>">
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4" style="border-radius:15px;">
                    <div class="card-header bg-white font-weight-bold py-3" style="border-radius:15px 15px 0 0;">
                        Media & Fitur
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label class="font-weight-600">Upload Gambar Paket</label>
                            <input type="file" name="image" class="form-control-file">
                            <small class="text-muted d-block mt-1">Format: JPG, PNG. Maks 2MB.</small>
                            <?php if(!empty($package['image'])): ?>
                                <div class="mt-2">
                                    <small class="text-muted d-block mb-1">Gambar saat ini:</small>
                                    <img src="<?= esc($package['image']) ?>" class="img-fluid rounded border" style="max-height: 150px;">
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="custom-control custom-switch mt-3">
                            <input type="checkbox" name="is_featured" class="custom-control-input" id="isFeatured" <?= (old('is_featured', $package['is_featured'] ?? 0) == 1) ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="isFeatured">Tampilkan di Rekomendasi (Featured)</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-emerald btn-lg btn-block shadow-sm py-3" style="border-radius:15px; font-weight:700;">
                    <i class="fa fa-save mr-2"></i> Simpan Paket
                </button>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
