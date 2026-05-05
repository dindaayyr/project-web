<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center mt-5">
            <div class="card border-0 shadow-sm p-5" style="border-radius: 24px;">
                <div class="mb-4">
                    <i class="fa fa-clock text-warning" style="font-size: 80px;"></i>
                </div>
                <h2 class="font-weight-bold">Pembayaran Tertunda</h2>
                <p class="text-muted">Selesaikan pembayaran Anda segera untuk mengamankan kuota paket umroh Anda.</p>
                <div class="bg-light p-3 rounded mb-4">
                    <small class="text-muted d-block">Order ID</small>
                    <span class="font-weight-bold"><?= $_GET['order_id'] ?? '-' ?></span>
                </div>
                <div class="d-grid gap-2">
                    <a href="/user/bookings" class="btn btn-warning btn-lg btn-block" style="border-radius: 12px; color:#fff;">Cek Status Pembayaran</a>
                    <a href="/katalog" class="btn btn-link text-muted mt-2">Kembali ke Katalog</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
