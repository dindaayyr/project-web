<?= $this->extend('layouts/public') ?>

<?= $this->section('styles') ?>
<style>
    .detail-hero {
        padding-top: 140px;
        padding-bottom: 80px;
        background: linear-gradient(135deg, #022c22 0%, var(--emerald-dark) 100%);
        color: #fff;
        position: relative;
        overflow: hidden;
    }
    .detail-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23d4af37' fill-opacity='0.05'%3E%3Cpath d='M50 50c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10s-10-4.477-10-10 4.477-10 10-10zM10 10c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10S0 25.523 0 20s4.477-10 10-10z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        opacity: 0.3;
    }
    .package-title {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 2.8rem;
        margin-bottom: 20px;
    }
    .agent-info-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 25px;
        margin-top: 30px;
    }
    .booking-card {
        background: #fff;
        border-radius: 24px;
        padding: 35px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        position: sticky;
        top: 100px;
        border: 1px solid #f1f5f9;
        color: var(--text-dark);
    }
    .price-tag {
        font-size: 2rem;
        font-weight: 800;
        color: var(--emerald-dark);
        margin-bottom: 5px;
    }
    .feature-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        font-size: 0.95rem;
    }
    .feature-item i {
        width: 36px;
        height: 36px;
        background: var(--emerald-50);
        color: var(--emerald);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
    }
    .detail-tabs .nav-link {
        border: none;
        color: var(--text-muted);
        font-weight: 600;
        padding: 15px 25px;
        border-bottom: 3px solid transparent;
        transition: all 0.3s;
    }
    .detail-tabs .nav-link.active {
        color: var(--emerald);
        background: transparent;
        border-bottom-color: var(--emerald);
    }
    .gallery-img {
        width: 100%;
        height: 450px;
        object-fit: cover;
        border-radius: 24px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }
    .section-title {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        color: var(--emerald-dark);
        margin-bottom: 25px;
        position: relative;
        padding-bottom: 10px;
    }
    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; width: 50px; height: 3px;
        background: var(--gold-accent);
    }
    .btn-book {
        background: linear-gradient(135deg, var(--emerald-dark), var(--emerald));
        color: #fff;
        border: none;
        border-radius: 14px;
        padding: 16px;
        font-weight: 700;
        font-size: 1.1rem;
        width: 100%;
        margin-top: 20px;
        transition: all 0.3s;
        box-shadow: 0 8px 25px rgba(6, 78, 59, 0.3);
    }
    .btn-book:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(6, 78, 59, 0.4);
        color: #fff;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="detail-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-4">
                        <li class="breadcrumb-item"><a href="/" class="text-white-50">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="/katalog" class="text-white-50">Katalog</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Detail Paket</li>
                    </ol>
                </nav>
                <h1 class="package-title animate__animated animate__fadeInUp"><?= esc($package['nama_paket']) ?></h1>
                <div class="d-flex align-items-center flex-wrap mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.1s; gap:8px;">
                    <div class="badge badge-warning px-3 py-2" style="border-radius: 10px;"><i class="fa-solid fa-mosque mr-1"></i> Madinah <?= ($package['bintang_madinah'] ?? 3) ?>★</div>
                    <div class="badge badge-warning px-3 py-2" style="border-radius: 10px;"><i class="fa-solid fa-kaaba mr-1"></i> Mekkah <?= ($package['bintang_mekkah'] ?? 3) ?>★</div>
                    <?php if (!empty($package['maskapai'])): ?><span class="badge px-3 py-2" style="background:rgba(255,255,255,0.15);color:#fff;border-radius:10px;"><i class="fa fa-plane mr-1"></i> <?= esc($package['maskapai']) ?></span><?php endif; ?>
                    <div class="text-white-50"><i class="fa fa-map-marker-alt mr-1"></i> <?= esc($package['departure_city'] ?? '') ?></div>
                </div>
                
                <div class="agent-info-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                    <div class="d-flex align-items-center">
                        <img src="<?= esc($package['travel_logo'] ?? 'https://ui-avatars.com/api/?name='.urlencode($package['travel_name']).'&background=d4af37&color=fff') ?>" 
                             class="rounded-circle bg-white p-1" width="60" height="60" style="object-fit: cover;">
                        <div class="ml-3">
                            <div class="small text-white-50">Diselenggarakan oleh:</div>
                            <h5 class="mb-0 font-weight-bold"><?= esc($package['travel_name']) ?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 text-right d-none d-lg-block">
                <img src="<?= esc($package['image']) ?>" class="gallery-img animate__animated animate__zoomIn" alt="Main image">
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-5" style="border-radius: 24px;">
                <div class="card-body p-4">
                    <ul class="nav nav-tabs detail-tabs mb-4" id="detailTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="desc-tab" data-toggle="tab" href="#desc" role="tab">Deskripsi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="itinerary-tab" data-toggle="tab" href="#itinerary" role="tab">Itinerary</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="facilities-tab" data-toggle="tab" href="#facilities" role="tab">Fasilitas</a>
                        </li>
                    </ul>
                    <div class="tab-content pt-3" id="detailTabsContent">
                        <div class="tab-pane fade show active" id="desc" role="tabpanel">
                            <h4 class="section-title">Tentang Paket Ini</h4>
                            <div class="text-muted" style="line-height: 1.8;">
                                <?= nl2br(esc($package['description'])) ?>
                            </div>
                            
                            <h4 class="section-title mt-5">Keunggulan Travel</h4>
                            <p class="text-muted"><?= esc($package['travel_desc']) ?></p>
                        </div>
                        <div class="tab-pane fade" id="itinerary" role="tabpanel">
                            <h4 class="section-title">Rencana Perjalanan</h4>
                            <div class="timeline">
                                <?php for($i=1; $i<=3; $i++): ?>
                                <div class="mb-4 pb-4 border-bottom">
                                    <h6 class="font-weight-bold text-emerald">Hari ke-<?= $i ?></h6>
                                    <p class="text-muted small">Kegiatan harian akan dijelaskan secara detail oleh pembimbing selama perjalanan suci Anda berlangsung.</p>
                                </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="facilities" role="tabpanel">
                            <h4 class="section-title">Fasilitas Termasuk</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fa fa-check-circle text-success mr-2"></i> Tiket Pesawat PP</li>
                                        <li class="mb-2"><i class="fa fa-check-circle text-success mr-2"></i> Visa Umroh</li>
                                        <li class="mb-2"><i class="fa fa-check-circle text-success mr-2"></i> Makan 3x Sehari</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fa fa-check-circle text-success mr-2"></i> Transportasi Bus AC</li>
                                        <li class="mb-2"><i class="fa fa-check-circle text-success mr-2"></i> Muthawif / Guide</li>
                                        <li class="mb-2"><i class="fa fa-check-circle text-success mr-2"></i> Perlengkapan Umroh</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="booking-card animate__animated animate__fadeInRight">
                <div class="price-tag">Rp <?= number_format($package['harga_jual'], 0, ',', '.') ?></div>
                <div class="text-muted small mb-4">Harga per jamaah (All-in)</div>
                
                <div class="mb-4">
                    <div class="feature-item">
                        <i class="fa fa-clock"></i>
                        <span>Durasi <strong><?= esc($package['program_hari']) ?> Hari</strong></span>
                    </div>
                    <div class="feature-item">
                        <i class="fa fa-plane"></i>
                        <span>Maskapai <strong><?= esc($package['maskapai'] ?? '-') ?></strong></span>
                    </div>
                    <div class="feature-item">
                        <i class="fa fa-users"></i>
                        <span>Sisa Kuota <strong><?= esc($package['available_seat'] ?? 0) ?> Kursi</strong></span>
                    </div>
                    <div class="feature-item">
                        <i class="fa fa-calendar"></i>
                        <span>Keberangkatan <strong><?= !empty($package['tanggal_berangkat']) ? date('d M Y', strtotime($package['tanggal_berangkat'])) : '-' ?></strong></span>
                    </div>
                </div>
                
                <hr>
                
                <?php if(session()->get('logged_in')): ?>
                    <button class="btn btn-book">Pesan Sekarang</button>
                    <p class="text-center small text-muted mt-3 mb-0">Klik pesan untuk melanjutkan ke pembayaran</p>
                <?php else: ?>
                    <a href="/login?redirect=katalog/detail/<?= $package['id'] ?>" class="btn btn-book">Login untuk Pesan</a>
                    <p class="text-center small text-muted mt-3 mb-0">Anda harus login terlebih dahulu</p>
                <?php endif; ?>
                
                <div class="mt-4 text-center">
                    <a href="https://wa.me/<?= esc($package['travel_phone']) ?>" class="btn btn-outline-success btn-block" style="border-radius: 14px; border-width: 2px; font-weight: 600;">
                        <i class="fa-brands fa-whatsapp mr-2"></i> Tanya via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
