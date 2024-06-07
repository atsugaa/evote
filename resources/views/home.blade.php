@extends('app')
@section('title','Home')
@section('content')
<main class="flex justify-center py-20">
  <div class="flex h-[85vh] w-[90vw] drop-shadow-lg rounded-xl overflow-hidden bg-white">
    <div class="h-full w-[55%] bg-cover" style="background-image: url('{{ asset('images/logo Evote 2.png') }}')">
      <div class="w-full h-full bg-[#2b3296] bg-opacity-70 text-white flex flex-col justify-evenly items-center">
        <h2 class="text-5xl font-medium w-[80%] leading-normal">Selamat Datang di E-Vote Pemilihan Ketua {{ $pemilihan['NAMA_VOTING'] }}</h2>
        <p class="text-3xl w-[80%] leading-normal">"Mulailah Pengalaman Demokratis di Sekolah Anda"</p>
      </div>
    </div>
    <div class="h-full w-[45%]">
      <div class="mb-4 border-b border-gray-200">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-purple-600 hover:text-purple-600 border-purple-600" data-tabs-inactive-classes="text-gray-500 hover:text-gray-600 border-gray-100 hover:border-gray-300" role="tablist">
          <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Login dengan Scanner</button>
          </li>
          <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Login dengan Kamera</button>
          </li>
          <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="settings-styled-tab" data-tabs-target="#styled-settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Login Manual</button>
          </li>
        </ul>
      </div>
      <div id="default-styled-tab-content">
        <div class="hidden px-12 py-4 text-center rounded-lg bg-gray-50" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab">
          <p class="text-3xl leading-normal">Silahkan scan Qr-Code pada Kartu Tanda Pelajar ke Alat Scanner yang sudah disediakan</p>
          <img src="{{ asset('images/Qr code for charity donations.png') }}" class="w-[80%] mx-auto" alt="barcode">
          <form action="{{ route('login') }}" method="POST" id="scanForm">
            @csrf
            <input type="text" name="barcode_data" id="scanInput" autofocus>
          </form>
        </div>
        <div class="hidden px-12 py-4 rounded-lg text-center bg-gray-50" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
          <p class="text-3xl leading-normal">Silahkan scan Qr-Code pada Kartu Tanda Pelajar dengan Kamera Anda</p>
          <div class="card bg-white shadow rounded-3 p-3 border-0 mt-7">
            <video id="preview"></video>
            <form action="{{ route('login') }}" method="POST" id="form">
              @csrf
              <input type="hidden" id="barcode_data" name="barcode_data">
            </form>
          </div>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50" id="styled-settings" role="tabpanel" aria-labelledby="settings-tab">
          <p class="text-3xl text-center">Masuk</p>
          <p class="text-center mt-2">Alternatif login selain menggunakan Qr-Code</p>
          <form action="{{ route('loginManual') }}" method="post" class="max-w-sm mx-auto mt-10 flex flex-col">
            @csrf
            <div class="mb-5">
              <label for="nisn" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NISN</label>
              <input type="text" id="nisn" name="nisn" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>
            <div class="mb-5">
              <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NAMA LENGKAP</label>
              <input type="text" id="nama" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>
            <button type="submit" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
@error('barcode_data')
Gagal Masuk format Salah
@enderror
@error('barcode')
Hahahah
@enderror

<!-- Tampilkan informasi pemilihan -->
<h1>{{ $pemilihan['NAMA_VOTING'] }}</h1>
<p>{{ $pemilihan['DESKRIPSI_VOTING'] }}</p>
<p>Pemilihan dimulai pada: {{ $pemilihan['MULAI_VOTING'] }}</p>
<p>Pemilihan berakhir pada: {{ $pemilihan['SELESAI_VOTING'] }}</p>
<!-- Tombol untuk membuka modal -->
@endsection

@section('script')
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script type="text/javascript">
  let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

  Instascan.Camera.getCameras().then(function (cameras) {
    if (cameras.length > 0) {
      scanner.start(cameras[0]);
    } else {
      console.error('No cameras found.');
    }
  }).catch(function (e) {
    console.error('Error accessing video stream:', e);
  });

  scanner.addListener('scan', function (content) {
    document.getElementById('barcode_data').value = content;
    document.getElementById('form').submit();
  });
</script>
@endsection
