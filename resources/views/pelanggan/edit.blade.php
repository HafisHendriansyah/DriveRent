@extends('layout.template')

@section('title', 'Edit Pelanggan')

@section('content')
    <div class="col-md-6 offset-md-3">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Data Pelanggan</h5>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i>
                    Kembali</a>
            </div>
            <div class="card-body">
                <form action="{{ route('pelanggan.update', $pelanggan->id_pelanggan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror"
                            id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}" required>
                        @error('nama_pelanggan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email_pelanggan" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email_pelanggan') is-invalid @enderror"
                            id="email_pelanggan" name="email_pelanggan" value="{{ old('email_pelanggan', $pelanggan->email_pelanggan) }}" required>
                        @error('email_pelanggan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_ktp" class="form-label">No. KTP</label>
                        <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" id="no_ktp"
                            name="no_ktp" value="{{ old('no_ktp', $pelanggan->no_ktp) }}" required>
                        @error('no_ktp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No. HP</label>
                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp"
                            value="{{ old('no_hp', $pelanggan->no_hp) }}" required>
                        @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                            rows="3">{{ old('alamat', $pelanggan->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-custom"><i class="fas fa-save"></i> Perbarui</button>
                </form>
            </div>
        </div>
    </div>
@endsection