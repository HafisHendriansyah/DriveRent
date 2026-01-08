@extends('layout.template')

@section('title', 'Laporan Transaksi')

@section('content')
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0">Laporan Transaksi</h5>
                <a href="{{ route('home') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
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
                                    <td colspan="8" class="text-center">Belum ada laporan transaksi yang diselesaikan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection