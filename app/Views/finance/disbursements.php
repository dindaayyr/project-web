<?= $this->extend('layouts/admin') ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">Menu Keuangan</div>
<a class="nav-link" href="/finance/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link" href="/finance/transactions"><i class="fa-solid fa-receipt"></i> Transaksi</a>
<a class="nav-link active" href="/finance/disbursements"><i class="fa-solid fa-money-bill-wave"></i> Pencairan Dana</a>
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>Pencairan Dana ke Agen<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="alert alert-info" style="border-radius:12px;border:none;background:#eff6ff; color: #1e40af;">
    <i class="fa-solid fa-info-circle mr-2"></i>
    Dana hanya muncul di daftar <strong>"Siap Cair"</strong> jika tanggal keberangkatan paket sudah mencapai <strong>H-14</strong>. Komisi platform: <strong><?= $commissionRate ?>%</strong>.
</div>

<div class="card-section">
    <h6><i class="fa-solid fa-money-bill-wave mr-2" style="color:#d4af37;"></i>Daftar Siap Cair</h6>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Paket</th>
                    <th>Agen Travel</th>
                    <th>Berangkat</th>
                    <th>Total Bayar</th>
                    <th>Komisi (<?= $commissionRate ?>%)</th>
                    <th>Net ke Agen</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($disbursementList)): foreach ($disbursementList as $item):
                $b = $item['booking'];
            ?>
                <tr>
                    <td><strong><?= esc($b['order_id']) ?></strong></td>
                    <td><?= esc($b['nama_paket']) ?></td>
                    <td><?= esc($b['travel_name']) ?></td>
                    <td><?= date('d/m/Y', strtotime($b['tanggal_berangkat'])) ?></td>
                    <td>Rp <?= number_format($item['gross_amount'], 0, ',', '.') ?></td>
                    <td class="text-danger">- Rp <?= number_format($item['commission_amount'], 0, ',', '.') ?></td>
                    <td class="text-success font-weight-bold">Rp <?= number_format($item['net_amount'], 0, ',', '.') ?></td>
                    <td>
                        <form method="POST" action="/finance/disbursements/process/<?= $b['id'] ?>" style="display:inline;">
                            <button type="submit" class="btn btn-sm text-white px-3" style="background:#004d40; border-radius:8px;" onclick="return confirm('Proses pencairan dana ini ke Agen?')">
                                <i class="fa fa-paper-plane mr-1"></i> Cairkan Ke Agen
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="8" class="text-center text-muted py-4">Belum ada transaksi yang siap dicairkan (H-14).</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
