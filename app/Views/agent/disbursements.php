<?= $this->extend('layouts/admin') ?>
<?= $this->section('sidebar') ?>
<div class="nav-section">Menu Agen</div>
<a class="nav-link" href="/agent/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link" href="/agent/packages"><i class="fa-solid fa-box"></i> Kelola Paket</a>
<a class="nav-link" href="/agent/bookings"><i class="fa-solid fa-ticket-alt"></i> Data Jamaah</a>
<a class="nav-link active" href="/agent/disbursements"><i class="fa-solid fa-money-bill-wave"></i> Pencairan Dana</a>
<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Status Pencairan Dana<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="card-section">
    <h6><i class="fa-solid fa-money-bill-wave mr-2" style="color:var(--gold-accent);"></i>Riwayat Pencairan</h6>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead><tr><th>Kode Booking</th><th>Paket</th><th>Gross</th><th>Komisi</th><th>Net (Diterima)</th><th>Status</th><th>Tanggal</th></tr></thead>
            <tbody>
            <?php if (!empty($disbursements)): foreach ($disbursements as $d): ?>
                <tr>
                    <td><strong><?= esc($d['booking_code']) ?></strong></td>
                    <td><?= esc($d['package_name']) ?></td>
                    <td>Rp <?= number_format($d['gross_amount'], 0, ',', '.') ?></td>
                    <td class="text-danger">- Rp <?= number_format($d['commission_amount'], 0, ',', '.') ?></td>
                    <td class="text-success font-weight-bold">Rp <?= number_format($d['net_amount'], 0, ',', '.') ?></td>
                    <td><span class="badge badge-<?= $d['status'] === 'completed' ? 'lunas' : 'processing' ?> px-3 py-1" style="border-radius:8px;"><?= ucfirst($d['status']) ?></span></td>
                    <td><?= $d['disbursed_at'] ? date('d/m/Y', strtotime($d['disbursed_at'])) : '-' ?></td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="7" class="text-center text-muted py-4">Belum ada data pencairan.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
