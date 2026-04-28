<?= $this->extend('layouts/public') ?>

<?= $this->section('styles') ?>
<style>
    .katalog-section {
        padding-top: 100px;
        padding-bottom: 80px;
        min-height: 100vh;
        background: #f8fffe;
    }

    /* Sidebar Filter */
    .filter-sidebar {
        background: #fff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.05);
        border: 1px solid #f1f5f9;
        position: sticky;
        top: 90px;
    }
    .filter-title {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--emerald-dark);
        margin-bottom: 25px;
        display: flex;
        align-items: center;
    }
    .filter-title i {
        background: var(--emerald-50);
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        color: var(--emerald-dark);
    }
    .filter-group {
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f1f5f9;
    }
    .filter-group:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .filter-group label.filter-label {
        font-weight: 600;
        font-size: 0.85rem;
        color: #374151;
        margin-bottom: 12px;
        display: block;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .filter-group .form-control {
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.9rem;
        transition: all 0.3s;
    }
    .filter-group .form-control:focus {
        border-color: var(--emerald);
        box-shadow: 0 0 0 3px rgba(4, 120, 87, 0.1);
    }
    .custom-control-label {
        font-size: 0.9rem;
        cursor: pointer;
    }
    .custom-radio .custom-control-input:checked ~ .custom-control-label::before {
        background-color: var(--emerald);
        border-color: var(--emerald);
    }
    .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
        background-color: var(--emerald);
        border-color: var(--emerald);
    }
    .btn-filter {
        width: 100%;
        background: linear-gradient(135deg, var(--emerald-dark), var(--emerald));
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 12px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s;
        margin-top: 10px;
    }
    .btn-filter:hover {
        box-shadow: 0 6px 20px rgba(6, 78, 59, 0.3);
        transform: translateY(-2px);
    }
    .btn-reset {
        width: 100%;
        background: transparent;
        color: var(--text-muted);
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 10px;
        font-weight: 500;
        font-size: 0.85rem;
        transition: all 0.3s;
        margin-top: 8px;
    }
    .btn-reset:hover {
        border-color: #dc2626;
        color: #dc2626;
    }

    /* Sorting Bar */
    .sort-bar {
        background: #fff;
        border-radius: 16px;
        padding: 16px 25px;
        margin-bottom: 25px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.04);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        border: 1px solid #f1f5f9;
    }
    .sort-bar .result-count {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 0.95rem;
    }
    .sort-bar .result-count span {
        color: var(--emerald);
    }
    .sort-buttons {
        display: flex;
        gap: 8px;
    }
    .btn-sort {
        padding: 8px 18px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 500;
        border: 2px solid #e5e7eb;
        background: #fff;
        color: #374151;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
    }
    .btn-sort:hover, .btn-sort.active {
        background: var(--emerald-dark);
        color: #fff;
        border-color: var(--emerald-dark);
        text-decoration: none;
    }

    /* Package Cards */
    .katalog-card {
        background: #fff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 3px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        margin-bottom: 25px;
        border: 1px solid #f1f5f9;
    }
    .katalog-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    }
    .katalog-card .card-row {
        display: flex;
        flex-wrap: wrap;
    }
    .katalog-card .card-img-side {
        width: 280px;
        min-height: 220px;
        position: relative;
        overflow: hidden;
    }
    .katalog-card .card-img-side img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }
    .katalog-card:hover .card-img-side img {
        transform: scale(1.08);
    }
    .katalog-card .card-content {
        flex: 1;
        padding: 25px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .quota-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        position: absolute;
        top: 12px;
        left: 12px;
    }
    .quota-green {
        background: rgba(22, 163, 74, 0.9);
        color: #fff;
    }
    .quota-orange {
        background: rgba(234, 179, 8, 0.9);
        color: #fff;
    }
    .quota-red {
        background: rgba(220, 38, 38, 0.9);
        color: #fff;
    }
    .card-travel-badge {
        display: inline-flex;
        align-items: center;
        background: var(--emerald-50);
        color: var(--emerald);
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-bottom: 8px;
    }
    .card-travel-badge i { margin-right: 5px; }
    .card-content h5 {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 8px;
        font-size: 1.05rem;
    }
    .card-content .meta-row {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 12px;
    }
    .card-content .meta-row span {
        font-size: 0.8rem;
        color: var(--text-muted);
    }
    .card-content .meta-row span i {
        color: var(--gold-accent);
        margin-right: 4px;
        width: 14px;
    }
    .card-price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid #f1f5f9;
    }
    .card-price {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 1.15rem;
        color: var(--emerald-dark);
    }
    .card-price small {
        font-weight: 400;
        font-size: 0.75rem;
        color: var(--text-muted);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    .empty-state i {
        font-size: 3rem;
        color: #d1d5db;
        margin-bottom: 15px;
    }

    @media (max-width: 768px) {
        .katalog-card .card-img-side {
            width: 100%;
            min-height: 200px;
        }
        .sort-bar {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="katalog-section">
    <div class="container-fluid px-4 px-lg-5">
        <div class="row">
            <!-- SIDEBAR FILTER -->
            <div class="col-lg-3 mb-4">
                <div class="filter-sidebar">
                    <div class="filter-title">
                        <i class="fa-solid fa-sliders"></i> Filter Paket
                    </div>

                    <form method="GET" action="/katalog" id="filterForm">
                        <!-- Hidden sort_by to preserve sorting -->
                        <input type="hidden" name="sort_by" value="<?= esc($filters['sort_by'] ?? 'popular') ?>" id="sortInput">

                        <!-- Range Harga -->
                        <div class="filter-group">
                            <label class="filter-label">Range Harga</label>
                            <div class="row">
                                <div class="col-6">
                                    <input type="number" class="form-control" name="min_price"
                                           placeholder="Min" value="<?= esc($filters['min_price'] ?? '') ?>">
                                </div>
                                <div class="col-6">
                                    <input type="number" class="form-control" name="max_price"
                                           placeholder="Max" value="<?= esc($filters['max_price'] ?? '') ?>">
                                </div>
                            </div>
                        </div>

                        <!-- Durasi -->
                        <div class="filter-group">
                            <label class="filter-label">Durasi (Hari)</label>
                            <?php $durations = [5, 7, 9, 10, 12, 14, 15, 16]; ?>
                            <?php foreach ($durations as $d): ?>
                                <div class="custom-control custom-checkbox mb-2">
                                    <input type="checkbox" class="custom-control-input"
                                           id="dur<?= $d ?>" name="duration[]" value="<?= $d ?>"
                                           <?= (is_array($filters['duration'] ?? null) && in_array($d, $filters['duration'])) ? 'checked' : '' ?>>
                                    <label class="custom-control-label" for="dur<?= $d ?>"><?= $d ?> Hari</label>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Bintang Hotel -->
                        <div class="filter-group">
                            <label class="filter-label">Bintang Hotel</label>
                            <?php for ($s = 3; $s <= 5; $s++): ?>
                                <div class="custom-control custom-radio mb-2">
                                    <input type="radio" class="custom-control-input"
                                           id="star<?= $s ?>" name="hotel_star" value="<?= $s ?>"
                                           <?= (($filters['hotel_star'] ?? '') == $s) ? 'checked' : '' ?>>
                                    <label class="custom-control-label" for="star<?= $s ?>">
                                        <?php for ($i = 0; $i < $s; $i++): ?><i class="fa fa-star text-warning" style="font-size:0.75rem;"></i><?php endfor; ?> Bintang <?= $s ?>
                                    </label>
                                </div>
                            <?php endfor; ?>
                        </div>

                        <!-- Maskapai -->
                        <div class="filter-group">
                            <label class="filter-label">Maskapai</label>
                            <select class="form-control" name="airline">
                                <option value="">Semua Maskapai</option>
                                <?php
                                    $airlines = ['Saudi Airlines', 'Garuda Indonesia', 'Emirates', 'Turkish Airlines', 'Lion Air'];
                                    foreach ($airlines as $a):
                                ?>
                                    <option value="<?= $a ?>" <?= (($filters['airline'] ?? '') == $a) ? 'selected' : '' ?>><?= $a ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-filter">
                            <i class="fa fa-search mr-2"></i> Terapkan Filter
                        </button>
                        <a href="/katalog" class="btn btn-reset">
                            <i class="fa fa-rotate-left mr-1"></i> Reset Filter
                        </a>
                    </form>
                </div>
            </div>

            <!-- MAIN CONTENT -->
            <div class="col-lg-9">
                <!-- Sort Bar -->
                <div class="sort-bar">
                    <div class="result-count">
                        Ditemukan <span><?= count($packages) ?></span> paket umroh
                    </div>
                    <div class="sort-buttons">
                        <?php $currentSort = $filters['sort_by'] ?? 'popular'; ?>
                        <a href="javascript:void(0)" class="btn-sort <?= $currentSort == 'popular' ? 'active' : '' ?>"
                           onclick="setSort('popular')">
                            <i class="fa fa-fire mr-1"></i> Terpopuler
                        </a>
                        <a href="javascript:void(0)" class="btn-sort <?= $currentSort == 'cheapest' ? 'active' : '' ?>"
                           onclick="setSort('cheapest')">
                            <i class="fa fa-tag mr-1"></i> Termurah
                        </a>
                        <a href="javascript:void(0)" class="btn-sort <?= $currentSort == 'fastest' ? 'active' : '' ?>"
                           onclick="setSort('fastest')">
                            <i class="fa fa-bolt mr-1"></i> Tercepat
                        </a>
                    </div>
                </div>

                <!-- Package List -->
                <?php if (!empty($packages)): ?>
                    <?php foreach ($packages as $pkg): ?>
                        <?php
                            $totalSeat = (int)($pkg['total_seat'] ?? 0);
                            $jamaah = (int)($pkg['jumlah_jamaah'] ?? 0);
                            $avail = (int)($pkg['available_seat'] ?? $totalSeat);
                            $pct = $totalSeat > 0 ? round(($jamaah / $totalSeat) * 100) : 0;
                            if ($avail > 10) { $qClass='quota-green'; $qText='Tersedia '.$avail; $barC='#16a34a'; }
                            elseif ($avail > 0) { $qClass='quota-orange'; $qText='Sisa '.$avail.'!'; $barC='#eab308'; }
                            else { $qClass='quota-red'; $qText='SOLD OUT'; $barC='#dc2626'; }
                            $bMad = (int)($pkg['bintang_madinah'] ?? 3);
                            $bMek = (int)($pkg['bintang_mekkah'] ?? 3);
                        ?>
                        <div class="katalog-card">
                            <div class="card-row">
                                <div class="card-img-side">
                                    <img src="<?= esc($pkg['image'] ?? '/assets/img/default-package.jpg') ?>" alt="<?= esc($pkg['nama_paket']) ?>" loading="lazy">
                                    <span class="quota-badge <?= $qClass ?>"><i class="fa fa-users mr-1"></i> <?= $qText ?></span>
                                </div>
                                <div class="card-content">
                                    <div>
                                        <div class="d-flex align-items-center flex-wrap mb-2" style="gap:8px;">
                                            <div class="card-travel-badge"><i class="fa-solid fa-building"></i> <?= esc($pkg['travel_name'] ?? '') ?></div>
                                            <?php if (!empty($pkg['maskapai'])): ?>
                                            <span class="badge" style="background:#eef2ff;color:#4338ca;font-size:0.72rem;padding:4px 10px;border-radius:6px;"><i class="fa-solid fa-plane mr-1"></i><?= esc($pkg['maskapai']) ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <h5><?= esc($pkg['nama_paket']) ?></h5>
                                        <!-- Hotel Stars -->
                                        <div class="d-flex flex-wrap mb-2" style="gap:16px;font-size:0.78rem;color:#555;">
                                            <span><i class="fa-solid fa-mosque mr-1" style="color:var(--emerald);"></i>Madinah: <?php for($i=0;$i<$bMad;$i++):?><i class="fa fa-star text-warning" style="font-size:0.6rem;"></i><?php endfor;?> <span style="color:#888;"><?= esc($pkg['hotel_madinah'] ?? '-') ?></span></span>
                                            <span><i class="fa-solid fa-kaaba mr-1" style="color:var(--emerald);"></i>Mekkah: <?php for($i=0;$i<$bMek;$i++):?><i class="fa fa-star text-warning" style="font-size:0.6rem;"></i><?php endfor;?> <span style="color:#888;"><?= esc($pkg['hotel_mekkah'] ?? '-') ?></span></span>
                                        </div>
                                        <div class="meta-row">
                                            <span><i class="fa-solid fa-calendar-days"></i> <?= esc($pkg['program_hari']) ?> Hari</span>
                                            <?php if (!empty($pkg['rute'])): ?><span><i class="fa-solid fa-route"></i> <?= esc($pkg['rute']) ?></span><?php endif; ?>
                                            <?php if (!empty($pkg['departure_city'])): ?><span><i class="fa-solid fa-map-marker-alt"></i> <?= esc($pkg['departure_city']) ?></span><?php endif; ?>
                                            <?php if (!empty($pkg['tanggal_berangkat'])): ?><span><i class="fa-solid fa-clock"></i> <?= date('d M Y', strtotime($pkg['tanggal_berangkat'])) ?></span><?php endif; ?>
                                        </div>
                                        <!-- Quota Progress Bar -->
                                        <div class="mt-2 mb-1">
                                            <div class="d-flex justify-content-between" style="font-size:0.75rem;color:var(--text-muted);">
                                                <span>Kuota Terisi</span><span><strong><?= $jamaah ?></strong> / <?= $totalSeat ?> seat</span>
                                            </div>
                                            <div style="height:6px;background:#e5e7eb;border-radius:6px;overflow:hidden;">
                                                <div style="height:100%;width:<?= $pct ?>%;background:<?= $barC ?>;border-radius:6px;transition:width .6s;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-price-row">
                                        <div class="card-price">
                                            Rp <?= number_format($pkg['harga_jual'], 0, ',', '.') ?>
                                            <br><small>/jamaah</small>
                                        </div>
                                        <a href="/katalog/detail/<?= $pkg['id'] ?>" class="btn btn-emerald btn-sm px-4">
                                            Lihat Detail <i class="fa fa-arrow-right ml-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fa-solid fa-search"></i>
                        <h5 class="text-muted mt-2">Tidak ada paket ditemukan</h5>
                        <p class="text-muted">Coba ubah filter pencarian Anda.</p>
                        <a href="/katalog" class="btn btn-emerald mt-3">Reset Filter</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function setSort(sortBy) {
        document.getElementById('sortInput').value = sortBy;
        document.getElementById('filterForm').submit();
    }
</script>
<?= $this->endSection() ?>
