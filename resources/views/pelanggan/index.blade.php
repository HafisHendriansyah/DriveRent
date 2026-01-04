@extends('layout.template')

@section('title', 'Data Pelanggan')

@section('content')
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Data Pelanggan</h5>
                <div>
                    <a href="{{ route('pelanggan.create') }}" class="btn btn-blue btn-sm me-2"><i class="fas fa-plus"></i>
                        Tambah Pelanggan</a>
                    <a href="{{ route('home') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i></a>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. KTP</th>
                                <th>No. HP</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse ($pelanggan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_pelanggan }}</td>
                                    <td>{{ $item->email_pelanggan }}</td>
                                    <td>{{ $item->no_ktp }}</td>
                                    <td>{{ $item->no_hp }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('pelanggan.edit', $item->id_pelanggan) }}"
                                                class="btn btn-sm btn-info text-white">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('pelanggan.destroy', $item->id_pelanggan) }}"
                                                method="POST" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Data pelanggan belum tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
