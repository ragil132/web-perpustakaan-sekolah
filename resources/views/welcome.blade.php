<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/style3.css') }}">
  <link rel="shortcut icon" href="{{asset('favicon.ico')}}" />
  @laravelPWA

  <title>Perpustakaan | SMK Muhammadiyah 7 Jakarta</title>
</head>

<body>
  <div class="header">
    <div class="logo-box">
      <img src="{{ asset('images/logo3.png') }}" alt="Logo-SMK" class="logo">
    </div>
    <div class="logo-box-mobile">
      <img src="{{ asset('images/logo3.png') }}" alt="Logo-SMK" class="logo-mobile">
    </div>
    <div class="text-box">
      <h1 class="primary-content">
        <span class="text-primary">Perpustakaan</span>
        <span class="text-primary-mobile">Perpus</span>
        <span class="text-sub">SMKM 7 Jakarta</span>
      </h1>
      <a href="{{ route('bacaBuku') }}" class="btn btn-white btn-animated">Cari Buku</a>
      @if (Route::has('login'))
      @auth
      <a href="{{ url('/home') }}" class="btn btn-white btn-animated">Dashboard</a>
      @else
      <a href="{{ route('login') }}" class="btn btn-white btn-animated">Login</a>
      @endauth
      @endif
    </div>
  </div>
  <div class="foter-main">
    <h1>Copyright ©2021 SMKM 7 Tebet Jakarta</h1>
  </div>
</body>

</html>