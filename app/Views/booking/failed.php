<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center mt-5">
            <div class="card border-0 shadow-sm p-5" style="border-radius: 24px;">
                <div class="mb-4">
                    <i class="fa fa-times-circle text-danger" style="font-size: 80px;"></i>
                </div>
                <h2 class="font-weight-bold">Pembayaran Gagal</h2>
                <p class="text-muted">Mohon maaf, transaksi Anda gagal atau dibatalkan. Silakan coba kembali beberapa saat lagi.</p>
                <div class="bg-light p-3 rounded mb-4">
                    <small class="text-muted d-block">Order ID</small>
                    <span class="font-weight-bold"><?= $_GET['order_id'] ?? '-' ?></span>
                </div>
                <div class="d-grid gap-2">
                    <a href="/katalog" class="btn btn-danger btn-lg btn-block" style="border-radius: 12px;">Cari Paket Lain</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
