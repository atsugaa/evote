@extends('layouts.haha')

@section('content')
<div class="container main">
    <div class="row">
        <div class="col-md-6 side-image"></div>
        <div class="col-md-6 right">

            <div class="input-box">
                <header>Sign In</heade>
                <form method="POST" action="{{ route('admin.login.submit') }}">
                    @csrf

                    <div class="input-field">
                        <label for="ID_ADMIN">ID Admin {{ Auth::guard('admin')->id() }}</label>
                        <input type="text" class="input" id="ID_ADMIN" name="ID_ADMIN" value="{{ old('ID_ADMIN') }}">
                        @error('ID_ADMIN')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="input-field">
                        <label for="PASSWORD_ADMIN">Password</label>
                        <input type="password" class="input" id="PASSWORD_ADMIN" name="PASSWORD_ADMIN">
                        @error('PASSWORD_ADMIN')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-field">
                        @error('error')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <button class="submit" type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection