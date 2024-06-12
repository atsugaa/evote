@extends('layouts.app')

@section('content')
<div class="mb-5">
    @if(session('success'))
        <div id="alert" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
          <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
          </svg>
          <span class="sr-only">Success</span>
          <div class="ms-3 text-sm font-medium">
            {{ session('success') }}
          </div>
          <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
          </button>
        </div>
    @endif
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Daftar Siswa</div>
                <div class="card-body">
                    <div class="mb-3">
                        <form action="{{ route('users.index') }}" method="GET">
                            <div class="form-group">
                                <label for="search">Cari Nama/NISN siswa:</label>
                                <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Cari</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Reset</a>
                        </form>
                    </div>

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
                    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Tambah Siswa</a>
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
