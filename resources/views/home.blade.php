<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <title>Landing Page</title>
</head>
@vite('resources/css/app.css')
<body class="bg-slate-50">
  <nav class="flex justify-center items-center gap-x-4 text-white w-full p-2 rounded-b-xl bg-gradient-to-r from-[#46428E] to-[#3572B5]">
    <img src="{{ asset('images/logo Evote 1.png') }}" alt="">
    <h2 class="text-lg">E-Vote PKM-PM</h2>
  </nav>
  <main class="flex justify-center py-20">
    <div class="flex h-[85vh] w-[90vw] drop-shadow-lg rounded-xl overflow-hidden bg-white">
      <div class="h-full w-[55%]" style="background-image: url-({{ asset('images/logo Evote 1.png') }})"  >
        <div class="w-full h-full"></div>
      </div>
    </div>
  </main>
    <!-- Tampilkan informasi pemilihan -->
    <h1>{{ $pemilihan['NAMA_VOTING'] }}</h1>
    <p>{{ $pemilihan['DESKRIPSI_VOTING'] }}</p>
    <p>Pemilihan dimulai pada: {{ $pemilihan['MULAI_VOTING'] }}</p>
    <p>Pemilihan berakhir pada: {{ $pemilihan['SELESAI_VOTING'] }}</p>
     <!-- Tombol untuk membuka modal -->
     <h1>QR Code Scanner</h1>
    {{-- Scanner --}}
    <label for="barcodeData" class="form-label">Scan Barcode via Camera</label>
    <div class="card bg-white shadow rounded-3 p-3 border-0">
      <div class="w-4">
        <video id="preview" ></video>
      </div>
      <form action="{{ route('login') }}" method="POST" id="form">
        @csrf
        <input type="hidden" id="barcode_data" name="barcode_data">
      </form>
    </div>


    @error('barcode_data')
      Gagal Masuk format Salah
    @enderror
    @error('barcode')
      Hahahah
    @enderror

    <label for="">Scan Barcode via scanner</label>
    <form action="{{ route('login') }}" method="post">
      @csrf
      <input type="text" name="barcode_data">
      <input type="submit">
    </form>
    <label for="">Login Manual</label>
    <form action="{{ route('loginManual') }}" method="post">
      @csrf
      <label for="">NISN</label>
      <input type="text" name="nisn">
      <label for="">NAMA</label>
      <input type="text" name="nama">
      <input type="submit">
    </form>
</body>
@vite('resources/js/app.js')
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script type="text/javascript">

    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

    scanner.addListener('scan', function (content) {
      console.log(content);
    });

    Instascan.Camera.getCameras().then(function (cameras) {
      if (cameras.length > 0) {
        scanner.start(cameras[0]);
      } else {
        console.error('No cameras found.');
      }
    }).catch(function (e) {
      console.error('Error accessing video stream:', e);
    });

    scanner.addListener('scan',function(c){
      document.getElementById('barcode_data').value = c;
      
      document.getElementById('form').submit();
    })
    // document.addEventListener('keypress', function(e) {
    //     if (e.keyCode === 13) { // ASCII code for Enter key
    //         var barcode = e.target.value;
    //         // Kirim kode barcode ke server
    //         // Anda dapat menggunakan AJAX untuk mengirimkan kode barcode ke server Laravel
    //     }
    // });
</script>
</html>
