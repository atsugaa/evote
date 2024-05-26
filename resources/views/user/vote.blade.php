@extends('app')
    @section('title','Vote')
    @section('content')
        <section class="m-16 p-12 rounded-xl bg-gradient-to-r from-[#46428E] to-[#3572B5] text-white text-center">
            <h2 class="text-4xl font-bold mb-5">E-VOTE PEMILIHAN KETUA OSIS</h2>
            <p class="text-lg mb-5">Pilihlah Ketua dan Wakil Ketua OSIS yang dapat menghasilkan <br> program-program yang bermanfaat bagi seluruh siswa</p>
            <div class="text-black bg-white rounded-full py-2 px-6 w-fit mx-auto font-bold text-lg">OSIS SMAS ISLAM DIPONEGORO  GONDANG  2024/2025</div>
        </section>
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
    @endsection
</body>
</html>
