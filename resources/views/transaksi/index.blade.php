@extends('layout.template')

@section('title', 'Transaksi')

@section('content')
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0">Daftar Transaksi</h5>
                <a href="{{ route('home') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

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
                                <th>Status</th>
                                <th>Aksi</th>
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
                                    <td>
                                        <span class="badge bg-warning text-dark">PROSES</span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <form action="{{ route('transaksi.updateStatus', $item->id_transaksi) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Selesaikan transaksi ini?')">
                                                    SELESAI
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada transaksi yang sedang diproses</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
