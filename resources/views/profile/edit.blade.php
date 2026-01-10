@extends('layout.template')

@section('title', 'Edit Profil')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">Ubah Data Profil</h5>
                <a href="{{ route('profile.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Foto Profile (Read Only) --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold">Foto Profil</label>
                        <div class="d-flex align-items-center gap-3">
                            <div id="preview-container">
                                <img id="preview" src="{{ asset('assets/img/profile.jpg') }}"
                                    class="rounded-circle border border-2 border-white shadow-sm"
                                    style="width: 100px; height: 100px; object-fit: cover;">
                            </div>
                            <div>
                                <small class="text-muted">Foto profil admin default.</small>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4">
                        {{-- Edit Nama --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" name="nama_admin" class="form-control"
                                value="{{ old('nama_admin', $admin->nama_admin) }}" placeholder="Masukkan nama lengkap">
                            @error('nama_admin')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Edit Gmail --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Gmail / Email</label>
                            <input type="email" name="email_admin" class="form-control"
                                value="{{ old('email_admin', $admin->email_admin) }}" placeholder="Masukkan email">
                            @error('email_admin')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-5 p-3 border rounded-3 bg-light bg-opacity-50">
                            <h6 class="fw-bold mb-3"><i class="fas fa-lock me-2"></i>Ganti Password</h6>
                            <p class="text-muted small mb-4">Kosongkan jika tidak ingin mengubah password.</p>

                            <div class="row g-4">
                                {{-- Edit Password --}}
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Password Baru</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password"
                                            class="form-control border-end-0" placeholder="">
                                        <span class="input-group-text bg-transparent border-start-0"
                                            onclick="togglePassword()" style="cursor: pointer;">
                                            <i class="fas fa-eye" id="toggleIcon"></i>
                                        </span>
                                    </div>
                                    @error('password')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-5">
                            <a href="{{ route('profile.index') }}" class="btn btn-light border">Batal</a>
                            <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>

    <style>
        .form-label {
            color: #4b5563;
            font-size: 0.9rem;
        }

        .form-control {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }
    </style>
@endsection