<!DOCTYPE html>
<html>
<head>
    <title>Landing Page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
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
