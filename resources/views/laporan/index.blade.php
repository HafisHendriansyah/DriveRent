@extends('layout.template')

@section('title', 'Laporan Transaksi')

@section('content')
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0">Data Laporan Transaksi</h5>
                <a href="{{ route('home') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <form method="GET" action="{{ route('laporan.index') }}">
                        <div class="row g-2 align-items-end">

                            <div class="col-md-4">
                                <label class="form-label small mb-1 text-muted">
                                    Dari Tanggal
                                </label>
                                <input type="date" name="tgl_awal" class="form-control form-control-sm"
                                    value="{{ request('tgl_awal') }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label small mb-1 text-muted">
                                    Sampai Tanggal
                                </label>
                                <input type="date" name="tgl_akhir" class="form-control form-control-sm"
                                    value="{{ request('tgl_akhir') }}">
                            </div>

                            <div class="col-md-2 d-flex align-items-end gap-2">
                                <button type="submit" class="btn btn-sm btn-primary px-3">
                                    <i class="fas fa-filter"></i>
                                </button>

                                <a href="{{ route('laporan.index') }}" class="btn btn-sm btn-secondary px-3">
                                    <i class="fas fa-undo"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Pelanggan</th>
                                <th>Mobil</th>
                                <th>Lama Sewa</th>
                                <th>Total Harga</th>
                                <th>Tanggal Pesan</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse($transaksi as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->pelanggan->nama_pelanggan ?? 'Deleted' }}</td>
                                    <td>{{ $item->mobil->merek ?? 'Deleted' }}</td>
                                    <td>{{ $item->lama_penyewaan }} Hari</td>
                                    <td>Rp {{ number_format($item->total_harga) }}</td>
                                    <td>{{ $item->tgl_pesan }}</td>
                                    <td>{{ $item->tgl_kembali }}</td>
                                    <td>
                                        <span class="badge bg-success">SELESAI</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada laporan transaksi
                                        yang diselesaikan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <a href="{{ route('laporan.pdf', request()->query()) }}" class="btn btn-danger mb-3" target="_blank">
                        <i class="fa-regular fa-file-pdf fa-lg"></i> Cetak PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
