@extends('layout.template')
@section('title', 'Home - DriveRent')

@section('content-top')
    @include('layout.card')
@endsection

@section('content')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Mobil Tersedia</h6>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                @forelse($mobil as $item)
                    <div class="col">
                        <div class="card h-100">
                            <div style="height: 200px; overflow: hidden;">
                                @if ($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" class="card-img-top"
                                        alt="{{ $item->merek }}" style="object-fit: cover; height: 100%; width: 100%;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center bg-secondary text-white h-100">
                                        <span>No Image</span>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->merek }}</h5>
                                <p class="card-text">
                                    <small class="text-muted">{{ $item->no_polisi }}</small><br>
                                    <span class="badge bg-info text-dark">{{ $item->jenis_mobil }}</span>
                                    <span class="badge bg-secondary">{{ $item->kapasitas }} Orang</span>
                                </p>
                                <p class="card-text fw-bold">Rp {{ number_format($item->harga_perhari) }} / hari</p>
                            </div>
                            <div class="card-footer bg-white border-top-0">
                                <a href="{{ route('transaksi.create', $item->id_mobil) }}" class="btn btn-primary w-100">Pilih</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">Tidak ada mobil tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
