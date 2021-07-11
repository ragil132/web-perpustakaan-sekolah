@section('js')
<script src="{{ asset('js/bacaBuku.js') }}"></script>
@stop
@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-12">
    @if (Session::has('message'))
    <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
    @endif
  </div>
</div>
<div class="row" style="margin-top: 20px;">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">

      <div class="card-body">
        <h4 class="card-title pull-left">Data Buku yang Bisa Dibaca Bebas Secara Digital</h4>
        <a href="{{url('cetakqrcodeCollection/bacabuku')}}" class="btn btn-xs btn-success pull-right">Cetak QR Code untuk halaman ini</a>

        <div class="table-responsive">
          <table class="table table-striped" id="table">
            <thead>
              <tr>
                <th>
                  Kode
                </th>
                <th>
                  Judul
                </th>
                <th>
                  Pengarang
                </th>
                <th>
                  Penerbit
                </th>
                <th>
                  Tahun
                </th>
                <th>
                  Aksi
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $d)
              <tr>
                <td>
                  {{$d->kode}}
                </td>
                <td class="py-1">
                  @if($d->cover)
                  <img src="{{url('images/buku/'. $d->cover)}}" alt="image" style="margin-right: 10px;" />
                  @else
                  <img src="{{url('images/buku/default.png')}}" alt="image" style="margin-right: 10px;" />
                  @endif
                  {{$d->judul}}
                </td>
                <td>
                  {{$d->pengarang}}
                </td>
                <td>
                  {{$d->penerbit}}
                </td>
                <td>
                  {{$d->tahun_terbit}}
                </td>
                <td>
                  <div class="btn-group dropdown">
                    <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Aksi
                    </button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                      <a class="dropdown-item" target="_blank" href="{{$d->tautan}}"> Baca </a>
                      <a class="dropdown-item" href="{{ url('cetakqrcode/'.$d->id) }}"> Cetak QR Code </a>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        {{-- {!! $data->links() !!} --}}
      </div>
    </div>
  </div>
</div>
@endsection