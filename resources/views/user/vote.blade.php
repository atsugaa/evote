<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    @if(Auth::guard('web')->check())
    <h1>Welcome, {{ Auth::guard('web')->user()->NAMA }}</h1>
    @foreach ( $Calons as $calon )
    <h2>Ketua Calon {{ $calon['KETUA_CALON'] }}</h2>
    <h2>Wakil Calon {{ $calon['WAKIL_CALON'] }}</h2>
    <p>Visi : {{ $calon['VISI_CALON'] }}</p>
    <p>Misi : {{ $calon['MISI_CALON'] }}</p>
    <a href="/pilih?calon={{ $calon['ID_CALON'] }}&user={{ Auth::guard('web')->user()->NISN }}">Pilih</a>
    <hr>
    
    @endforeach
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
        @else
            <p>Anda belum terautentikasi.</p>
        @endif
</body>
</html>
