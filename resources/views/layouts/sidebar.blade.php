<ul class="nav">
  <li class="nav-item nav-profile">
    <div class="nav-link">
      <div class="user-wrapper">
        <div class="profile-image">
          @if(Auth::user()->gambar == '')

          <img src="{{asset('images/user/default.png')}}" alt="profile image">
          @else

          <img src="{{asset('images/user/'. Auth::user()->gambar)}}" alt="profile image">
          @endif
        </div>
        <div class="text-wrapper">
          <p class="profile-name">{{Auth::user()->name}}</p>
          <div>
            <small class="designation text-muted" style="text-transform: uppercase;letter-spacing: 1px;">
              @if (Auth::user()->level == 'admin')
              Admin
              @else
              Siswa
              @endif
            </small>
            <span class="status-indicator online"></span>
          </div>
        </div>
      </div>
    </div>
  </li>
  <li class="nav-item {{ setActive(['/', 'front']) }}">
    <a class="nav-link" href="{{url('/')}}">
      <i class="menu-icon mdi mdi-home"></i>
      <span class="menu-title">Kembali ke depan</span>
    </a>
  </li>
  <li class="nav-item {{ setActive(['/home', 'home']) }}">
    <a class="nav-link" href="{{url('/home')}}">
      <i class="menu-icon mdi mdi-chart-areaspline"></i>
      <span class="menu-title">Dashboard</span>
    </a>
  </li>
  @if(Auth::user()->level == 'admin')
  <li class="nav-item {{ setActive(['anggota*', 'buku*', 'user*']) }}">
    <a class="nav-link " data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
      <i class="menu-icon mdi mdi-file-import"></i>
      <span class="menu-title">Data Master</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse {{ setShow(['anggota*', 'buku*', 'user*']) }}" id="ui-basic">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item">
          <a class="nav-link {{ setActive(['anggota*']) }}" href="{{route('anggota.index')}}">
            <i class="menu-icon mdi mdi-account-card-details"></i>
            <span class="menu-title">Data Anggota</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ setActive(['buku*']) }}" href="{{route('buku.index')}}">
            <i class="menu-icon mdi mdi-book-open-page-variant"></i>
            <span class="menu-title">Data Buku</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ setActive(['user*']) }}" href="{{route('user.index')}}">
            <i class="menu-icon mdi mdi-account-multiple"></i>
            <span class="menu-title">Data User</span>
          </a>
        </li>
      </ul>
    </div>
  </li>
  @endif
  <li class="nav-item {{ setActive(['peminjaman*']) }}">
    <a class="nav-link" href="{{route('peminjaman.index')}}">
      <i class="menu-icon mdi mdi-swap-horizontal"></i>
      <span class="menu-title">Peminjaman</span>
    </a>
  </li>
  <li class="nav-item {{ setActive(['Baca Langsung*']) }}">
    <a class="nav-link" href="{{route('bacaBuku')}}">
      <i class="menu-icon mdi mdi-book-open"></i>
      <span class="menu-title">Baca Langsung</span>
    </a>
  </li>
</ul>