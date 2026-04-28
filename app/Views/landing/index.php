<?= $this->extend('layouts/public') ?>

<?= $this->section('styles') ?>
<style>
    /* ===== HERO SECTION ===== */
    .hero-section {
        min-height: 100vh;
        background: linear-gradient(160deg, #022c22 0%, var(--emerald-dark) 40%, var(--emerald-light) 100%);
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
        padding-top: 80px;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23d4af37' fill-opacity='0.04'%3E%3Cpath d='M50 50c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10s-10-4.477-10-10 4.477-10 10-10zM10 10c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10S0 25.523 0 20s4.477-10 10-10z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        opacity: 0.6;
    }
    .hero-glow {
        position: absolute;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(212, 175, 55, 0.15) 0%, transparent 70%);
        border-radius: 50%;
        top: 10%;
        right: -10%;
        animation: pulseGlow 4s ease-in-out infinite;
    }
    .hero-glow-2 {
        position: absolute;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%);
        border-radius: 50%;
        bottom: -10%;
        left: -5%;
        animation: pulseGlow 6s ease-in-out infinite reverse;
    }
    @keyframes pulseGlow {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.2); opacity: 1; }
    }
    .hero-content {
        position: relative;
        z-index: 2;
        color: #fff;
        text-align: center;
        padding: 60px 0;
    }
    .hero-content h1 {
        font-size: 3.2rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 20px;
        text-shadow: 0 2px 15px rgba(0,0,0,0.2);
    }
    .hero-content h1 .gold-text {
        color: var(--gold-accent);
        position: relative;
    }
    .hero-content p.lead {
        font-size: 1.15rem;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto 40px;
        font-weight: 300;
    }

    /* AI Search Box */
    .ai-search-box {
        max-width: 700px;
        margin: 0 auto;
        position: relative;
    }
    .ai-search-box .search-wrapper {
        background: rgba(255,255,255,0.12);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        padding: 8px;
        border: 1px solid rgba(255,255,255,0.2);
        transition: all 0.3s ease;
    }
    .ai-search-box .search-wrapper:focus-within {
        background: rgba(255,255,255,0.2);
        border-color: var(--gold-accent);
        box-shadow: 0 0 30px rgba(212, 175, 55, 0.15);
    }
    .ai-search-box input {
        background: transparent;
        border: none;
        color: #fff;
        font-size: 1.05rem;
        padding: 16px 20px;
        width: calc(100% - 60px);
        outline: none;
    }
    .ai-search-box input::placeholder {
        color: rgba(255,255,255,0.6);
    }
    .ai-search-box .btn-search {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: var(--gold-accent);
        border: none;
        color: var(--emerald-dark);
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s;
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
    }
    .ai-search-box .btn-search:hover {
        background: var(--gold-light);
        transform: translateY(-50%) scale(1.05);
    }
    .ai-label {
        display: inline-flex;
        align-items: center;
        background: rgba(212, 175, 55, 0.15);
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.8rem;
        color: var(--gold-accent);
        margin-bottom: 20px;
        border: 1px solid rgba(212, 175, 55, 0.3);
    }
    .ai-label i { margin-right: 6px; }
    .hero-stats {
        margin-top: 50px;
        display: flex;
        justify-content: center;
        gap: 50px;
    }
    .hero-stat {
        text-align: center;
    }
    .hero-stat h3 {
        font-family: 'Poppins', sans-serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--gold-accent);
    }
    .hero-stat p {
        font-size: 0.85rem;
        opacity: 0.7;
        margin: 0;
    }

    /* ===== FEATURES ===== */
    .features-section {
        padding: 100px 0;
        background: #fff;
    }
    .feature-card {
        background: var(--glass);
        border: 1px solid #f1f5f9;
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        transition: all 0.4s ease;
        height: 100%;
    }
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(6, 78, 59, 0.1);
        border-color: var(--gold-accent);
    }
    .feature-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--emerald-50), #d1fae5);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        font-size: 1.8rem;
        color: var(--emerald-dark);
        transition: all 0.3s;
    }
    .feature-card:hover .feature-icon {
        background: linear-gradient(135deg, var(--gold-accent), var(--gold-dark));
        color: #fff;
        transform: rotateY(180deg);
    }
    .feature-card h5 {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        color: var(--emerald-dark);
        margin-bottom: 12px;
    }
    .feature-card p {
        color: var(--text-muted);
        font-size: 0.9rem;
        line-height: 1.7;
    }

    /* ===== FEATURED PACKAGES ===== */
    .packages-section {
        padding: 100px 0;
        background: linear-gradient(180deg, #f8fffe 0%, #fff 100%);
    }
    .package-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 5px 25px rgba(0,0,0,0.06);
        transition: all 0.4s ease;
        height: 100%;
        border: 1px solid #f1f5f9;
    }
    .package-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.12);
    }
    .package-img {
        position: relative;
        height: 220px;
        overflow: hidden;
    }
    .package-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }
    .package-card:hover .package-img img {
        transform: scale(1.1);
    }
    .package-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 5px 14px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        backdrop-filter: blur(10px);
    }
    .badge-available {
        background: rgba(22, 163, 74, 0.9);
        color: #fff;
    }
    .badge-limited {
        background: rgba(234, 179, 8, 0.9);
        color: #fff;
    }
    .badge-full {
        background: rgba(220, 38, 38, 0.9);
        color: #fff;
    }
    .package-body {
        padding: 25px;
    }
    .travel-name {
        display: inline-flex;
        align-items: center;
        background: var(--emerald-50);
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--emerald);
        margin-bottom: 10px;
    }
    .travel-name i { margin-right: 5px; }
    .package-body h5 {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 1.05rem;
        color: var(--text-dark);
        margin-bottom: 12px;
    }
    .package-meta {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }
    .package-meta span {
        font-size: 0.8rem;
        color: var(--text-muted);
    }
    .package-meta span i {
        color: var(--gold-accent);
        margin-right: 4px;
    }
    .package-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid #f1f5f9;
    }
    .package-price {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        color: var(--emerald-dark);
        font-size: 1.1rem;
    }
    .package-price small {
        font-size: 0.75rem;
        font-weight: 400;
        color: var(--text-muted);
    }
    .btn-detail {
        background: var(--emerald-dark);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 8px 20px;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s;
    }
    .btn-detail:hover {
        background: var(--gold-accent);
        color: var(--emerald-dark);
        transform: translateX(3px);
    }

    /* ===== CTA ===== */
    .cta-section {
        padding: 100px 0;
        background: linear-gradient(135deg, var(--emerald-dark) 0%, #022c22 100%);
        position: relative;
        overflow: hidden;
    }
    .cta-section::before {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(212,175,55,0.1) 0%, transparent 70%);
        border-radius: 50%;
        top: -100px;
        left: -100px;
    }
    .cta-section::after {
        content: '';
        position: absolute;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(212,175,55,0.08) 0%, transparent 70%);
        border-radius: 50%;
        bottom: -150px;
        right: -100px;
    }
    .cta-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: #fff;
    }
    .cta-content h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 15px;
    }
    .cta-content p {
        font-size: 1.1rem;
        opacity: 0.8;
        max-width: 550px;
        margin: 0 auto 35px;
    }

    /* ===== AI RESULTS ===== */
    .ai-results {
        max-width: 700px;
        margin: 20px auto 0;
        display: none;
    }
    .ai-results .result-card {
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        padding: 20px;
        border: 1px solid rgba(255,255,255,0.15);
        text-align: left;
    }
    .ai-results .result-card h6 {
        color: var(--gold-accent);
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        margin-bottom: 10px;
        font-size: 0.9rem;
    }
    .typing-indicator {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 8px 16px;
        background: rgba(255,255,255,0.08);
        border-radius: 12px;
    }
    .typing-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--gold-accent);
        animation: typingBounce 1.4s infinite;
    }
    .typing-dot:nth-child(2) { animation-delay: 0.2s; }
    .typing-dot:nth-child(3) { animation-delay: 0.4s; }
    @keyframes typingBounce {
        0%, 60%, 100% { transform: translateY(0); }
        30% { transform: translateY(-8px); }
    }

    @media (max-width: 768px) {
        .hero-content h1 { font-size: 2rem; }
        .hero-stats { gap: 25px; flex-wrap: wrap; }
        .hero-stat h3 { font-size: 1.3rem; }
        .cta-content h2 { font-size: 1.6rem; }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- HERO SECTION -->
<section class="hero-section" id="hero">
    <div class="hero-glow"></div>
    <div class="hero-glow-2"></div>
    <div class="container">
        <div class="hero-content animate__animated animate__fadeInUp">
            <div class="ai-label">
                <i class="fa-solid fa-sparkles"></i> Powered by AI Assistant
            </div>
            <h1>Temukan Paket Umroh<br>Terbaik dengan <span class="gold-text">AI</span></h1>
            <p class="lead">Bandingkan ratusan paket umroh dari travel terpercaya. Cukup ceritakan kebutuhan Anda, AI kami akan mencarikan yang paling sesuai.</p>

            <div class="ai-search-box">
                <div class="search-wrapper d-flex align-items-center">
                    <i class="fa-solid fa-wand-magic-sparkles ml-3" style="color: var(--gold-accent); font-size: 1.2rem;"></i>
                    <input type="text" id="aiSearchInput"
                           placeholder="Cari paket berdasarkan budget atau bulan keberangkatan..."
                           autocomplete="off">
                    <button class="btn-search" id="aiSearchBtn" title="Cari dengan AI">
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>

            <div class="ai-results" id="aiResults">
                <div class="result-card">
                    <h6><i class="fa-solid fa-robot mr-1"></i> AI Menemukan Rekomendasi</h6>
                    <div id="aiResultContent"></div>
                </div>
            </div>

            <div class="hero-stats">
                <div class="hero-stat">
                    <h3>50+</h3>
                    <p>Travel Agent</p>
                </div>
                <div class="hero-stat">
                    <h3>200+</h3>
                    <p>Paket Tersedia</p>
                </div>
                <div class="hero-stat">
                    <h3>10K+</h3>
                    <p>Jamaah Terlayani</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES SECTION -->
<section class="features-section" id="features">
    <div class="container">
        <div class="section-heading">
            <h2>Kenapa Memilih UmrohQueens?</h2>
            <div class="gold-line"></div>
            <p>Kami menghadirkan teknologi terkini untuk memudahkan perjalanan suci Anda</p>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                    <div class="feature-icon">
                        <i class="fa-solid fa-brain"></i>
                    </div>
                    <h5>AI Smart Filtering</h5>
                    <p>Cukup ceritakan kebutuhan Anda dalam bahasa sehari-hari, AI kami akan mencarikan paket umroh yang paling sesuai dengan budget dan preferensi Anda.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                    <div class="feature-icon">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <h5>Real-time Quota</h5>
                    <p>Pantau ketersediaan kuota paket umroh secara real-time. Jangan sampai kehabisan kursi untuk keberangkatan impian Anda.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                    <div class="feature-icon">
                        <i class="fa-solid fa-newspaper"></i>
                    </div>
                    <h5>Daily News</h5>
                    <p>Dapatkan berita dan informasi terkini seputar umroh, regulasi visa, dan tips perjalanan langsung di platform kami.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FEATURED PACKAGES -->
<section class="packages-section" id="packages">
    <div class="container">
        <div class="section-heading">
            <h2>Paket Umroh Populer</h2>
            <div class="gold-line"></div>
            <p>Pilihan paket terbaik yang paling banyak diminati jamaah</p>
        </div>

        <div class="row">
            <?php if (!empty($featuredPackages)): ?>
                <?php foreach ($featuredPackages as $pkg): ?>
                    <div class="col-md-4 mb-4">
                        <div class="package-card animate__animated animate__fadeInUp">
                            <div class="package-img">
                                <img src="<?= esc($pkg['image'] ?? '') ?>" alt="<?= esc($pkg['nama_paket']) ?>" loading="lazy">
                                <?php
                                    $remaining = (int)($pkg['available_seat'] ?? 0);
                                    if ($remaining > 10) {
                                        $badgeClass = 'badge-available';
                                        $badgeText = 'Tersedia ' . $remaining . ' kursi';
                                    } elseif ($remaining > 0) {
                                        $badgeClass = 'badge-limited';
                                        $badgeText = 'Sisa ' . $remaining . ' kursi!';
                                    } else {
                                        $badgeClass = 'badge-full';
                                        $badgeText = 'SOLD OUT';
                                    }
                                ?>
                                <span class="package-badge <?= $badgeClass ?>"><?= $badgeText ?></span>
                            </div>
                            <div class="package-body">
                                <div class="travel-name">
                                    <i class="fa-solid fa-building"></i> <?= esc($pkg['travel_name']) ?>
                                </div>
                                <h5><?= esc($pkg['nama_paket']) ?></h5>
                                <div class="package-meta">
                                    <span><i class="fa-solid fa-calendar-days"></i> <?= esc($pkg['program_hari']) ?> Hari</span>
                                    <span><i class="fa-solid fa-mosque"></i> <?= ($pkg['bintang_madinah'] ?? 3) ?>★</span>
                                    <span><i class="fa-solid fa-kaaba"></i> <?= ($pkg['bintang_mekkah'] ?? 3) ?>★</span>
                                    <span><i class="fa-solid fa-plane"></i> <?= esc($pkg['maskapai'] ?? '') ?></span>
                                </div>
                                <div class="package-footer">
                                    <div class="package-price">
                                        Rp <?= number_format($pkg['harga_jual'], 0, ',', '.') ?>
                                        <br><small>/jamaah</small>
                                    </div>
                                    <a href="/katalog/detail/<?= $pkg['id'] ?>" class="btn btn-detail">
                                        Lihat Detail <i class="fa fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="fa-solid fa-box-open fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada paket tersedia. Silakan jalankan database seeder.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="text-center mt-4">
            <a href="/katalog" class="btn btn-emerald px-5 py-3">
                Lihat Semua Paket <i class="fa fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section class="cta-section" id="cta">
    <div class="container">
        <div class="cta-content animate__animated animate__fadeInUp">
            <h2>Siap Memulai Perjalanan Suci?</h2>
            <p>Daftar sekarang dan dapatkan akses ke AI Assistant kami untuk menemukan paket umroh yang sempurna.</p>
            <a href="/register" class="btn btn-gold btn-lg px-5">
                <i class="fa-solid fa-user-plus mr-2"></i> Daftar Gratis Sekarang
            </a>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // AI Search interaction (Real API Integration)
    document.getElementById('aiSearchBtn').addEventListener('click', async function() {
        const input = document.getElementById('aiSearchInput');
        const query = input.value.trim();
        if (!query) {
            input.focus();
            return;
        }

        const resultsDiv = document.getElementById('aiResults');
        const contentDiv = document.getElementById('aiResultContent');

        resultsDiv.style.display = 'block';
        contentDiv.innerHTML = '<div class="typing-indicator"><div class="typing-dot"></div><div class="typing-dot"></div><div class="typing-dot"></div></div><span class="ml-2 small" style="color:rgba(255,255,255,0.7);">AI sedang mencari paket terbaik...</span>';

        try {
            const response = await fetch('/api/ai/search', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ prompt: query })
            });

            const result = await response.json();

            if (result.status === 'success' && result.packages.length > 0) {
                let html = `<p class="small mb-2" style="color:rgba(255,255,255,0.9);">Ditemukan <strong>${result.total}</strong> paket yang cocok untuk Anda:</p>`;
                html += '<div class="list-group list-group-flush bg-transparent border-0">';
                
                result.packages.slice(0, 3).forEach(pkg => {
                    html += `
                        <a href="/katalog/detail/${pkg.id}" class="list-group-item list-group-item-action bg-transparent border-0 px-0 py-2 text-white d-flex align-items-center">
                            <img src="${pkg.image || ''}" class="rounded mr-3" width="50" height="40" style="object-fit:cover;">
                            <div>
                                <div class="font-weight-bold small">${pkg.nama_paket}</div>
                                <div class="small" style="color:var(--gold-accent);">Rp ${new Intl.NumberFormat('id-ID').format(pkg.harga_jual)}</div>
                            </div>
                        </a>
                    `;
                });
                
                html += '</div>';
                html += `<a href="/katalog" class="btn btn-sm btn-gold mt-3 w-100"><i class="fa fa-search mr-1"></i> Lihat Semua Hasil</a>`;
                contentDiv.innerHTML = html;
            } else {
                contentDiv.innerHTML = '<p class="small mb-0 text-white-50">Maaf, saya tidak menemukan paket yang sesuai. Coba cari dengan kriteria lain.</p>';
            }
        } catch (error) {
            console.error('AI Error:', error);
            contentDiv.innerHTML = '<p class="small mb-0 text-danger">Terjadi kesalahan koneksi. Silakan coba lagi nanti.</p>';
        }
    });

    document.getElementById('aiSearchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            document.getElementById('aiSearchBtn').click();
        }
    });
</script>
<?= $this->endSection() ?>
