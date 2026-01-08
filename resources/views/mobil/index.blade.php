@extends('layout.template')

@section('title', 'Data Mobil')

@section('content')
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0">Data Mobil</h5>
                <div>
                    <a href="{{ route('mobil.create') }}" class="btn btn-primary btn-sm me-2">
                        <i class="fas fa-plus"></i> Tambah Mobil
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nomor Polisi</th>
                                <th>Merek</th>
                                <th>Jenis</th>
                                <th>Kapasitas</th>
                                <th>Harga Perhari</th>
                                <th>Foto</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse($mobil as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->no_polisi }}</td>
                                    <td>{{ $item->merek }}</td>
                                    <td>{{ $item->jenis_mobil }}</td>
                                    <td>{{ $item->kapasitas }}</td>
                                    <td>Rp {{ number_format($item->harga_perhari) }}</td>
                                    <td>
                                        @if ($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" class="img-thumbnail"
                                                style="width: 80px; height: 60px; object-fit: cover;">
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status === 'tersedia')
                                            <span class="badge bg-success">tersedia</span>
                                        @else
                                            <span class="badge bg-danger">disewa</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            @if ($item->status === 'tersedia')
                                                <a href="{{ route('mobil.edit', $item->id_mobil) }}"
                                                    class="btn btn-sm btn-info text-white">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('mobil.destroy', $item->id_mobil) }}" method="POST"
                                                    class="m-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <button class="btn btn-sm btn-secondary" disabled title="Sedang disewa">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-secondary" disabled title="Sedang disewa">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Data mobil kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection