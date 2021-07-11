@section('js')
<script type="text/javascript">
  $(document).on('click', '.pilih', function(e) {
    document.getElementById("buku_judul").value = $(this).attr('data-buku_judul');
    document.getElementById("buku_id").value = $(this).attr('data-buku_id');
    $('#myModal').modal('hide');
  });

  $(document).on('click', '.pilih_anggota', function(e) {
    document.getElementById("anggota_id").value = $(this).attr('data-anggota_id');
    document.getElementById("anggota_nama").value = $(this).attr('data-anggota_nama');
    $('#myModal2').modal('hide');
  });

  $(function() {
    $("#lookup, #lookup2").dataTable();
  });

  $(function() {
    var date_pinjam = document.getElementById('tgl_pinjam').value;
    document.getElementById("tgl_kembali").setAttribute("min", date_pinjam);
  });

  document.getElementById('tgl_pinjam').addEventListener('change', function() {
    var date_pinjam = document.getElementById('tgl_pinjam').value;
    document.getElementById("tgl_kembali").value = date_pinjam;
    document.getElementById("tgl_kembali").setAttribute("min", date_pinjam);

  });
</script>

@stop
@section('css')

@stop
@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('peminjaman.store') }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Tambah Data Peminjaman</h4>

              <div class="form-group{{ $errors->has('kode_peminjaman') ? ' has-error' : '' }}">
                <label for="kode_peminjaman" class="col-md-4 control-label">Kode Peminjaman</label>
                <div class="col-md-6">
                  <input id="kode_peminjaman" type="text" class="form-control" name="kode_peminjaman" value="{{ $kode }}" required readonly="">
                  @if ($errors->has('kode_peminjaman'))
                  <span class="help-block">
                    <strong>{{ $errors->first('kode_peminjaman') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="form-group{{ $errors->has('tgl_pinjam') ? ' has-error' : '' }}">
                <label for="tgl_pinjam" class="col-md-4 control-label">Tanggal Pinjam</label>
                <div class="col-md-3">
                  <input id="tgl_pinjam" type="date" min="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" class="form-control" name="tgl_pinjam" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" required @if(Auth::user()->level == 'user') readonly @endif>
                  @if ($errors->has('tgl_pinjam'))
                  <span class="help-block">
                    <strong>{{ $errors->first('tgl_pinjam') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="form-group{{ $errors->has('tgl_kembali') ? ' has-error' : '' }}">
                <label for="tgl_kembali" class="col-md-4 control-label">Tanggal Kembali</label>
                <div class="col-md-3">
                  <input id="tgl_kembali" type="date" @if(Auth::user()->level == 'user') max="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->addDays(7)->toDateString())) }}" @endif class="form-control" name="tgl_kembali" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->addDays(5)->toDateString())) }}" required="">
                  @if ($errors->has('tgl_kembali'))
                  <span class="help-block">
                    <strong>{{ $errors->first('tgl_kembali') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('buku_id') ? ' has-error' : '' }}">
                <label for="buku_id" class="col-md-4 control-label">Buku</label>
                <div class="col-md-6">
                  <div class="input-group">
                    <input id="buku_judul" type="text" class="form-control" readonly="" required>
                    <input id="buku_id" type="hidden" name="buku_id" value="{{ old('buku_id') }}" required readonly="">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-inverse-success btn-secondary" data-toggle="modal" data-target="#myModal"><i class="mdi mdi-file-find"></i> <b>Cari Buku</b></button>
                    </span>
                  </div>
                  @if ($errors->has('buku_id'))
                  <span class="help-block">
                    <strong>{{ $errors->first('buku_id') }}</strong>
                  </span>
                  @endif

                </div>
              </div>


              @if(Auth::user()->level == 'admin')
              <div class="form-group{{ $errors->has('anggota_id') ? ' has-error' : '' }}">
                <label for="anggota_id" class="col-md-4 control-label">Anggota</label>
                <div class="col-md-6">
                  <div class="input-group">
                    <input id="anggota_nama" type="text" class="form-control" readonly="" required>
                    <input id="anggota_id" type="hidden" name="anggota_id" value="{{ old('anggota_id') }}" required readonly="">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-inverse-success btn-secondary" data-toggle="modal" data-target="#myModal2"><i class="mdi mdi-account-search"></i> <b>Cari Anggota</b></button>
                    </span>
                  </div>
                  @if ($errors->has('anggota_id'))
                  <span class="help-block">
                    <strong>{{ $errors->first('anggota_id') }}</strong>
                  </span>
                  @endif

                </div>
              </div>
              @else
              <div class="form-group{{ $errors->has('anggota_id') ? ' has-error' : '' }}">
                <label for="anggota_id" class="col-md-4 control-label">Anggota</label>
                <div class="col-md-6">
                  <input id="anggota_nama" type="text" class="form-control" readonly="" value="{{Auth::user()->anggota->nama}}" required>
                  <input id="anggota_id" type="hidden" name="anggota_id" value="{{ Auth::user()->anggota->id }}" required readonly="">

                  @if ($errors->has('anggota_id'))
                  <span class="help-block">
                    <strong>{{ $errors->first('anggota_id') }}</strong>
                  </span>
                  @endif

                </div>
              </div>
              @endif

              <div class="form-group{{ $errors->has('ket') ? ' has-error' : '' }}">
                <label for="ket" class="col-md-4 control-label">Keterangan</label>
                <div class="col-md-6">
                  <textarea id="ket" type="text" class="form-control" placeholder="Keterangan" name="ket" value="{{ old('ket') }}"></textarea>
                  @if ($errors->has('ket'))
                  <span class="help-block">
                    <strong>{{ $errors->first('ket') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <button type="submit" class="btn btn-success" id="submit"><i class="mdi mdi-content-save"></i>
                Simpan
              </button>
              <button type="reset" class="btn btn-danger"><i class="mdi mdi-backup-restore"></i>
                Reset
              </button>
              <a href="{{route('peminjaman.index')}}" class="btn btn-light pull-right"><i class="mdi mdi-keyboard-return"></i> Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</form>


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="background: #fff;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cari Buku</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="lookup" class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th>Kode</th>
              <th>Judul</th>
              <th>Pengarang</th>
              <th>Penerbit</th>
              <th>Tahun</th>
              <th>Jumlah Buku</th>
            </tr>
          </thead>
          <tbody>
            @foreach($buku as $data)
            <tr class="pilih" data-buku_id="<?php echo $data->id; ?>" data-buku_judul="<?php echo $data->judul; ?>">
              <td>{{$data->kode}}</td>
              <td>@if($data->cover)
                <img src="{{url('images/buku/'. $data->cover)}}" alt="image" style="margin-right: 10px;" />
                @else
                <img src="{{url('images/buku/default.png')}}" alt="image" style="margin-right: 10px;" />
                @endif
                {{$data->judul}}
              </td>
              <td>{{$data->pengarang}}</td>
              <td>{{$data->penerbit}}</td>
              <td>{{$data->tahun_terbit}}</td>
              <td>{{$data->jumlah_buku}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="background: #fff;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cari Anggota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="lookup" class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th>
                Nama
              </th>
              <th>
                NIS
              </th>
              <th>
                Jurusan
              </th>
              <th>
                Jenis Kelamin
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach($anggota as $data)
            <tr class="pilih_anggota" data-anggota_id="<?php echo $data->id; ?>" data-anggota_nama="<?php echo $data->nama; ?>">
              <td class="py-1">
                @if($data->user->gambar)
                <img src="{{url('images/user', $data->user->gambar)}}" alt="image" style="margin-right: 10px;" />
                @else
                <img src="{{url('images/user/default.png')}}" alt="image" style="margin-right: 10px;" />
                @endif

                {{$data->nama}}
              </td>
              <td>
                {{$data->nis}}
              </td>

              <td>
                @if($data->jurusan == 'TKJ')
                Teknik Komputer dan Jaringan
                @elseif($data->jurusan == 'OTK')
                Otomatisasi dan Tata Kelola Perkantoran
                @else
                Akuntansi
                @endif
              </td>
              <td>
                {{$data->jk === "L" ? "Laki - Laki" : "Perempuan"}}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection