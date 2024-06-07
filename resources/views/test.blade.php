@php
    if(isset($_GET['scan'])){
        var_dump($_GET['scan']);
        die();
    };
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #scanInput{
            position:fixed;
            top: -100px;
            left:-100px;
        }
    </style>
</head>
<body>

    <form id="scanForm" action="" method="get">
        <input type="text" id="scanInput" name="scan" autofocus >
        <!-- Form fields here -->
        <button type="submit" style="display: none;"></button> <!-- Hidden submit button -->
    </form>

    <script>
        // Tangkap event pemindaian
        document.getElementById('scanInput').addEventListener('input', function(event) {
            var scannedData = event.target.value;
            // Lakukan sesuatu dengan data yang dipindai
            console.log('Data yang dipindai:', scannedData);
            // Otomatis kirim formulir setelah pemindaian
            submitForm();
        });

        // Fungsi untuk mengirim formulir
        function submitForm() {
            document.getElementById('scanForm').submit();
        }
    </script>
</body>
</html>