@extends('layout.template')

@section('title', 'Tambah Transaksi')

@section('content')
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0">Tambah Transaksi</h5>
                <a href="{{ route('home') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_mobil" value="{{ $mobil->id_mobil }}">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Mobil</label>
                            <input type="text" class="form-control" value="{{ $mobil->merek }} - {{ $mobil->no_polisi }}"
                                readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga Per Hari</label>
                            <input type="text" class="form-control" value="Rp {{ number_format($mobil->harga_perhari) }}" readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="id_pelanggan" class="form-label">Pelanggan</label>
                        <select name="id_pelanggan" id="id_pelanggan"
                            class="form-select @error('id_pelanggan') is-invalid @enderror" required>
                            <option value="">Pilih Pelanggan</option>
                            @foreach ($pelanggan as $item)
                                <option value="{{ $item->id_pelanggan }}" {{ old('id_pelanggan') == $item->id_pelanggan ? 'selected' : '' }}>
                                    {{ $item->nama_pelanggan }} ({{ $item->no_ktp }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_pelanggan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="lama_penyewaan" class="form-label">Lama Penyewaan (Hari)</label>
                            <input type="number" name="lama_penyewaan" id="lama_penyewaan"
                                class="form-control @error('lama_penyewaan') is-invalid @enderror"
                                value="{{ old('lama_penyewaan') }}" min="1" required>
                            @error('lama_penyewaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tgl_pesan" class="form-label">Tanggal Pesan</label>
                            <input type="date" name="tgl_pesan" id="tgl_pesan"
                                class="form-control @error('tgl_pesan') is-invalid @enderror"
                                value="{{ old('tgl_pesan', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required>
                            @error('tgl_pesan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    @if(session('perkiraan_total') || session('perkiraan_kembali'))
                    <div class="row border rounded p-3 mb-3 bg-light mx-1">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Perkiraan Total Harga</label>
                            <div class="form-control-plaintext text-primary h5 mb-0">
                                Rp {{ number_format(session('perkiraan_total')) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Perkiraan Tanggal Kembali</label>
                            <div class="form-control-plaintext text-primary h5 mb-0">
                                {{ date('d F Y', strtotime(session('perkiraan_kembali'))) }}
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="alert alert-info py-2">
                        <i class="fas fa-info-circle me-2"></i> 
                        {{ session('info') ?? 'Gunakan tombol "Cek Perkiraan" untuk melihat total biaya dan tanggal kembali sebelum menyimpan.' }}
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="submit" name="hitung" value="1" class="btn btn-secondary">
                            <i class="fas fa-calculator"></i> Cek Perkiraan
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection