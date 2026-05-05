<?= $this->extend('layouts/public') ?>

<?= $this->section('styles') ?>
<style>
    /* ===== HERO BANNER ===== */
    .page-hero {
        padding: 140px 0 80px;
        background: linear-gradient(160deg, #022c22 0%, var(--emerald-dark) 40%, var(--emerald-light) 100%);
        position: relative;
        overflow: hidden;
    }
    .page-hero::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23d4af37' fill-opacity='0.04'%3E%3Cpath d='M50 50c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10s-10-4.477-10-10 4.477-10 10-10zM10 10c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10S0 25.523 0 20s4.477-10 10-10z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        opacity: 0.6;
    }
    .page-hero .hero-glow {
        position: absolute;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(212, 175, 55, 0.12) 0%, transparent 70%);
        border-radius: 50%;
        top: -10%;
        right: -5%;
    }
    .page-hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: #fff;
    }
    .page-hero-content h1 {
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 15px;
        text-shadow: 0 2px 15px rgba(0,0,0,0.2);
    }
    .page-hero-content h1 .gold-text { color: var(--gold-accent); }
    .page-hero-content p {
        font-size: 1.1rem;
        opacity: 0.85;
        max-width: 600px;
        margin: 0 auto;
    }
    .breadcrumb-custom {
        background: transparent;
        justify-content: center;
        margin-top: 20px;
        padding: 0;
    }
    .breadcrumb-custom .breadcrumb-item a {
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        transition: color 0.3s;
    }
    .breadcrumb-custom .breadcrumb-item a:hover { color: var(--gold-accent); }
    .breadcrumb-custom .breadcrumb-item.active { color: var(--gold-accent); }
    .breadcrumb-custom .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255,255,255,0.4);
    }

    /* ===== NEWS SECTION ===== */
    .news-section {
        padding: 80px 0;
        background: #f8fffe;
    }

    /* Featured / Top News */
    .news-featured {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0,0,0,0.06);
        border: 1px solid #f1f5f9;
        margin-bottom: 40px;
        transition: all 0.4s ease;
    }
    .news-featured:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.1);
    }
    .news-featured .featured-img {
        height: 350px;
        overflow: hidden;
        position: relative;
    }
    .news-featured .featured-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s;
    }
    .news-featured:hover .featured-img img {
        transform: scale(1.05);
    }
    .news-featured .featured-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 30px;
        background: linear-gradient(transparent, rgba(0,0,0,0.8));
        color: #fff;
    }
    .news-featured .featured-overlay .news-badge {
        display: inline-flex;
        align-items: center;
        background: var(--gold-accent);
        color: var(--emerald-dark);
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        margin-bottom: 12px;
    }
    .news-featured .featured-overlay h2 {
        font-size: 1.6rem;
        font-weight: 700;
        margin-bottom: 8px;
        line-height: 1.3;
    }
    .news-featured .featured-overlay p {
        font-size: 0.9rem;
        opacity: 0.85;
        margin-bottom: 0;
    }

    /* News Cards */
    .news-card {
        background: #fff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 3px 15px rgba(0,0,0,0.05);
        transition: all 0.4s ease;
        height: 100%;
        border: 1px solid #f1f5f9;
        display: flex;
        flex-direction: column;
    }
    .news-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    }
    .news-card .card-img-wrapper {
        height: 200px;
        overflow: hidden;
        position: relative;
    }
    .news-card .card-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }
    .news-card:hover .card-img-wrapper img {
        transform: scale(1.08);
    }
    .news-card .card-img-wrapper .news-category {
        position: absolute;
        top: 12px;
        left: 12px;
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 0.72rem;
        font-weight: 600;
        backdrop-filter: blur(8px);
    }
    .cat-update { background: rgba(4, 120, 87, 0.9); color: #fff; }
    .cat-tips { background: rgba(212, 175, 55, 0.9); color: var(--emerald-dark); }
    .cat-fasilitas { background: rgba(59, 130, 246, 0.9); color: #fff; }
    .cat-promo { background: rgba(220, 38, 38, 0.9); color: #fff; }

    .news-card .card-body-custom {
        padding: 22px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .news-card .card-body-custom .news-date {
        font-size: 0.78rem;
        color: var(--text-muted);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .news-card .card-body-custom .news-date i {
        color: var(--gold-accent);
    }
    .news-card .card-body-custom h5 {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 1rem;
        color: var(--text-dark);
        margin-bottom: 10px;
        line-height: 1.5;
    }
    .news-card .card-body-custom p {
        color: var(--text-muted);
        font-size: 0.88rem;
        line-height: 1.7;
        flex: 1;
    }
    .news-card .card-body-custom .read-more {
        color: var(--emerald);
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s;
        margin-top: auto;
    }
    .news-card .card-body-custom .read-more:hover {
        color: var(--emerald-dark);
        gap: 8px;
    }
    .news-card .card-body-custom .read-more i {
        margin-left: 5px;
        transition: transform 0.3s;
    }
    .news-card:hover .read-more i {
        transform: translateX(4px);
    }

    /* Newsletter CTA */
    .newsletter-cta {
        background: linear-gradient(135deg, var(--emerald-dark) 0%, #022c22 100%);
        border-radius: 20px;
        padding: 50px 40px;
        color: #fff;
        position: relative;
        overflow: hidden;
        margin-top: 60px;
    }
    .newsletter-cta::before {
        content: '';
        position: absolute;
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, rgba(212,175,55,0.1) 0%, transparent 70%);
        border-radius: 50%;
        top: -80px;
        right: -60px;
    }
    .newsletter-cta h3 {
        font-size: 1.6rem;
        font-weight: 700;
        margin-bottom: 10px;
    }
    .newsletter-cta p {
        opacity: 0.8;
        font-size: 0.95rem;
        margin-bottom: 25px;
    }
    .newsletter-form {
        display: flex;
        align-items: stretch;
        max-width: 480px;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }
    .newsletter-form .form-control {
        border: none;
        border-radius: 0;
        padding: 15px 20px;
        font-size: 0.9rem;
        flex: 1;
        min-width: 0;
        height: auto;
    }
    .newsletter-form .form-control:focus {
        box-shadow: none;
        outline: none;
    }
    .newsletter-form .btn-gold {
        border-radius: 0;
        padding: 15px 28px;
        font-weight: 600;
        white-space: nowrap;
        flex-shrink: 0;
    }

    @media (max-width: 768px) {
        .page-hero-content h1 { font-size: 1.8rem; }
        .news-featured .featured-img { height: 250px; }
        .news-featured .featured-overlay h2 { font-size: 1.2rem; }
        .newsletter-cta { padding: 30px 20px; }
        .newsletter-cta h3 { font-size: 1.3rem; }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- HERO BANNER -->
<section class="page-hero">
    <div class="hero-glow"></div>
    <div class="container">
        <div class="page-hero-content animate__animated animate__fadeInUp">
            <h1>Berita & <span class="gold-text">Informasi</span> Umroh</h1>
            <p>Update terkini seputar paket umroh, tips perjalanan, dan informasi penting untuk jamaah</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="/"><i class="fa fa-home mr-1"></i> Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Berita</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<!-- NEWS CONTENT -->
<section class="news-section">
    <div class="container">

        <!-- Featured News -->
        <div class="news-featured animate__animated animate__fadeInUp">
            <div class="featured-img">
                <img src="https://images.unsplash.com/photo-1591604129939-f1efa4d9f7fa?w=1200&h=500&fit=crop" 
                     alt="Update Kuota Paket Umroh" loading="lazy">
                <div class="featured-overlay">
                    <span class="news-badge"><i class="fa fa-bolt mr-1"></i> BREAKING</span>
                    <h2>Update Kuota Paket An Namiroh Keberangkatan Juni 2026: Sisa 5 Seat!</h2>
                    <p><i class="fa fa-calendar-alt mr-1"></i> 4 Mei 2026 &nbsp;•&nbsp; <i class="fa fa-clock mr-1"></i> 5 menit baca</p>
                </div>
            </div>
        </div>

        <!-- News Grid -->
        <div class="row">
            <!-- Article 1 -->
            <div class="col-md-4 mb-4">
                <div class="news-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                    <div class="card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1564769625905-50e93615e769?w=600&h=400&fit=crop" 
                             alt="Update Kuota Paket" loading="lazy">
                        <span class="news-category cat-update"><i class="fa fa-chart-line mr-1"></i> Update Kuota</span>
                    </div>
                    <div class="card-body-custom">
                        <div class="news-date">
                            <span><i class="fa fa-calendar-alt"></i> 4 Mei 2026</span>
                            <span><i class="fa fa-eye"></i> 1.2K views</span>
                        </div>
                        <h5>Update Kuota Paket An Namiroh Keberangkatan Juni 2026: Sisa 5 Seat!</h5>
                        <p>Paket An Namiroh untuk keberangkatan bulan Juni 2026 kini hanya menyisakan 5 kursi terakhir. Paket premium dengan hotel bintang 5 di Mekkah dan Madinah ini menjadi salah satu yang paling diminati jamaah sepanjang tahun. Segera amankan seat Anda sebelum kehabisan!</p>
                        <a href="#" class="read-more">
                            Baca Selengkapnya <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Article 2 -->
            <div class="col-md-4 mb-4">
                <div class="news-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                    <div class="card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1540541338287-41700207dee6?w=600&h=400&fit=crop" 
                             alt="Hotel Bintang 5 Mekkah" loading="lazy">
                        <span class="news-category cat-fasilitas"><i class="fa fa-hotel mr-1"></i> Fasilitas</span>
                    </div>
                    <div class="card-body-custom">
                        <div class="news-date">
                            <span><i class="fa fa-calendar-alt"></i> 2 Mei 2026</span>
                            <span><i class="fa fa-eye"></i> 856 views</span>
                        </div>
                        <h5>Fasilitas Hotel Bintang 5 di Mekkah untuk Paket Rihlah Lion Kini Tersedia</h5>
                        <p>Kabar gembira bagi jamaah yang mendaftar paket Rihlah Lion! Kerjasama eksklusif antara travel agent dan Hilton Suites Mekkah kini resmi dimulai. Jamaah akan menikmati kamar premium dengan pemandangan langsung ke Masjidil Haram, hanya 200 meter dari Ka'bah.</p>
                        <a href="#" class="read-more">
                            Baca Selengkapnya <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Article 3 -->
            <div class="col-md-4 mb-4">
                <div class="news-card animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                    <div class="card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1542296332-2e4473faf563?w=600&h=400&fit=crop" 
                             alt="Tips Paket Umroh" loading="lazy">
                        <span class="news-category cat-tips"><i class="fa fa-lightbulb mr-1"></i> Tips</span>
                    </div>
                    <div class="card-body-custom">
                        <div class="news-date">
                            <span><i class="fa fa-calendar-alt"></i> 30 Apr 2026</span>
                            <span><i class="fa fa-eye"></i> 2.1K views</span>
                        </div>
                        <h5>Tips Memilih Paket Umroh Program 12 Hari dengan Rute Transit Terbaik</h5>
                        <p>Program 12 hari menjadi pilihan favorit bagi jamaah yang menginginkan keseimbangan antara ibadah dan eksplorasi. Artikel ini membahas cara memilih rute transit optimal, perbandingan maskapai yang menawarkan layover nyaman, serta estimasi biaya yang perlu disiapkan.</p>
                        <a href="#" class="read-more">
                            Baca Selengkapnya <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional News Row -->
        <div class="row mt-2">
            <!-- Article 4 -->
            <div class="col-md-4 mb-4">
                <div class="news-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                    <div class="card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1585036156171-384164a8c248?w=600&h=400&fit=crop" 
                             alt="Promo Ramadhan" loading="lazy">
                        <span class="news-category cat-promo"><i class="fa fa-tag mr-1"></i> Promo</span>
                    </div>
                    <div class="card-body-custom">
                        <div class="news-date">
                            <span><i class="fa fa-calendar-alt"></i> 28 Apr 2026</span>
                            <span><i class="fa fa-eye"></i> 3.4K views</span>
                        </div>
                        <h5>Early Bird Promo: Diskon Hingga 15% untuk Keberangkatan Q4 2026</h5>
                        <p>Beberapa travel agent partner UmrohQueens menawarkan promo early bird dengan potongan harga hingga 15% untuk pendaftaran paket umroh keberangkatan Oktober-Desember 2026. Promo ini berlaku terbatas dan hanya tersedia melalui platform UmrohQueens.</p>
                        <a href="#" class="read-more">
                            Baca Selengkapnya <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Article 5 -->
            <div class="col-md-4 mb-4">
                <div class="news-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                    <div class="card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=600&h=400&fit=crop" 
                             alt="Regulasi Visa Umroh" loading="lazy">
                        <span class="news-category cat-update"><i class="fa fa-file-alt mr-1"></i> Regulasi</span>
                    </div>
                    <div class="card-body-custom">
                        <div class="news-date">
                            <span><i class="fa fa-calendar-alt"></i> 25 Apr 2026</span>
                            <span><i class="fa fa-eye"></i> 1.8K views</span>
                        </div>
                        <h5>Update Regulasi Visa Umroh 2026: Proses Lebih Cepat dengan Sistem E-Visa</h5>
                        <p>Pemerintah Arab Saudi mengumumkan peningkatan sistem e-Visa yang memungkinkan proses pengurusan visa umroh selesai dalam 24 jam. Perubahan ini memberi kemudahan bagi jamaah Indonesia yang ingin merencanakan keberangkatan umroh secara mendadak.</p>
                        <a href="#" class="read-more">
                            Baca Selengkapnya <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Article 6 -->
            <div class="col-md-4 mb-4">
                <div class="news-card animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                    <div class="card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1466442929976-97f336a657be?w=600&h=400&fit=crop" 
                             alt="AI Search UmrohQueens" loading="lazy">
                        <span class="news-category cat-tips"><i class="fa fa-robot mr-1"></i> Teknologi</span>
                    </div>
                    <div class="card-body-custom">
                        <div class="news-date">
                            <span><i class="fa fa-calendar-alt"></i> 22 Apr 2026</span>
                            <span><i class="fa fa-eye"></i> 945 views</span>
                        </div>
                        <h5>Cara Menggunakan AI Assistant UmrohQueens untuk Menemukan Paket Impian</h5>
                        <p>Fitur AI Assistant kami memungkinkan Anda mencari paket umroh hanya dengan mengetikkan kebutuhan dalam bahasa sehari-hari. Cukup katakan "paket umroh budget 25 juta bulan September" dan AI akan mencarikan rekomendasi terbaik secara otomatis.</p>
                        <a href="#" class="read-more">
                            Baca Selengkapnya <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Newsletter CTA -->
        <div class="newsletter-cta animate__animated animate__fadeInUp">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h3><i class="fa fa-bell mr-2" style="color: var(--gold-accent);"></i> Jangan Lewatkan Update Terbaru!</h3>
                    <p>Dapatkan notifikasi langsung untuk berita terbaru, update kuota paket, dan promo eksklusif dari UmrohQueens.</p>
                </div>
                <div class="col-lg-5">
                    <div class="newsletter-form">
                        <input type="email" class="form-control" placeholder="Masukkan email Anda...">
                        <button class="btn btn-gold" type="button">
                            <i class="fa fa-paper-plane mr-1"></i> Langganan
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?= $this->endSection() ?>
