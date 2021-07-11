<!DOCTYPE html>
<html>

<head>
    <title>Cetak Qr Code</title>
    <link rel="stylesheet" href="{{ public_path('css/style.css') }}">
</head>

<body>

    <div class="text-center" style="margin-top: 50px;">

        <h1>Silahkan scan QR Code dibawah ini untuk membaca buku <b>{{ $judul }}</b></h1>
        <br>
        <img src="data:image/png;base64, {!! base64_encode(QrCode::size(300)->generate($url)); !!}">

    </div>

</body>

</html>