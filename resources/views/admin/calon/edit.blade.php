@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Calon</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('calon.update', $calon->ID_CALON) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="GAMBAR_CALON">Gambar Calon</label>
                            <div>
                                <img src="{{ asset('storage/images/' . $calon->GAMBAR_CALON) }}" alt="Gambar Calon" style="max-width: 200px;">
                            </div>
                            <input type="file" class="form-control-file mt-2 @error('GAMBAR_CALON') is-invalid @enderror" id="GAMBAR_CALON" name="GAMBAR_CALON">
                            @error('GAMBAR_CALON')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="KETUA_CALON">Nama Ketua Calon</label>
                            <input type="text" class="form-control @error('KETUA_CALON') is-invalid @enderror" id="KETUA_CALON" name="KETUA_CALON" value="{{ old('KETUA_CALON', $calon->KETUA_CALON) }}" required>
                            @error('KETUA_CALON')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="WAKIL_CALON">Nama Wakil Calon</label>
                            <input type="text" class="form-control @error('WAKIL_CALON') is-invalid @enderror" id="WAKIL_CALON" name="WAKIL_CALON" value="{{ old('WAKIL_CALON', $calon->WAKIL_CALON) }}" required>
                            @error('WAKIL_CALON')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="VISI_CALON">Visi Calon</label>
                            <textarea class="form-control @error('VISI_CALON') is-invalid @enderror" id="VISI_CALON" name="VISI_CALON" rows="3" required>{{ old('VISI_CALON', $calon->VISI_CALON) }}</textarea>
                            @error('VISI_CALON')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="MISI_CALON">Misi Calon</label>
                            <textarea class="form-control @error('MISI_CALON') is-invalid @enderror" id="MISI_CALON" name="MISI_CALON" rows="3" required>{{ old('MISI_CALON', $calon->MISI_CALON) }}</textarea>
                            @error('MISI_CALON')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
