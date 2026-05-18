<?= $this->extend('layouts/admin') ?>

<?= $this->section('sidebar') ?>
<div class="nav-section">Menu Keuangan</div>
<a class="nav-link" href="/finance/dashboard"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
<a class="nav-link active" href="/finance/transactions"><i class="fa-solid fa-receipt"></i> Transaksi</a>
<a class="nav-link" href="/finance/disbursements"><i class="fa-solid fa-money-bill-wave"></i> Pencairan Dana</a>
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>Daftar Transaksi & Pencairan<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .stats-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 28px; }
    .stat-widget { background: #fff; border-radius: 16px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.04); border: 1px solid #f1f5f9; display: flex; align-items: center; gap: 16px; transition: transform 0.2s, box-shadow 0.2s; }
    .stat-widget:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.08); }
    .stat-widget .icon-box { width: 52px; height: 52px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0; }
    .stat-widget .info h3 { font-weight: 700; font-size: 1.4rem; margin: 0 0 2px; }
    .stat-widget .info small { color: #6b7280; font-size: 0.78rem; }
    .icon-waiting { background: linear-gradient(135deg, #fef9c3, #fde68a); color: #854d0e; }
    .icon-ready { background: linear-gradient(135deg, #dcfce7, #bbf7d0); color: #166534; }
    .icon-total { background: linear-gradient(135deg, #dbeafe, #bfdbfe); color: #1e40af; }
    .badge-status { padding: 5px 14px; border-radius: 20px; font-size: 0.76rem; font-weight: 600; display: inline-flex; align-items: center; gap: 5px; }
    .badge-success-custom { background: #dcfce7; color: #166534; }
    .badge-pending-custom { background: #fef9c3; color: #854d0e; }
    .badge-failed-custom { background: #fee2e2; color: #991b1b; }
    .badge-disbursed-custom { background: #dbeafe; color: #1e40af; }
    .btn-disburse { background: linear-gradient(135deg, #047857, #064e3b); color: #fff; border: none; border-radius: 8px; padding: 6px 14px; font-size: 0.78rem; font-weight: 600; transition: all 0.3s; }
    .btn-disburse:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(4,120,87,0.3); color: #fff; }
    .btn-disburse:disabled, .btn-disburse.disabled { background: #d1d5db; color: #9ca3af; cursor: not-allowed; transform: none; box-shadow: none; }
    .btn-refresh { background: linear-gradient(135deg, #047857, #064e3b); color: #fff; border: none; border-radius: 10px; padding: 8px 18px; font-size: 0.82rem; font-weight: 600; transition: all 0.3s; }
    .btn-refresh:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(4,120,87,0.3); color: #fff; }
    .btn-sync { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; border-radius: 8px; padding: 4px 12px; font-size: 0.75rem; font-weight: 600; transition: all 0.2s; }
    .btn-sync:hover { background: #166534; color: #fff; }
    .profit-col { color: #d4af37; font-weight: 700; }
    .h14-info { font-size: 0.7rem; color: #9ca3af; margin-top: 3px; }
    .table-section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; flex-wrap: wrap; gap: 10px; }
    [data-toggle="tooltip"] { cursor: help; }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Info Banner -->
<div class="alert" style="border-radius:14px; border:none; background: linear-gradient(135deg, #eff6ff, #f0fdf4); color: #1e40af; padding: 16px 22px; margin-bottom: 24px;">
    <i class="fa-solid fa-info-circle mr-2"></i>
    Dana hanya bisa dicairkan jika tanggal keberangkatan sudah <strong>H-14</strong> atau kurang. Komisi platform: <strong><?= $commissionRate ?>%</strong>.
</div>

<!-- Stats Cards -->
<div class="stats-row">
    <div class="stat-widget">
        <div class="icon-box icon-total"><i class="fa-solid fa-receipt"></i></div>
        <div class="info">
            <h3><?= $totalAll ?></h3>
            <small>Total Transaksi Settled</small>
        </div>
    </div>
    <div class="stat-widget">
        <div class="icon-box icon-waiting"><i class="fa-solid fa-hourglass-half"></i></div>
        <div class="info">
            <h3><?= $totalWaiting ?></h3>
            <small>Menunggu Pencairan</small>
        </div>
    </div>
    <div class="stat-widget">
        <div class="icon-box icon-ready"><i class="fa-solid fa-check-double"></i></div>
        <div class="info">
            <h3><?= $totalReady ?></h3>
            <small>Siap Cair (H-14)</small>
        </div>
    </div>
</div>

<!-- Transaction Table -->
<div class="card-section">
    <div class="table-section-header">
        <h6 style="margin:0;"><i class="fa-solid fa-receipt mr-2" style="color:#d4af37;"></i>Data Transaksi Settled & Pencairan</h6>
        <button class="btn-refresh" onclick="location.reload()">
            <i class="fa-solid fa-arrows-rotate mr-1"></i> Refresh Data
        </button>
    </div>
    <div class="table-responsive">
        <table class="table table-hover" id="financeTable">
            <thead>
                <tr>
                    <th style="cursor:pointer;" onclick="sortTable(0)">Order ID <i class="fa-solid fa-sort fa-xs"></i></th>
                    <th>Jamaah</th>
                    <th>Paket</th>
                    <th>Agen Travel</th>
                    <th>Berangkat</th>
                    <th>Total Bayar</th>
                    <th>Komisi (<?= $commissionRate ?>%)</th>
                    <th>Net ke Agen</th>
                    <th>Net Profit Platform</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($transactionList)): foreach ($transactionList as $item):
                $b = $item['booking'];
                $settlementStatus = $item['settlement_status'];
                $isH14Ready = $item['is_h14_ready'];
                $daysLeft = $item['days_until_departure'];
            ?>
                <tr>
                    <td><strong style="color:#047857;"><?= esc($b['booking_code']) ?></strong></td>
                    <td><?= esc($b['user_name'] ?? $b['jamaah_name'] ?? '-') ?></td>
                    <td><?= esc($b['nama_paket'] ?? '-') ?></td>
                    <td><span class="text-muted"><?= esc($b['travel_name'] ?? '-') ?></span></td>
                    <td>
                        <?php if (!empty($b['tanggal_berangkat'])): ?>
                            <?= date('d/m/Y', strtotime($b['tanggal_berangkat'])) ?>
                            <div class="h14-info">
                                <?php if ($daysLeft !== null): ?>
                                    <?= $daysLeft == 0 ? 'Hari ini / sudah lewat' : $daysLeft . ' hari lagi' ?>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <span class="text-muted">-</span>
                        <?php endif; ?>
                    </td>
                    <td><strong>Rp <?= number_format($item['gross_amount'], 0, ',', '.') ?></strong></td>
                    <td class="text-danger">- Rp <?= number_format($item['commission_amount'], 0, ',', '.') ?></td>
                    <td class="text-success font-weight-bold">Rp <?= number_format($item['net_to_agent'], 0, ',', '.') ?></td>
                    <td class="profit-col">Rp <?= number_format($item['net_profit_platform'], 0, ',', '.') ?></td>
                    <td>
                        <?php if ($settlementStatus === 'processed'): ?>
                            <span class="badge-status badge-disbursed-custom">
                                <i class="fa-solid fa-check-double"></i> Dicairkan
                            </span>
                        <?php else: ?>
                            <span class="badge-status badge-success-custom">
                                <i class="fa-solid fa-check-circle"></i> Success
                            </span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($settlementStatus === 'processed'): ?>
                            <span class="badge-status badge-disbursed-custom">
                                <i class="fa-solid fa-paper-plane"></i> Sudah Cair
                            </span>
                        <?php elseif ($isH14Ready): ?>
                            <form method="POST" action="/finance/disbursements/process/<?= $b['id'] ?>" style="display:inline;">
                                <button type="submit" class="btn-disburse" onclick="return confirm('Proses pencairan dana ke Agen?')">
                                    <i class="fa-solid fa-paper-plane mr-1"></i> Cairkan
                                </button>
                            </form>
                        <?php else: ?>
                            <button class="btn-disburse disabled" disabled
                                data-toggle="tooltip" data-placement="top"
                                title="Dana ditahan hingga H-14 keberangkatan (<?= $daysLeft !== null ? 'sisa ' . $daysLeft . ' hari' : '-' ?>)">
                                <i class="fa-solid fa-lock mr-1"></i> Ditahan
                            </button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="11" class="text-center text-muted py-4">Belum ada transaksi yang settled.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Init tooltips
$(function () { $('[data-toggle="tooltip"]').tooltip(); });

let sortDirection = {};
function sortTable(colIndex) {
    const table = document.getElementById('financeTable');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));

    if (rows.length <= 1 && rows[0]?.cells.length === 1) return;

    sortDirection[colIndex] = !sortDirection[colIndex];
    const dir = sortDirection[colIndex] ? 1 : -1;

    rows.sort((a, b) => {
        let aText = a.cells[colIndex]?.textContent.trim() || '';
        let bText = b.cells[colIndex]?.textContent.trim() || '';

        let aNum = parseFloat(aText.replace(/[^0-9.-]/g, ''));
        let bNum = parseFloat(bText.replace(/[^0-9.-]/g, ''));
        if (!isNaN(aNum) && !isNaN(bNum)) return (aNum - bNum) * dir;

        return aText.localeCompare(bText) * dir;
    });

    rows.forEach(row => tbody.appendChild(row));
}
</script>
<?= $this->endSection() ?>
