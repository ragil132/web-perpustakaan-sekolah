@section('js')
<script src="{{ asset('js/sweetalert2.all.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "iDisplayLength": 50
    });

    $('body').on('click', '.btn-kembali', function() {
      var dataId = $(this).attr('data-id');
      Swal.fire({
        icon: 'warning',
        text: 'Apakah buku benar-benar telah dikembalikan?',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        confirmButtonColor: '#58d8a3',
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "/pengembalianbuku/" + dataId,
            type: "GET",
            dataType: "JSON",
            success: function(response) {
              switch (response) {
                case 'Berhasil':
                  Swal.fire(
                    'Berhasil',
                    response,
                    'success'
                  )
                  window.location.href = window.location.href;
                  break;
                case 'Gagal':
                  Swal.fire(
                    'Gagal',
                    response,
                    'error'
                  )
              }
            }
          });
        }
      });
    });

  });
</script>
@stop
@extends('layouts.app')

@section('content')
<div class="row">
  @if($peminjaman->where('tgl_kembali','<=', date('Y-m-d', strtotime(Carbon\Carbon::today())))->where('status', 'pinjam')->count() > 0)
    <div class="col-lg-12">
      <div class="alert alert-danger" style="margin-top:10px;">
        <p>Perhatian! Terdapat buku yang belum dikembalikan sesuai batas peminjaman, harap segera dikembalikan. Silahkan lihat di data peminjaman</p>
      </div>
    </div>
    @endif
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
      <div class="card card-statistics text-danger">
        <div class="card-body">
          <div class="clearfix">
            <div class="float-left">
              <i class="mdi mdi-swap-horizontal text-danger icon-lg"></i>
            </div>
            <div class="float-right">
              <p class="mb-0 text-right">Peminjaman</p>
              <div class="fluid-container">
                <h3 class="font-weight-medium text-right mb-0">{{$peminjaman->count()}}</h3>
              </div>
            </div>
          </div>
          <p class="text-muted mt-3 mb-0">
            <i class="mdi mdi-information-outline mr-1" aria-hidden="true"></i> Total Data Peminjaman
          </p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
      <div class="card card-statistics text-warning">
        <div class="card-body">
          <div class="clearfix">
            <div class="float-left">
              <i class="mdi mdi-bookmark-check text-warning icon-lg"></i>
            </div>
            <div class="float-right">
              <p class="mb-0 text-right">Dipinjam</p>
              <div class="fluid-container">
                <h3 class="font-weight-medium text-right mb-0">{{$peminjaman->where('status', 'pinjam')->count()}}</h3>
              </div>
            </div>
          </div>
          <p class="text-muted mt-3 mb-0">
            <i class="mdi mdi-information-outline mr-1" aria-hidden="true"></i> Jumlah Buku yang Sedang Dipinjam
          </p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
      <div class="card card-statistics text-primary">
        <div class="card-body">
          <div class="clearfix">
            <div class="float-left">
              <i class="mdi mdi-book-open-page-variant text-primary icon-lg" style="width: 40px;height: 40px;"></i>
            </div>
            <div class="float-right">
              <p class="mb-0 text-right">Buku</p>
              <div class="fluid-container">
                <h3 class="font-weight-medium text-right mb-0">{{$buku->count()}}</h3>
              </div>
            </div>
          </div>
          <p class="text-muted mt-3 mb-0">
            <i class="mdi mdi-information-outline mr-1" aria-hidden="true"></i> Total Data Buku
          </p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
      <div class="card card-statistics text-info">
        <div class="card-body">
          <div class="clearfix">
            <div class="float-left">
              <i class="mdi mdi-account-card-details text-info icon-lg"></i>
            </div>
            <div class="float-right">
              <p class="mb-0 text-right">Anggota</p>
              <div class="fluid-container">
                <h3 class="font-weight-medium text-right mb-0">{{$anggota->count()}}</h3>
              </div>
            </div>
          </div>
          <p class="text-muted mt-3 mb-0">
            <i class="mdi mdi-information-outline mr-1" aria-hidden="true"></i> Total Anggota Perpustakaan
          </p>
        </div>
      </div>
    </div>
</div>
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">

      <div class="card-body">
        <h4 class="card-title">Data peminjaman (sedang dipinjam)</h4>

        <div class="table-responsive">
          <table class="table table-striped" id="table">
            <thead>
              <tr>
                <th>
                  Kode
                </th>
                <th>
                  Buku
                </th>
                <th>
                  Peminjam
                </th>
                <th>
                  Tgl Pinjam
                </th>
                <th>
                  Tgl Kembali
                </th>
                <th>
                  Status
                </th>
                <th>
                  Action
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
                  @if($d->status == 'pinjam')
                  <label class="badge badge-warning">Pinjam</label>
                  @else
                  <label class="badge badge-success">Kembali</label>
                  @endif
                </td>
                <td>
                  <button data-id="{{ $d->id }}" class="btn btn-primary btn-sm btn-kembali">Sudah Dikembalikan
                  </button>

                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection