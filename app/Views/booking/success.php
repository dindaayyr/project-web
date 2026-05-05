<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center mt-5">
            <div class="card border-0 shadow-sm p-5" style="border-radius: 24px;">
                <div class="mb-4">
                    <i class="fa fa-check-circle text-success" style="font-size: 80px;"></i>
                </div>
                <h2 class="font-weight-bold">Pembayaran Berhasil!</h2>
                <p class="text-muted">Terima kasih atas kepercayaan Anda. Pembayaran Anda telah kami terima dan kuota Anda telah diamankan.</p>
                <div class="bg-light p-3 rounded mb-4">
                    <small class="text-muted d-block">Order ID</small>
                    <span class="font-weight-bold"><?= $_GET['order_id'] ?? '-' ?></span>
                </div>
                <div class="d-grid gap-2">
                    <a href="/user/bookings" class="btn btn-success btn-lg btn-block" style="border-radius: 12px; background:#004d40; border:none;">Lihat Tiket Saya</a>
                    <a href="/katalog" class="btn btn-link text-muted mt-2">Kembali ke Katalog</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
