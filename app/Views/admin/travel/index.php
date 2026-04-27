<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid animate__animated animate__fadeIn">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold text-emerald">Kelola Travel Agent</h3>
            <p class="text-muted">Setujui atau kelola kemitraan biro travel umroh.</p>
        </div>
        <button class="btn btn-emerald px-4 shadow-sm" style="border-radius: 12px; background: var(--emerald-dark); color: white;">
            <i class="fas fa-plus mr-2"></i> Tambah Biro Manual
        </button>
    </div>

    <div class="card card-elegant">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr class="text-muted small">
                            <th class="border-0 pl-4">NAMA BIRO / IZIN PPIU</th>
                            <th class="border-0">KONTAK</th>
                            <th class="border-0">STATUS</th>
                            <th class="border-0 text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                            <td class="pl-4 py-4">
                                <div class="d-flex align-items-center">
                                    <div class="icon-shape mr-3" style="width: 45px; height: 45px; background: rgba(212, 175, 55, 0.1);">
                                        <i class="fa-solid fa-mosque text-gold"></i>
                                    </div>
                                    <div>
                                        <span class="d-block font-weight-bold">Al-Amin Universal</span>
                                        <small class="text-muted">PPIU No. 123/2024</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="d-block small"><i class="fa fa-envelope mr-1 text-muted"></i> info@alamin.com</span>
                                <span class="d-block small"><i class="fa fa-phone mr-1 text-muted"></i> 021-555666</span>
                            </td>
                            <td>
                                <span class="badge badge-pill px-3 py-2" style="background: rgba(255, 193, 7, 0.1); color: #856404;">
                                    <i class="fa fa-clock mr-1"></i> Menunggu Verifikasi
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-success mx-1 shadow-sm" title="Approve" style="border-radius: 8px;">
                                        <i class="fa fa-check"></i>
                                    </td>
                                    <button class="btn btn-sm btn-outline-danger mx-1" title="Reject" style="border-radius: 8px;">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <button class="btn btn-sm btn-light mx-1" title="Detail" style="border-radius: 8px;">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>