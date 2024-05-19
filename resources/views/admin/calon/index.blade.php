@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Daftar Calon</div>

                <div class="card-body">
                    <a href="{{ route('calon.create') }}" class="btn btn-primary mb-3">Tambah Calon</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Foto</th>
                                <th scope="col">ID Calon</th>
                                <th scope="col">Ketua Calon</th>
                                <th scope="col">Wakil Calon</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($calon as $c)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/images/' . $c->GAMBAR_CALON) }}" alt="Avatar Calon" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                </td>
                                <td>{{ $c->ID_CALON }}</td>
                                <td>{{ $c->KETUA_CALON }}</td>
                                <td>{{ $c->WAKIL_CALON }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal{{ $c->ID_CALON }}">Lihat Selengkapnya</button>
                                    <a href="{{ route('calon.edit', $c->ID_CALON) }}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('calon.destroy', $c->ID_CALON) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus calon ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $calon->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($calon as $c)
<div class="modal fade" id="modal{{ $c->ID_CALON }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informasi Calon {{ $c->ID_CALON }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Nama Ketua Calon: {{ $c->KETUA_CALON }}</h4>
                <h4>Nama Wakil Calon: {{ $c->WAKIL_CALON }}</h4>
                <h4>Visi:</h4>
                <p>{{ $c->VISI_CALON }}</p>
                <h4>Misi:</h4>
                <p>{{ $c->MISI_CALON }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
