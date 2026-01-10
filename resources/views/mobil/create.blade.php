@extends('layout.template')

@section('title', 'Tambah Mobil')

@section('content')
    <div class="col-md-6 offset-md-3">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Mobil</h5>
                <a href="{{ route('mobil.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i>
                    Kembali</a>
            </div>
            <div class="card-body">
                <form action="{{ route('mobil.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @error('no_polisi')
                        <div class="text-danger mb-1">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="no_polisi" class="form-label text-muted small">Nomor Polisi</label>
                        <input type="text" class="form-control form-control-sm @error('no_polisi') is-invalid @enderror"
                            id="no_polisi" name="no_polisi" value="{{ old('no_polisi') }}">
                    </div>

                    @error('merek')
                        <div class="text-danger mb-1">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="merek" class="form-label text-muted small">Merek</label>
                        <input type="text" class="form-control form-control-sm @error('merek') is-invalid @enderror"
                            id="merek" name="merek" value="{{ old('merek') }}">
                    </div>

                    @error('jenis_mobil')
                        <div class="text-danger mb-1">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="jenis_mobil" class="form-label text-muted small">Jenis Mobil</label>
                        <select name="jenis_mobil" class="form-control mb-2">
                            <option value="">Pilih Jenis Mobil</option>
                            <option value="Sedan" {{ old('jenis_mobil') == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                            <option value="MPV" {{ old('jenis_mobil') == 'MPV' ? 'selected' : '' }}>MPV</option>
                            <option value="SUV" {{ old('jenis_mobil') == 'SUV' ? 'selected' : '' }}>SUV</option>
                        </select>
                    </div>

                    @error('kapasitas')
                        <div class="text-danger mb-1">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="kapasitas" class="form-label text-muted small">Kapasitas</label>
                        <input type="number" class="form-control form-control-sm @error('kapasitas') is-invalid @enderror"
                            id="kapasitas" name="kapasitas" value="{{ old('kapasitas') }}">
                    </div>

                    @error('harga_perhari')
                        <div class="text-danger mb-1">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="harga_perhari" class="form-label text-muted small">Harga Perhari</label>
                        <input type="number"
                            class="form-control form-control-sm @error('harga_perhari') is-invalid @enderror"
                            id="harga_perhari" name="harga_perhari" value="{{ old('harga_perhari') }}">
                    </div>

                    @error('foto')
                        <div class="text-danger mb-1">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="foto" class="form-label text-muted small">Foto</label>
                        <input type="file" class="form-control form-control-sm @error('foto') is-invalid @enderror"
                            id="foto" name="foto">
                    </div>

                    <button type="submit" class="btn btn-custom"><i class="fas fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
