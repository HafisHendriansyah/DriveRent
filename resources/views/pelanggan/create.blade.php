@extends('layout.template')

@section('title', 'Tambah Pelanggan')

@section('content')
    <div class="col-md-6 offset-md-3">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Data Pelanggan</h5>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i>
                    Kembali</a>
            </div>
            <div class="card-body">
                <form action="{{ route('pelanggan.store') }}" method="POST">
                    @csrf

                    @error('nama_pelanggan')
                        <div class="text-danger mb-1">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="nama_pelanggan" class="form-label text-muted small">Nama Pelanggan</label>
                        <input type="text"
                            class="form-control form-control-sm @error('nama_pelanggan') is-invalid @enderror"
                            id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}">
                    </div>

                    @error('email_pelanggan')
                        <div class="text-danger mb-1">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="email_pelanggan" class="form-label text-muted small">Email</label>
                        <input type="text"
                            class="form-control form-control-sm @error('email_pelanggan') is-invalid @enderror"
                            id="email_pelanggan" name="email_pelanggan" value="{{ old('email_pelanggan') }}">
                    </div>

                    @error('no_ktp')
                        <div class="text-danger mb-1">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="no_ktp" class="form-label text-muted small">No. KTP</label>
                        <input type="text" class="form-control form-control-sm @error('no_ktp') is-invalid @enderror"
                            id="no_ktp" name="no_ktp" value="{{ old('no_ktp') }}">
                    </div>

                    @error('no_hp')
                        <div class="text-danger mb-1">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="no_hp" class="form-label text-muted small">No. HP</label>
                        <input type="text" class="form-control form-control-sm @error('no_hp') is-invalid @enderror"
                            id="no_hp" name="no_hp" value="{{ old('no_hp') }}">
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label text-muted small">Alamat</label>
                        <textarea class="form-control form-control-sm @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                            rows="3">{{ old('alamat') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-custom"><i class="fas fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
