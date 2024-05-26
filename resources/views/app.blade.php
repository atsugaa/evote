<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <title>E-Vote PKM-PM | @yield('title', '')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-slate-50">
  <header class="flex justify-center items-center gap-x-4 text-white w-full p-2 rounded-b-xl bg-gradient-to-r from-[#46428E] to-[#3572B5]">
    <img src="{{ asset('images/logo Evote 1.png') }}" alt="">
    <h2 class="text-lg">E-Vote PKM-PM</h2>
  </header>
    @yield('content')
  <footer class="flex justify-between w-full items-center text-white bg-gradient-to-r from-[#46428E] to-[#3572B5] px-12 py-4">
    <div class="flex items-center gap-2">
      <img src="{{ asset('images/logo sekolah dipo 1.png') }}" class="w-12" alt="">
      <p>SMAS ISLAM DIPONEGORO <br>
        MOJOEKRTO</p>
    </div>
    <div class="flex items-center gap-2">
      <img src="{{ asset('images/logo Evote 1.png') }}" alt="">
      <p>TIM PKM - PM 
        EVOTE</p>
    </div>
    <p>Jl. Yon Munasir No. 36, Kecamatan Gondang, Kabupaten Mojokerto.</p>
    <p>Hak Cipta © SMA Islam Diponegoro 2024<br>Dikembangkan oleh Tim PKM-PM E-Vote</p>
  </footer> 
</body>
  @vite('resources/js/app.js')
  @yield('script')
</html>