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
    <h1>{{ $pemilihan['nama'] }}</h1>
    <p>{{ $pemilihan['deskripsi'] }}</p>
    <p>Pemilihan dimulai pada: {{ $pemilihan['mulai'] }}</p>
    <p>Pemilihan berakhir pada: {{ $pemilihan['selesai'] }}</p>
     <!-- Tombol untuk membuka modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal11">
      Login menggunakan Scan Barcode
    </button>

    @error('barcode')
      gagal masuk
    @enderror

    <!-- Modal Bootstrap untuk login menggunakan scan barcode -->
    <div class="modal fade" id="modal11" tabindex="-1" role="dialog" aria-labelledby="scanBarcodeModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="scanBarcodeModalLabel">Login menggunakan Scan Barcode</h5>
          </div>
          <div class="modal-body">
            <!-- Form untuk memindai barcode -->
            <form action="{{ route('login') }}" method="post">
              @csrf
              <div class="mb-3">
                <label for="barcodeData" class="form-label">Scan Barcode</label>
                <input autofocus type="text" class="form-control" id="barcode_data" name="barcode_data" placeholder="Tempelkan barcode di sini">
                @error('barcode_data')
                  Error
                @enderror
              </div>
              <button type="submit" class="btn btn-primary">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</body>
<script type="text/javascript">
    document.addEventListener('keypress', function(e) {
        if (e.keyCode === 13) { // ASCII code for Enter key
            var barcode = e.target.value;
            // Kirim kode barcode ke server
            // Anda dapat menggunakan AJAX untuk mengirimkan kode barcode ke server Laravel
        }
    });
</script>
</html>
