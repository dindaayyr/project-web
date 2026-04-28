<?= $this->extend('layouts/admin') ?>
<?= $this->section('sidebar') ?>
<div class="nav-section">Super Admin</div>
<a class="nav-link" href="/superadmin/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link" href="/superadmin/agents"><i class="fa-solid fa-building"></i> Agen Travel</a>
<a class="nav-link" href="/superadmin/packages"><i class="fa-solid fa-box"></i> Semua Paket</a>
<a class="nav-link active" href="/superadmin/ai-config"><i class="fa-solid fa-robot"></i> Konfigurasi AI</a>
<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Konfigurasi AI Assistant<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="card-section">
    <h6><i class="fa-solid fa-robot mr-2" style="color:var(--gold-accent);"></i>Pengaturan API AI (Gemini)</h6>
    <form method="POST" action="/superadmin/ai-config/save">
        <div class="form-group">
            <label class="font-weight-bold">API Key</label>
            <input type="password" class="form-control" name="ai_api_key" value="<?= esc($aiApiKey) ?>" placeholder="Masukkan Gemini API Key..." style="border-radius:10px;">
            <small class="text-muted">API key disimpan di file .env sebagai <code>AI_API_KEY</code></small>
        </div>
        <div class="form-group">
            <label class="font-weight-bold">Status Koneksi</label>
            <div>
                <?php if (!empty($aiApiKey)): ?>
                    <span class="badge badge-lunas px-3 py-2" style="border-radius:8px;"><i class="fa fa-check-circle mr-1"></i> API Key Terkonfigurasi</span>
                <?php else: ?>
                    <span class="badge badge-pending px-3 py-2" style="border-radius:8px;"><i class="fa fa-exclamation-triangle mr-1"></i> Belum Dikonfigurasi (Menggunakan Rule-based Fallback)</span>
                <?php endif; ?>
            </div>
        </div>
        <button type="submit" class="btn text-white px-5 mt-3" style="background:var(--emerald);border-radius:10px;">Simpan Konfigurasi</button>
    </form>
</div>
<div class="card-section mt-4">
    <h6><i class="fa-solid fa-flask mr-2" style="color:var(--emerald);"></i>Test AI Search</h6>
    <div class="form-group">
        <input type="text" class="form-control" id="testPrompt" placeholder="Contoh: Cari paket hotel bintang 5 murah" style="border-radius:10px;">
    </div>
    <button onclick="testAi()" class="btn text-white px-4" style="background:var(--emerald-dark);border-radius:10px;"><i class="fa fa-paper-plane mr-1"></i> Test</button>
    <pre id="testResult" class="mt-3 p-3" style="background:#f8f9fa;border-radius:10px;display:none;max-height:300px;overflow:auto;"></pre>
</div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script>
function testAi() {
    var prompt = document.getElementById('testPrompt').value;
    if (!prompt) return;
    var el = document.getElementById('testResult');
    el.style.display = 'block';
    el.textContent = 'Loading...';
    $.ajax({
        url: '/api/ai/search-nlp',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({query: prompt}),
        success: function(res) { el.textContent = JSON.stringify(res, null, 2); },
        error: function(err) { el.textContent = 'Error: ' + err.statusText; }
    });
}
</script>
<?= $this->endSection() ?>
