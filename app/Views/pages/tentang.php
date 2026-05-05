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

    /* ===== ABOUT SECTIONS ===== */
    .about-section {
        padding: 80px 0;
        background: #fff;
    }
    .about-section.alt-bg {
        background: #f8fffe;
    }

    /* Story Section */
    .story-content h2 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--emerald-dark);
        margin-bottom: 20px;
    }
    .story-content .gold-line-left {
        width: 60px;
        height: 3px;
        background: var(--gold-accent);
        border-radius: 3px;
        margin-bottom: 25px;
    }
    .story-content p {
        color: var(--text-muted);
        font-size: 0.95rem;
        line-height: 1.9;
        margin-bottom: 16px;
    }
    .story-content p.lead-text {
        font-size: 1.1rem;
        color: var(--text-dark);
        font-weight: 500;
        line-height: 1.8;
    }
    .story-image {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        position: relative;
    }
    .story-image img {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }
    .story-image .image-accent {
        position: absolute;
        bottom: -15px;
        right: -15px;
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, var(--gold-accent), var(--gold-dark));
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        color: var(--emerald-dark);
        font-family: 'Poppins', sans-serif;
        box-shadow: 0 8px 20px rgba(212,175,55,0.3);
        z-index: 2;
    }
    .story-image .image-accent .accent-number {
        font-size: 2rem;
        font-weight: 800;
        line-height: 1;
    }
    .story-image .image-accent .accent-label {
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Values / USP Section */
    .value-card {
        background: #fff;
        border-radius: 18px;
        padding: 35px 28px;
        text-align: center;
        transition: all 0.4s ease;
        height: 100%;
        border: 1px solid #f1f5f9;
        position: relative;
        overflow: hidden;
    }
    .value-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, var(--emerald-dark), var(--gold-accent));
        opacity: 0;
        transition: opacity 0.3s;
    }
    .value-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(6, 78, 59, 0.1);
    }
    .value-card:hover::before {
        opacity: 1;
    }
    .value-icon {
        width: 75px;
        height: 75px;
        background: linear-gradient(135deg, var(--emerald-50), #d1fae5);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 22px;
        font-size: 1.7rem;
        color: var(--emerald-dark);
        transition: all 0.4s;
    }
    .value-card:hover .value-icon {
        background: linear-gradient(135deg, var(--gold-accent), var(--gold-dark));
        color: #fff;
        transform: rotateY(180deg);
    }
    .value-card h5 {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        color: var(--emerald-dark);
        margin-bottom: 12px;
        font-size: 1.05rem;
    }
    .value-card p {
        color: var(--text-muted);
        font-size: 0.88rem;
        line-height: 1.7;
    }

    /* Stats Section */
    .stats-bar {
        background: linear-gradient(135deg, var(--emerald-dark) 0%, #022c22 100%);
        border-radius: 20px;
        padding: 50px 40px;
        margin: 0 auto;
        position: relative;
        overflow: hidden;
    }
    .stats-bar::before {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(212,175,55,0.08) 0%, transparent 70%);
        border-radius: 50%;
        top: -100px;
        right: -50px;
    }
    .stat-item {
        text-align: center;
        position: relative;
        z-index: 2;
    }
    .stat-item .stat-number {
        font-family: 'Playfair Display', serif;
        font-size: 2.8rem;
        font-weight: 800;
        color: var(--gold-accent);
        line-height: 1;
        margin-bottom: 8px;
    }
    .stat-item .stat-label {
        color: rgba(255,255,255,0.7);
        font-size: 0.9rem;
        font-weight: 400;
    }

    /* Team / Vision Section */
    .vision-card {
        background: #fff;
        border-radius: 18px;
        padding: 35px;
        height: 100%;
        border: 1px solid #f1f5f9;
        transition: all 0.3s;
    }
    .vision-card:hover {
        box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        transform: translateY(-4px);
    }
    .vision-card .vision-icon {
        width: 55px;
        height: 55px;
        background: var(--emerald-50);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        color: var(--emerald-dark);
        margin-bottom: 20px;
    }
    .vision-card h5 {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        color: var(--emerald-dark);
        margin-bottom: 12px;
    }
    .vision-card p {
        color: var(--text-muted);
        font-size: 0.9rem;
        line-height: 1.8;
        margin-bottom: 0;
    }

    /* CTA Final */
    .about-cta {
        padding: 100px 0;
        background: linear-gradient(135deg, var(--emerald-dark) 0%, #022c22 100%);
        position: relative;
        overflow: hidden;
        text-align: center;
        color: #fff;
    }
    .about-cta::before {
        content: '';
        position: absolute;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(212,175,55,0.08) 0%, transparent 70%);
        border-radius: 50%;
        bottom: -150px;
        left: -100px;
    }
    .about-cta::after {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(212,175,55,0.06) 0%, transparent 70%);
        border-radius: 50%;
        top: -100px;
        right: -80px;
    }
    .about-cta h2 {
        font-size: 2.3rem;
        font-weight: 700;
        margin-bottom: 15px;
        position: relative;
        z-index: 2;
    }
    .about-cta p {
        font-size: 1.05rem;
        opacity: 0.8;
        max-width: 550px;
        margin: 0 auto 30px;
        position: relative;
        z-index: 2;
    }
    .about-cta .btn {
        position: relative;
        z-index: 2;
    }

    @media (max-width: 768px) {
        .page-hero-content h1 { font-size: 1.8rem; }
        .story-content h2 { font-size: 1.5rem; }
        .story-image img { height: 280px; }
        .story-image .image-accent { display: none; }
        .stat-item .stat-number { font-size: 2rem; }
        .stats-bar { padding: 30px 20px; }
        .about-cta h2 { font-size: 1.6rem; }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- HERO BANNER -->
<section class="page-hero">
    <div class="hero-glow"></div>
    <div class="container">
        <div class="page-hero-content animate__animated animate__fadeInUp">
            <h1>Tentang <span class="gold-text">UmrohQueens</span></h1>
            <p>Platform agregator travel umroh terpercaya di Indonesia dengan teknologi AI terdepan</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="/"><i class="fa fa-home mr-1"></i> Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tentang Kami</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<!-- OUR STORY -->
<section class="about-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="story-content animate__animated animate__fadeInLeft">
                    <h2>Misi Kami: Mempermudah Perjalanan Suci Anda</h2>
                    <div class="gold-line-left"></div>
                    <p class="lead-text">
                        UmrohQueens adalah platform agregator travel umroh pertama di Indonesia yang mengintegrasikan 
                        teknologi <strong>Artificial Intelligence</strong> untuk membantu jamaah menemukan paket umroh terbaik 
                        sesuai kebutuhan dan anggaran.
                    </p>
                    <p>
                        Kami percaya bahwa setiap muslim berhak mendapatkan akses transparan terhadap informasi paket umroh. 
                        Tidak perlu lagi bingung membandingkan harga, fasilitas, dan kuota dari berbagai travel agent — 
                        UmrohQueens menyatukan semuanya dalam satu platform yang mudah digunakan.
                    </p>
                    <p>
                        Dengan lebih dari <strong>50 travel agent partner</strong> terverifikasi dan ratusan paket umroh yang 
                        terupdate secara real-time, UmrohQueens menjadi jembatan terpercaya antara jamaah dan travel agent 
                        berkualitas di seluruh Indonesia.
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="story-image animate__animated animate__fadeInRight">
                    <img src="https://images.unsplash.com/photo-1591604129939-f1efa4d9f7fa?w=800&h=600&fit=crop" 
                         alt="Masjidil Haram - UmrohQueens" loading="lazy">
                    <div class="image-accent">
                        <span class="accent-number">2024</span>
                        <span class="accent-label">Established</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- UNIQUE SELLING POINTS -->
<section class="about-section alt-bg">
    <div class="container">
        <div class="section-heading">
            <h2>Mengapa Memilih UmrohQueens?</h2>
            <div class="gold-line"></div>
            <p>Tiga pilar utama yang menjadikan kami berbeda dari platform lainnya</p>
        </div>

        <div class="row">
            <!-- USP 1: Transparansi Kuota -->
            <div class="col-md-4 mb-4">
                <div class="value-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                    <div class="value-icon">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <h5>Transparansi Kuota Real-Time</h5>
                    <p>
                        Pantau ketersediaan kursi setiap paket umroh secara real-time. Tidak ada lagi informasi yang 
                        menyesatkan — Anda bisa melihat langsung berapa sisa seat, persentase terisi, dan status 
                        keberangkatan dari setiap paket yang ditampilkan di platform kami.
                    </p>
                </div>
            </div>

            <!-- USP 2: AI Search -->
            <div class="col-md-4 mb-4">
                <div class="value-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                    <div class="value-icon">
                        <i class="fa-solid fa-brain"></i>
                    </div>
                    <h5>Pencarian Cerdas via AI</h5>
                    <p>
                        Cukup ketikkan kebutuhan Anda dalam bahasa sehari-hari — 
                        <em>"paket umroh budget 25 juta bulan September"</em> — dan AI Assistant kami akan 
                        mencarikan rekomendasi paket terbaik secara otomatis. Tidak perlu lagi 
                        menelusuri puluhan halaman satu per satu.
                    </p>
                </div>
            </div>

            <!-- USP 3: Keamanan Transaksi -->
            <div class="col-md-4 mb-4">
                <div class="value-card animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                    <div class="value-icon">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h5>Keamanan Transaksi Terjamin</h5>
                    <p>
                        Setiap pembayaran diproses melalui payment gateway resmi (Midtrans) yang telah tersertifikasi 
                        PCI-DSS. Dana Anda tersimpan aman dan baru diteruskan ke travel agent setelah proses 
                        verifikasi selesai, memberikan perlindungan penuh bagi jamaah.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- STATS -->
<section class="about-section">
    <div class="container">
        <div class="stats-bar animate__animated animate__fadeInUp">
            <div class="row">
                <div class="col-6 col-md-3 mb-3 mb-md-0">
                    <div class="stat-item">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">Travel Agent Partner</div>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-3 mb-md-0">
                    <div class="stat-item">
                        <div class="stat-number">200+</div>
                        <div class="stat-label">Paket Umroh</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">10K+</div>
                        <div class="stat-label">Jamaah Terlayani</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">4.8</div>
                        <div class="stat-label">Rating Kepuasan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- VISI & MISI -->
<section class="about-section alt-bg">
    <div class="container">
        <div class="section-heading">
            <h2>Visi & Misi Kami</h2>
            <div class="gold-line"></div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6 mb-4">
                <div class="vision-card animate__animated animate__fadeInLeft">
                    <div class="vision-icon">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <h5>Visi</h5>
                    <p>
                        Menjadi platform agregator umroh terdepan di Indonesia yang mengedepankan transparansi, 
                        teknologi, dan kemudahan akses, sehingga setiap muslim dapat mempersiapkan perjalanan 
                        suci mereka dengan tenang, nyaman, dan penuh keyakinan.
                    </p>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="vision-card animate__animated animate__fadeInRight">
                    <div class="vision-icon">
                        <i class="fa-solid fa-bullseye"></i>
                    </div>
                    <h5>Misi</h5>
                    <p>
                        Menyediakan informasi kuota dan harga paket umroh yang akurat secara real-time. 
                        Memanfaatkan teknologi AI untuk mempermudah pencarian paket sesuai kebutuhan jamaah. 
                        Menjamin keamanan setiap transaksi melalui payment gateway tersertifikasi. 
                        Membangun ekosistem yang saling menguntungkan antara jamaah dan travel agent.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="about-section">
    <div class="container">
        <div class="section-heading">
            <h2>Cara Kerja UmrohQueens</h2>
            <div class="gold-line"></div>
            <p>Hanya 4 langkah mudah menuju perjalanan suci Anda</p>
        </div>

        <div class="row">
            <div class="col-md-3 col-6 mb-4">
                <div class="value-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                    <div class="value-icon" style="background: linear-gradient(135deg, #dbeafe, #bfdbfe);">
                        <span style="font-family: 'Playfair Display', serif; font-weight: 800; font-size: 1.4rem; color: #1e40af;">1</span>
                    </div>
                    <h5>Cari Paket</h5>
                    <p>Gunakan filter atau AI Assistant untuk menemukan paket yang sesuai kebutuhan Anda.</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="value-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                    <div class="value-icon" style="background: linear-gradient(135deg, var(--emerald-50), #d1fae5);">
                        <span style="font-family: 'Playfair Display', serif; font-weight: 800; font-size: 1.4rem; color: var(--emerald-dark);">2</span>
                    </div>
                    <h5>Bandingkan</h5>
                    <p>Bandingkan harga, fasilitas hotel, maskapai, dan kuota dari berbagai travel agent.</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="value-card animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                    <div class="value-icon" style="background: linear-gradient(135deg, #fef3c7, #fde68a);">
                        <span style="font-family: 'Playfair Display', serif; font-weight: 800; font-size: 1.4rem; color: var(--gold-dark);">3</span>
                    </div>
                    <h5>Booking</h5>
                    <p>Daftar dan lakukan pembayaran dengan aman melalui payment gateway tersertifikasi.</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="value-card animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                    <div class="value-icon" style="background: linear-gradient(135deg, #fce7f3, #fbcfe8);">
                        <span style="font-family: 'Playfair Display', serif; font-weight: 800; font-size: 1.4rem; color: #be185d;">4</span>
                    </div>
                    <h5>Berangkat!</h5>
                    <p>Persiapkan diri Anda dan nikmati perjalanan suci bersama travel agent terpercaya.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="about-cta">
    <div class="container">
        <div class="animate__animated animate__fadeInUp">
            <h2>Siap Memulai Perjalanan Suci Anda?</h2>
            <p>Bergabunglah bersama ribuan jamaah yang telah mempercayakan pencarian paket umroh mereka kepada UmrohQueens.</p>
            <a href="/katalog" class="btn btn-gold btn-lg px-5 mr-2">
                <i class="fa-solid fa-search mr-2"></i> Jelajahi Paket
            </a>
            <a href="/register" class="btn btn-outline-light btn-lg px-5">
                <i class="fa-solid fa-user-plus mr-2"></i> Daftar Gratis
            </a>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
