@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4 bg-light rounded">
        <h1 class="mb-4 text-center">Daftar Mahasiswa</h1>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <a href="{{ route('mahasiswa.create') }}" class="btn btn-success">Tambah Mahasiswa</a>
            </div>
            <!-- Form pencarian -->
            <div class="d-flex align-items-center">
                <form action="{{ route('mahasiswa.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" placeholder="search..." class="form-control mr-1" style="width: 300px;">
                    <button type="submit" class="btn btn-primary mr-1">
                        <i class="bi bi-search"></i>
                    </button>
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-dark">Kembali</a>
                </form>
            </div>
        </div>

        <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" style="width: 100%;">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Email</th>
                    <th>Jurusan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mahasiswa as $mhs)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $mhs->nama }}</td>
                    <td>{{ $mhs->nim }}</td>
                    <td>{{ $mhs->email }}</td>
                    <td>{{ $mhs->jurusan }}</td>
                    <td class="text-center">
                        <div class="btn-group" role="group" aria-label="Aksi">
                            <a href="{{ route('mahasiswa.edit', $mhs->id) }}" class="btn btn-warning mr-1">Edit</a>
                            <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</div>
@endsection
