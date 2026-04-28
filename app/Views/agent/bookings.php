<?= $this->extend('layouts/admin') ?>
<?= $this->section('sidebar') ?>
<div class="nav-section">Menu Agen</div>
<a class="nav-link" href="/agent/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link" href="/agent/packages"><i class="fa-solid fa-box"></i> Kelola Paket</a>
<a class="nav-link active" href="/agent/bookings"><i class="fa-solid fa-ticket-alt"></i> Data Jamaah</a>
<a class="nav-link" href="/agent/disbursements"><i class="fa-solid fa-money-bill-wave"></i> Pencairan Dana</a>
<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Data Jamaah<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="card-section">
    <h6><i class="fa-solid fa-users mr-2" style="color:var(--emerald);"></i>Jamaah yang Booking Paket Anda</h6>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead><tr><th>Kode Booking</th><th>Nama Jamaah</th><th>Email</th><th>Telepon</th><th>Paket</th><th>Total</th><th>Status</th><th>Tanggal</th></tr></thead>
            <tbody>
            <?php if (!empty($bookings)): foreach ($bookings as $b): ?>
                <tr>
                    <td><strong><?= esc($b['booking_code']) ?></strong></td>
                    <td><?= esc($b['user_name']) ?></td>
                    <td><?= esc($b['user_email']) ?></td>
                    <td><?= esc($b['user_phone'] ?? '-') ?></td>
                    <td><?= esc($b['package_name']) ?></td>
                    <td>Rp <?= number_format($b['total_price'], 0, ',', '.') ?></td>
                    <td><span class="badge badge-<?= $b['status'] === 'lunas' ? 'lunas' : ($b['status'] === 'pending' ? 'pending' : 'cancelled') ?> px-3 py-1" style="border-radius:8px;"><?= ucfirst($b['status']) ?></span></td>
                    <td><?= date('d/m/Y', strtotime($b['created_at'])) ?></td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="8" class="text-center text-muted py-4">Belum ada data jamaah.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
