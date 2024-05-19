@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Daftar User</div>

                <div class="card-body">
                    <div class="mb-3">
                        <form action="{{ route('users.index') }}" method="GET">
                            <div class="form-group">
                                <label for="status">Filter Status:</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="">Semua</option>
                                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Sudah Memilih</option>
                                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Belum Memilih</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Reset</a>
                        </form>
                    </div>
                    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Tambah User</a>
                    <div class="mb-3">
                        <form action="{{ route('users.uploadExcel') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="excel">Unggah Excel:</label>
                                <input type="file" name="excel" id="excel" accept=".xls,.xlsx" class="form-control-file @error('excel') is-invalid @enderror">
                                @error('excel')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Unggah</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Reset</a>
                        </form>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">NISN</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ strval($user->NISN) }}</td>
                                <td>{{ $user->NAMA }}</td>
                                <td>{{ $user->STATUS ? 'Sudah Memilih' : 'Belum Memilih' }}</td>
                                <td>
                                    <a href="{{ route('users.edit', $user->NISN) }}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('users.destroy', $user->NISN) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
