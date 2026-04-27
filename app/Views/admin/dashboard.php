<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="row animate__animated animate__fadeInUp">
    <div class="col-md-3 mb-4">
        <div class="card card-elegant p-4 border-left" style="border-left: 5px solid var(--gold-accent) !important;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted small font-weight-bold mb-1">TRAVEL AGENT</h6>
                    <h3 class="mb-0 font-weight-bold text-dark">18</h3>
                </div>
                <div class="icon-shape">
                    <i class="fa-solid fa-mosque fa-xl"></i>
                </div>
            </div>
            <p class="mt-3 mb-0 text-success small"><i class="fa fa-arrow-up"></i> 12% dari bulan lalu</p>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card card-elegant p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted small font-weight-bold mb-1">PAKET AKTIF</h6>
                    <h3 class="mb-0 font-weight-bold text-dark">124</h3>
                </div>
                <div class="icon-shape text-primary">
                    <i class="fa-solid fa-plane-departure fa-xl"></i>
                </div>
            </div>
            <div class="progress mt-3" style="height: 6px; border-radius: 10px;">
                <div class="progress-bar" style="width: 65%; background: var(--emerald-light);"></div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card card-elegant p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted small font-weight-bold mb-1">PENDAPATAN</h6>
                    <h3 class="mb-0 font-weight-bold text-dark">Miliar</h3>
                </div>
                <div class="icon-shape text-warning">
                    <i class="fa-solid fa-wallet fa-xl text-gold"></i>
                </div>
            </div>
            <p class="mt-3 mb-0 text-muted small">Estimasi Gross Revenue</p>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card card-elegant p-4 bg-dark text-white" style="background: var(--emerald-dark);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-light small font-weight-bold mb-1">AI ENGINE</h6>
                    <h3 class="mb-0 font-weight-bold">AKTIF</h3>
                </div>
                <div class="text-warning animate__animated animate__pulse animate__infinite">
                    <i class="fa-solid fa-microchip fa-2x"></i>
                </div>
            </div>
            <p class="mt-3 mb-0 small opacity-75">API Gemini 1.5 Pro Connected</p>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-8 animate__animated animate__fadeInLeft">
        <div class="card card-elegant p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="font-weight-bold mb-0 text-dark">Travel Agent Baru</h5>
                <button class="btn btn-sm btn-outline-dark px-3" style="border-radius: 10px;">Lihat Semua</button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-muted small">
                            <th>BIRO TRAVEL</th>
                            <th>LOKASI</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="mr-3 bg-light rounded p-2"><i class="fa fa-mosque text-emerald"></i></div>
                                    <span class="font-weight-bold">Amanah Tour</span>
                                </div>
                            </td>
                            <td>Jakarta</td>
                            <td><span class="badge badge-pill badge-warning px-3 py-2">Pending</span></td>
                            <td><button class="btn btn-light btn-sm text-emerald"><i class="fa fa-eye"></i></button></td>
                        </tr>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 animate__animated animate__fadeInRight">
        <div class="card card-elegant p-4 bg-white">
            <h5 class="font-weight-bold mb-4">Sistem Kesehatan</h5>
            <div class="mb-4">
                <div class="d-flex justify-content-between mb-2">
                    <span class="small font-weight-bold">API Maskapai</span>
                    <span class="small text-success">Online</span>
                </div>
                <div class="progress" style="height: 4px;">
                    <div class="progress-bar bg-success" style="width: 98%"></div>
                </div>
            </div>
            <div class="mb-2">
                <div class="d-flex justify-content-between mb-2">
                    <span class="small font-weight-bold">AI Response Time</span>
                    <span class="small text-primary">0.8s</span>
                </div>
                <div class="progress" style="height: 4px;">
                    <div class="progress-bar bg-primary" style="width: 92%"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>