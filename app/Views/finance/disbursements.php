<?= $this->extend('layouts/admin') ?>
<?= $this->section('sidebar') ?>
<div class="nav-section">Menu Keuangan</div>
<a class="nav-link" href="/finance/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link" href="/finance/transactions"><i class="fa-solid fa-receipt"></i> Transaksi</a>
<a class="nav-link active" href="/finance/disbursements"><i class="fa-solid fa-money-bill-wave"></i> Pencairan Dana</a>
<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Pencairan Dana ke Agen<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="alert alert-info" style="border-radius:12px;border:none;background:#eff6ff;">
    <i class="fa-solid fa-info-circle mr-2"></i>
    Dana hanya muncul di daftar <strong>"Siap Cair"</strong> jika tanggal keberangkatan paket sudah mencapai <strong>H-14</strong>. Komisi platform: <strong><?= $commissionRate ?>%</strong>.
</div>
<div class="card-section">
    <h6><i class="fa-solid fa-money-bill-wave mr-2" style="color:var(--gold-accent);"></i>Daftar Siap Cair</h6>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead><tr><th>Kode Booking</th><th>Paket</th><th>Agen</th><th>Berangkat</th><th>Harga Paket</th><th>Komisi (<?= $commissionRate ?>%)</th><th>Net ke Agen</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
            <?php if (!empty($disbursementList)): foreach ($disbursementList as $item):
                $b = $item['booking'];
                $d = $item['disbursement'];
            ?>
                <tr>
                    <td><strong><?= esc($b['booking_code']) ?></strong></td>
                    <td><?= esc($b['package_name']) ?></td>
                    <td><?= esc($b['travel_name']) ?></td>
                    <td><?= date('d/m/Y', strtotime($b['tanggal_berangkat'])) ?></td>
                    <td>Rp <?= number_format($item['gross_amount'], 0, ',', '.') ?></td>
                    <td class="text-danger">- Rp <?= number_format($item['commission_amount'], 0, ',', '.') ?></td>
                    <td class="text-success font-weight-bold">Rp <?= number_format($item['net_amount'], 0, ',', '.') ?></td>
                    <td>
                        <?php if ($d): ?>
                            <span class="badge badge-<?= $d['status'] === 'completed' ? 'lunas' : 'processing' ?> px-3 py-1" style="border-radius:8px;"><?= ucfirst($d['status']) ?></span>
                        <?php else: ?>
                            <span class="badge badge-pending px-3 py-1" style="border-radius:8px;">Belum Diproses</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (!$d): ?>
                            <form method="POST" action="/finance/disbursements/process/<?= $b['id'] ?>" style="display:inline;">
                                <button type="submit" class="btn btn-sm text-white px-3" style="background:var(--emerald);border-radius:8px;" onclick="return confirm('Proses pencairan dana ini?')">
                                    <i class="fa fa-paper-plane mr-1"></i> Cairkan
                                </button>
                            </form>
                        <?php else: ?>
                            <span class="text-muted">-</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="9" class="text-center text-muted py-4">Belum ada transaksi yang siap dicairkan.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
