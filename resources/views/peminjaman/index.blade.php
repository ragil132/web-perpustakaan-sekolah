@if(Auth::user()->level == 'admin')

@section('js')
<script src="{{ asset('js/peminjaman.js') }}"></script>
<script src="{{ asset('js/sweetalert2.all.js') }}"></script>
@stop

@else

@section('js')
<script src="{{ asset('js/peminjaman-user.js') }}"></script>
<script src="{{ asset('js/sweetalert2.all.js') }}"></script>
@stop

@endif

@section('css')
<link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css')}}">
@stop

@extends('layouts.app')

@section('content')
<div class="row">

  <div class="col-lg-2">
    <a href="{{ route('peminjaman.create') }}" class="btn btn-inverse-success btn-fw"><i class="fa fa-plus"></i> Tambah Data Peminjaman</a>
  </div>
  @if($data->where('tgl_kembali','<=', date('Y-m-d', strtotime(Carbon\Carbon::today())))->where('status', 'pinjam')->count() > 0)
    <div class="col-lg-12">
      <div class="alert alert-danger" style="margin-top:10px;">
        <p>Perhatian! Terdapat buku yang belum dikembalikan sesuai batas peminjaman, harap segera dikembalikan. Silahkan lihat di data peminjaman</p>
      </div>
    </div>
    @endif
</div>
<div class="row" style="margin-top: 20px;">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">

      <div class="card-body">
        <h4 class="card-title">Data Peminjaman</h4>

        <div class="table-responsive">
          <table class="table table-striped" id="table">
            <thead>
              <tr>
                <th>
                  Kode Peminjaman
                </th>
                <th>
                  Buku
                </th>
                <th>
                  Peminjam
                </th>
                <th>
                  Tangggal Pinjam
                </th>
                <th>
                  Tangggal Kembali
                </th>
                <th>
                  Dibuat pada
                </th>
                <th>
                  Status
                </th>
                <th>
                  Aksi
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $d)
              <tr>
                <td class="py-1">
                  <a href="{{route('peminjaman.show', $d->id)}}">
                    {{$d->kode_peminjaman}}
                  </a>
                </td>
                <td>

                  {{$d->buku->judul}}

                </td>

                <td>
                  {{$d->anggota->nama}}
                </td>
                <td>
                  {{date('d/m/y', strtotime($d->tgl_pinjam))}}
                </td>
                <td>
                  {{date('d/m/y', strtotime($d->tgl_kembali))}}
                </td>
                <td>
                  {{$d->created_at}}
                </td>
                <td>
                  @if($d->status == 'pinjam')
                  <label class="badge badge-warning">Dipinjam</label>
                  @elseif($d->status == 'kembali')
                  <label class="badge badge-success">Kembali</label>
                  @else
                  <label class="badge badge-warning">Dikembalikan (Dalam verifikasi)</label>
                  @endif
                </td>
                <td>
                  @if(Auth::user()->level == 'admin')
                  <div class="btn-group dropdown">
                    <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Aksi
                    </button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                      @if($d->status == 'pinjam')
                      <button data-id="{{ $d->id }}" class="btn-kembali dropdown-item"> Sudah Dikembalikan
                      </button>
                      @elseif($d->status == 'verf_kemb')
                      <button data-id="{{ $d->id }}" class="btn-kembali dropdown-item"> Sudah Dikembalikan
                      </button>
                      <button data-id="{{ $d->id }}" class="btn-belumkembali dropdown-item"> Belum Dikembalikan
                      </button>
                      @endif
                      <button data-id="{{ $d->id }}" class="dropdown-item btn-hapuspeminjaman"> Hapus
                      </button>
                    </div>
                  </div>
                  @else
                  @if($d->status == 'pinjam')
                  <button data-id="{{ $d->id }}" class="btn btn-info btn-xs btn-kembali"> Sudah Dikembalikan
                  </button>
                  @else
                  -
                  @endif
                  @endif
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