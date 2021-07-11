@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
        <div class="row flex-grow">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data detail : <b>{{$data->kode_peminjaman}}</b></h4>

                        <div class="form-group">
                            <div class="col-md-6">
                                <img width="200" height="200" @if($data->buku->cover) src="{{ asset('images/buku/'.$data->buku->cover) }}" @endif />
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('kode_peminjaman') ? ' has-error' : '' }}">
                            <label for="kode_peminjaman" class="col-md-4 control-label">Kode Peminjaman</label>
                            <div class="col-md-6">
                                <input id="kode_peminjaman" type="text" class="form-control" name="kode_peminjaman" value="{{$data->kode_peminjaman}}" required readonly="">
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('tgl_pinjam') ? ' has-error' : '' }}">
                            <label for="tgl_pinjam" class="col-md-4 control-label">Tanggal Pinjam</label>
                            <div class="col-md-3">
                                <input id="tgl_pinjam" type="date" class="form-control" name="tgl_pinjam" value="{{ date('Y-m-d', strtotime($data->tgl_pinjam)) }}" readonly="">
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('tgl_kembali') ? ' has-error' : '' }}">
                            <label for="tgl_kembali" class="col-md-4 control-label">Tanggal Kembali</label>
                            <div class="col-md-3">
                                <input id="tgl_kembali" type="date" class="form-control" name="tgl_kembali" value="{{ date('Y-m-d', strtotime($data->tgl_kembali)) }}" readonly="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="buku" class="col-md-4 control-label">Buku</label>
                            <div class="col-md-6">
                                <input id="buku" type="text" class="form-control" readonly="" value="{{$data->buku->judul}}">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="anggota_nama" class="col-md-4 control-label">Anggota</label>
                            <div class="col-md-6">
                                <input id="anggota_nama" type="text" class="form-control" readonly="" value="{{$data->anggota->nama}}">

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="status" class="col-md-4 control-label">Status</label>
                            <div class="col-md-6">
                                @if($data->status == 'pinjam')
                                <label class="badge badge-warning">Dipinjam</label>
                                @else
                                <label class="badge badge-success">Kembali</label>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ket') ? ' has-error' : '' }}">
                            <label for="ket" class="col-md-4 control-label">Keterangan</label>
                            <div class="col-md-6">
                                <input id="ket" type="text" class="form-control" name="ket" value="{{ $data->ket }}" readonly="">
                            </div>
                        </div>

                        <a href="{{route('peminjaman.index')}}" class="btn btn-light pull-right"><i class="mdi mdi-keyboard-return"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection