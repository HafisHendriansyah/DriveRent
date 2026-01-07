@extends('layout.template')

@section('title', 'Transaksi')

@section('content')
    <div class="row">
        @foreach ($mobils as $mobil)
            <div class="col-md-3 mb-4">
                <div class="card h-80" style="width: 15rem;">

                    <img src="{{ asset('storage/' . $mobil->foto) }}" class="card-img-top" alt="Foto {{ $mobil->merek }}">

                    <div class="card-body">
                        <h5 class="card-title">{{ $mobil->merek }}</h5>
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Harga:</strong>
                            Rp {{ number_format($mobil->harga_perhari) }} / hari
                        </li>
                        <li class="list-group-item">
                            <strong>Kapasitas:</strong>
                            {{ $mobil->kapasitas }} orang
                        </li>
                        <li class="list-group-item">
                            <strong>No Polisi:</strong>
                            {{ $mobil->no_polisi }}
                        </li>
                    </ul>

                    <div class="card-body text-center">
                        {{-- <a href="{{ route('transaksi.create', $mobil->id_mobil) }}" class="btn btn-success w-100">
                            Pilih Mobil
                        </a> --}}
                    </div>

                </div>
            </div>
        @endforeach
    </div>
@endsection
