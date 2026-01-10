@extends('layout.template')

@section('title', 'Profil Saya')

@section('content')
<div class="container-fluid py-5 bg-light min-vh-100">
    <div class="mx-auto" style="max-width: 700px;">
        <div class="card shadow border rounded-4 overflow-hidden">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center px-4">
                <h5 class="fw-bold mb-0">Detail Profil</h5>
                <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">
                    <i class="fas fa-edit me-1"></i> Edit Profil
                </a>
            </div>
            
            <div class="card-body p-5 bg-white">
                {{-- Profile Header Centered --}}
                <div class="text-center mb-5">
                    <div class="d-inline-block position-relative mb-3">
                        <img src="{{ asset('assets/img/profile.jpg') }}" 
                             alt="Profile Photo" 
                             class="rounded-circle border border-4 border-light shadow"
                             style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <h2 class="fw-bold mb-1 text-dark">{{ $admin->nama_admin }}</h2>
                    <p class="text-muted fs-5">Administrator DriveRent</p>
                </div>

                {{-- Profile Details Vertical Stack --}}
                <div class="bg-light border rounded-4 p-4 shadow-sm">
                    <div class="mb-4 pb-3 border-bottom">
                        <label class="text-muted small fw-bold text-uppercase mb-1 d-block">Nama Lengkap</label>
                        <div class="fs-5 fw-semibold text-dark">{{ $admin->nama_admin }}</div>
                    </div>
                    <div class="mb-4 pb-3 border-bottom">
                        <label class="text-muted small fw-bold text-uppercase mb-1 d-block">Gmail / Email</label>
                        <div class="fs-5 fw-semibold text-dark">{{ $admin->email_admin }}</div>
                    </div>
                    <div class="mb-0">
                        <label class="text-muted small fw-bold text-uppercase mb-1 d-block">Password</label>
                        <div class="fs-5 fw-semibold text-muted">••••••••</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection