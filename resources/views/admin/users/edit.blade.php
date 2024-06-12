@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit User</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user->NISN) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="NAMA">Nama</label>
                            <input type="text" class="form-control @error('NAMA') is-invalid @enderror" id="NAMA" name="NAMA" value="{{ old('NAMA', $user->NAMA) }}" required>
                            @error('NAMA')
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