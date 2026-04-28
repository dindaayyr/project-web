<?= $this->extend('layouts/admin') ?>
<?= $this->section('sidebar') ?>
<div class="nav-section">Menu Agen</div>
<a class="nav-link" href="/agent/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link active" href="/agent/packages"><i class="fa-solid fa-box"></i> Kelola Paket</a>
<a class="nav-link" href="/agent/bookings"><i class="fa-solid fa-ticket-alt"></i> Data Jamaah</a>
<a class="nav-link" href="/agent/disbursements"><i class="fa-solid fa-money-bill-wave"></i> Pencairan Dana</a>
<?= $this->endSection() ?>
<?= $this->section('page_title') ?><?= $package ? 'Edit Paket' : 'Tambah Paket Baru' ?><?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger" style="border-radius:12px;">
        <ul class="mb-0"><?php foreach (session()->getFlashdata('errors') as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?></ul>
    </div>
<?php endif; ?>
<div class="card-section">
    <form method="POST" action="<?= $package ? '/agent/packages/update/'.$package['id'] : '/agent/packages/store' ?>">
        <div class="row">
            <div class="col-md-8"><div class="form-group"><label class="font-weight-bold">Nama Paket *</label><input type="text" class="form-control" name="nama_paket" value="<?= esc($package['nama_paket'] ?? old('nama_paket')) ?>" required style="border-radius:10px;"></div></div>
            <div class="col-md-4"><div class="form-group"><label class="font-weight-bold">Harga Jual (Rp) *</label><input type="number" class="form-control" name="harga_jual" value="<?= esc($package['harga_jual'] ?? old('harga_jual')) ?>" required style="border-radius:10px;"></div></div>
        </div>
        <div class="form-group"><label class="font-weight-bold">Deskripsi</label><textarea class="form-control" name="description" rows="3" style="border-radius:10px;"><?= esc($package['description'] ?? old('description')) ?></textarea></div>
        <div class="row">
            <div class="col-md-3"><div class="form-group"><label class="font-weight-bold">Tanggal Berangkat *</label><input type="date" class="form-control" name="tanggal_berangkat" value="<?= esc($package['tanggal_berangkat'] ?? old('tanggal_berangkat')) ?>" required style="border-radius:10px;"></div></div>
            <div class="col-md-3"><div class="form-group"><label class="font-weight-bold">Program (Hari) *</label><input type="number" class="form-control" name="program_hari" value="<?= esc($package['program_hari'] ?? old('program_hari')) ?>" required style="border-radius:10px;"></div></div>
            <div class="col-md-3"><div class="form-group"><label class="font-weight-bold">Maskapai *</label><input type="text" class="form-control" name="maskapai" value="<?= esc($package['maskapai'] ?? old('maskapai')) ?>" required style="border-radius:10px;"></div></div>
            <div class="col-md-3"><div class="form-group"><label class="font-weight-bold">Kota Keberangkatan</label><input type="text" class="form-control" name="departure_city" value="<?= esc($package['departure_city'] ?? old('departure_city')) ?>" style="border-radius:10px;"></div></div>
        </div>
        <div class="row">
            <div class="col-md-4"><div class="form-group"><label class="font-weight-bold">Rute</label><input type="text" class="form-control" name="rute" value="<?= esc($package['rute'] ?? old('rute')) ?>" placeholder="CGK - JED - MED" style="border-radius:10px;"></div></div>
            <div class="col-md-4"><div class="form-group"><label class="font-weight-bold">Miqat Awal</label><input type="text" class="form-control" name="miqat_awal" value="<?= esc($package['miqat_awal'] ?? old('miqat_awal')) ?>" style="border-radius:10px;"></div></div>
            <div class="col-md-2"><div class="form-group"><label class="font-weight-bold">Total Seat *</label><input type="number" class="form-control" name="total_seat" value="<?= esc($package['total_seat'] ?? old('total_seat') ?? 45) ?>" required style="border-radius:10px;"></div></div>
            <div class="col-md-2"><div class="form-group"><label class="font-weight-bold">Jamaah Terdaftar</label><input type="number" class="form-control" name="jumlah_jamaah" value="<?= esc($package['jumlah_jamaah'] ?? old('jumlah_jamaah') ?? 0) ?>" style="border-radius:10px;"></div></div>
        </div>
        <hr>
        <h6 class="mb-3"><i class="fa-solid fa-hotel mr-2" style="color:var(--gold-accent);"></i>Informasi Hotel</h6>
        <div class="row">
            <div class="col-md-4"><div class="form-group"><label>Hotel Madinah</label><input type="text" class="form-control" name="hotel_madinah" value="<?= esc($package['hotel_madinah'] ?? old('hotel_madinah')) ?>" style="border-radius:10px;"></div></div>
            <div class="col-md-2"><div class="form-group"><label>Bintang</label><select class="form-control" name="bintang_madinah" style="border-radius:10px;"><?php for($s=3;$s<=5;$s++):?><option value="<?=$s?>" <?=(($package['bintang_madinah']??3)==$s)?'selected':''?>><?=$s?> ★</option><?php endfor;?></select></div></div>
            <div class="col-md-4"><div class="form-group"><label>Hotel Mekkah</label><input type="text" class="form-control" name="hotel_mekkah" value="<?= esc($package['hotel_mekkah'] ?? old('hotel_mekkah')) ?>" style="border-radius:10px;"></div></div>
            <div class="col-md-2"><div class="form-group"><label>Bintang</label><select class="form-control" name="bintang_mekkah" style="border-radius:10px;"><?php for($s=3;$s<=5;$s++):?><option value="<?=$s?>" <?=(($package['bintang_mekkah']??3)==$s)?'selected':''?>><?=$s?> ★</option><?php endfor;?></select></div></div>
        </div>
        <hr>
        <div class="form-group"><label>URL Gambar</label><input type="text" class="form-control" name="image" value="<?= esc($package['image'] ?? old('image')) ?>" placeholder="https://..." style="border-radius:10px;"></div>
        <div class="d-flex justify-content-between mt-4">
            <a href="/agent/packages" class="btn btn-outline-secondary px-4" style="border-radius:10px;">Kembali</a>
            <button type="submit" class="btn text-white px-5" style="background:var(--emerald);border-radius:10px;"><?= $package ? 'Update Paket' : 'Simpan Paket' ?></button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
