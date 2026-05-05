<?= $this->extend('layouts/public') ?>

<?= $this->section('styles') ?>
<style>
    :root {
        --dark-green: #004d40;
        --gold: #d4af37;
        --gold-light: #f4cf6d;
    }
    .checkout-header {
        padding-top: 140px;
        padding-bottom: 60px;
        background: linear-gradient(135deg, var(--dark-green) 0%, #002d25 100%);
        color: #fff;
    }
    .card-checkout {
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    .card-checkout .card-header {
        background: var(--dark-green);
        color: var(--gold);
        font-weight: 700;
        border: none;
        padding: 20px 25px;
    }
    .btn-pay {
        background: var(--gold);
        color: #fff;
        font-weight: 700;
        padding: 15px;
        border-radius: 12px;
        border: none;
        transition: all 0.3s;
        cursor: pointer;
    }
    .btn-pay:hover {
        background: var(--gold-light);
        transform: translateY(-2px);
        color: #fff;
    }
    .btn-pay:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }
    .package-summary {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 20px;
    }
    #error-message {
        display: none;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="checkout-header">
    <div class="container text-center">
        <h1 class="font-weight-bold">Konfirmasi Pemesanan</h1>
        <p class="text-white-50">Lengkapi data diri Anda untuk melanjutkan ke pembayaran aman</p>
    </div>
</div>

<div class="container py-5" style="margin-top: -40px;">
    <div class="row">
        <div class="col-lg-8">
            <div class="card card-checkout">
                <div class="card-header">
                    <i class="fa fa-user-edit mr-2"></i> Data Jamaah
                </div>
                <div class="card-body p-4">
                    <!-- Error message display -->
                    <div id="error-message" class="alert alert-danger" style="border-radius: 12px;">
                        <i class="fa fa-exclamation-triangle mr-2"></i>
                        <span id="error-text"></span>
                    </div>

                    <form id="payment-form">
                        <input type="hidden" name="package_id" value="<?= $package['id'] ?>">
                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Nama Lengkap (Sesuai Paspor/KTP)</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control form-control-lg" required placeholder="Contoh: Ahmad Abdullah">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark">Email Aktif</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-lg" required placeholder="ahmad@example.com">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark">Nomor HP / WhatsApp</label>
                                    <input type="text" name="no_hp" id="no_hp" class="form-control form-control-lg" required placeholder="0812xxxxxxxx">
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-info mt-3" style="border-radius: 12px; border: none; background: rgba(0, 77, 64, 0.05); color: var(--dark-green);">
                            <i class="fa fa-info-circle mr-2"></i> Pastikan data yang Anda masukkan sudah benar. Tiket dan bukti bayar akan dikirimkan ke email tersebut.
                        </div>

                        <button type="submit" id="pay-button" class="btn btn-pay btn-block mt-4">
                            Lanjutkan Ke Pembayaran <i class="fa fa-arrow-right ml-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-checkout">
                <div class="card-header">
                    <i class="fa fa-shopping-bag mr-2"></i> Ringkasan Pesanan
                </div>
                <div class="card-body">
                    <div class="package-summary">
                        <h6 class="font-weight-bold text-dark mb-1"><?= esc($package['nama_paket']) ?></h6>
                        <p class="small text-muted mb-3"><?= esc($package['travel_name']) ?></p>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span class="small">Durasi</span>
                            <span class="small font-weight-bold"><?= esc($package['program_hari']) ?> Hari</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="small">Keberangkatan</span>
                            <span class="small font-weight-bold"><?= date('d M Y', strtotime($package['tanggal_berangkat'])) ?></span>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between align-items-center mb-0">
                        <span class="font-weight-bold">Total Bayar</span>
                        <h4 class="font-weight-bold text-success mb-0">Rp <?= number_format($package['harga_jual'], 0, ',', '.') ?></h4>
                    </div>
                    <p class="text-right text-muted x-small mt-1" style="font-size: 0.75rem;">Termasuk PPN & Biaya Layanan</p>
                </div>
            </div>
            
            <div class="mt-4 text-center">
                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Midtrans.png" height="30" alt="Midtrans Secured">
                <p class="text-muted small mt-2"><i class="fa fa-lock mr-1"></i> Pembayaran Aman & Terenkripsi</p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Midtrans Snap JS -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= env('MIDTRANS_CLIENT_KEY') ?>"></script>

<script>
    document.getElementById('payment-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const btn = document.getElementById('pay-button');
        const errorDiv = document.getElementById('error-message');
        const errorText = document.getElementById('error-text');
        
        // Disable button and show loading
        btn.disabled = true;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin mr-2"></i> Memproses...';
        errorDiv.style.display = 'none';
        
        // Build form data
        const formData = new FormData(this);
        
        console.log('Sending booking request...');
        
        fetch('/booking/store', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(function(response) {
            console.log('Response status:', response.status);
            if (!response.ok) {
                return response.text().then(text => { throw new Error(text || 'Server Error ' + response.status) });
            }
            return response.json();
        })
        .then(function(data) {
            console.log('Data received:', data);
            if (data.status === 'success' && data.snap_token) {
                // Check if snap is loaded
                if (typeof window.snap === 'undefined') {
                    throw new Error('Midtrans Snap JS failed to load. Please check your internet connection.');
                }

                window.snap.pay(data.snap_token, {
                    onSuccess: function(result) {
                        window.location.href = '/booking/success?order_id=' + data.order_id;
                    },
                    onPending: function(result) {
                        window.location.href = '/booking/pending?order_id=' + data.order_id;
                    },
                    onError: function(result) {
                        window.location.href = '/booking/failed?order_id=' + data.order_id;
                    },
                    onClose: function() {
                        btn.disabled = false;
                        btn.innerHTML = 'Lanjutkan Ke Pembayaran <i class="fa fa-arrow-right ml-2"></i>';
                    }
                });
            } else {
                throw new Error(data.message || 'Gagal memproses pembayaran.');
            }
        })
        .catch(function(error) {
            console.error('Checkout Error:', error);
            errorDiv.style.display = 'block';
            
            // Try to parse error message if it's JSON from a Whoops page
            let displayMsg = error.message;
            if (displayMsg.includes('<!DOCTYPE html>')) {
                displayMsg = 'Terjadi kesalahan sistem (500). Silakan hubungi admin.';
            }
            
            errorText.textContent = displayMsg;
            btn.disabled = false;
            btn.innerHTML = 'Lanjutkan Ke Pembayaran <i class="fa fa-arrow-right ml-2"></i>';
        });
    });
</script>
<?= $this->endSection() ?>
