@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Daftar Voting</div>

                <div class="card-body">
                    <a href="{{ route('votings.create') }}" class="btn btn-primary mb-3">Tambah Voting</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nama Voting</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Tanggal Mulai</th>
                                <th scope="col">Tanggal Berakhir</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($votings as $voting)
                            <tr>
                                <td>{{ $voting->NAMA_VOTING }}</td>
                                <td>{{ $voting->DESKRIPSI_VOTING }}</td>
                                <td>{{ $voting->MULAI_VOTING }}</td>
                                <td>{{ $voting->SELESAI_VOTING }}</td>
                                <td>{{ $voting->status }}</td>
                                <td>
                                    <a href="{{ route('votings.edit', $voting->ID_VOTING) }}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('votings.destroy', $voting->ID_VOTING) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus voting ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $votings->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
