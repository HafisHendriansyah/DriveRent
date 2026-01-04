<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-dollar-sign fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Laporan Transaksi</p>
                    <h6 class="mb-0">0</h6>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-car fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Mobil</p>
                    <h6 class="mb-0">{{ $jumlahMobil ?? 0 }}</h6>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-users fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Pelanggan</p>
                    <h6 class="mb-0">{{ $jumlahPelanggan ?? 0 }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
