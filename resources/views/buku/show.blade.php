@section('js')
<script type="text/javascript">
    function readURL() {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(input).prev().attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(function() {
        $(".uploads").change(readURL)
        $("#f").submit(function() {
            return false
        })
    })
</script>
@stop

@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
        <div class="row flex-grow">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data detail : <b>{{$data->judul}}</b> </h4>
                        <form class="forms-sample">

                            <div class="form-group">
                                <div class="col-md-6">
                                    <img width="200" height="200" @if($data->cover) src="{{ asset('images/buku/'.$data->cover) }}" @endif />
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('kode') ? ' has-error' : '' }}">
                                <label for="kode" class="col-md-4 control-label">Kode</label>
                                <div class="col-md-6">
                                    <input id="kode" type="text" class="form-control" name="kode" value="{{ $data->kode }}" readonly="">
                                    @if ($errors->has('kode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kode') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('judul') ? ' has-error' : '' }}">
                                <label for="judul" class="col-md-4 control-label">Judul</label>
                                <div class="col-md-6">
                                    <input id="judul" type="text" class="form-control" name="judul" value="{{ $data->judul }}" readonly="">
                                    @if ($errors->has('judul'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('judul') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('jenis') ? ' has-error' : '' }}">
                                <label for="jenis" class="col-md-4 control-label">Jenis</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="jenis" required="" disabled="">
                                        <option value="">-Pilih-</option>
                                        <option value="karya_umum" {{$data->jenis === "karya_umum" ? "selected" : ""}}>Karya Umum</option>
                                        <option value="filsafat_psikologi" {{$data->jenis === "filsafat_psikologi" ? "selected" : ""}}>Filsafat & Psikologi</option>
                                        <option value="agama" {{$data->jenis === "agama" ? "selected" : ""}}>Agama</option>
                                        <option value="ilmu_sosial" {{$data->jenis === "ilmu_sosial" ? "selected" : ""}}>Ilmu Sosial</option>
                                        <option value="bahasa" {{$data->jenis === "bahasa" ? "selected" : ""}}>Bahasa</option>
                                        <option value="ilmu_murni" {{$data->jenis === "ilmu_murni" ? "selected" : ""}}>Ilmu Murni</option>
                                        <option value="ilmu_terapan" {{$data->jenis === "ilmu_terapan" ? "selected" : ""}}>Ilmu Terapan</option>
                                        <option value="kesenian" {{$data->jenis === "kesenian" ? "selected" : ""}}>Kesenian</option>
                                        <option value="kesusastraan" {{$data->jenis === "kesusastraan" ? "selected" : ""}}>Kesusastraan</option>
                                        <option value="sejarah" {{$data->jenis === "sejarah" ? "selected" : ""}}>Sejarah</option>
                                        <option value="fiksi" {{$data->jenis === "fiksi" ? "selected" : ""}}>Fiksi</option>
                                        <option value="eksternal" {{$data->jenis === "eksternal" ? "selected" : ""}}>Eksternal (dari internet)</option>
                                    </select>
                                    @if ($errors->has('jenis'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jenis') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('pengarang') ? ' has-error' : '' }}">
                                <label for="pengarang" class="col-md-4 control-label">Pengarang</label>
                                <div class="col-md-6">
                                    <input id="pengarang" type="text" class="form-control" name="pengarang" value="{{ $data->pengarang }}" readonly>
                                    @if ($errors->has('pengarang'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pengarang') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('penerbit') ? ' has-error' : '' }}">
                                <label for="penerbit" class="col-md-4 control-label">Penerbit</label>
                                <div class="col-md-6">
                                    <input id="penerbit" type="text" class="form-control" name="penerbit" value="{{ $data->penerbit }}" readonly>
                                    @if ($errors->has('penerbit'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('penerbit') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('cetakan') ? ' has-error' : '' }}">
                                <label for="cetakan" class="col-md-4 control-label">Cetakan</label>
                                <div class="col-md-6">
                                    <input id="cetakan" type="number" maxlength="10" class="form-control" name="cetakan" value="{{ $data->cetakan }}" readonly>
                                    @if ($errors->has('cetakan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cetakan') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('tahun_terbit') ? ' has-error' : '' }}">
                                <label for="tahun_terbit" class="col-md-4 control-label">Tahun Terbit</label>
                                <div class="col-md-6">
                                    <input id="tahun_terbit" type="number" maxlength="4" class="form-control" name="tahun_terbit" value="{{ $data->tahun_terbit }}" readonly>
                                    @if ($errors->has('tahun_terbit'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tahun_terbit') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('jumlah_buku') ? ' has-error' : '' }}">
                                <label for="jumlah_buku" class="col-md-4 control-label">Jumlah Buku</label>
                                <div class="col-md-6">
                                    <input id="jumlah_buku" type="number" maxlength="4" class="form-control" name="jumlah_buku" value="{{ $data->jumlah_buku }}" readonly>
                                    @if ($errors->has('jumlah_buku'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jumlah_buku') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
                                <label for="keterangan" class="col-md-4 control-label">Keterangan</label>
                                <div class="col-md-12">
                                    <textarea id="keterangan" type="text" class="form-control" name="keterangan" value="{{ $data->keterangan }}" readonly="">{{ $data->keterangan }}</textarea>
                                    @if ($errors->has('keterangan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('keterangan') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('tautan') ? ' has-error' : '' }}">
                                <label for="tautan" class="col-md-4 control-label">Tautan/Link</label>
                                <div class="col-md-6">
                                    <input id="tautan" type="text" class="form-control" name="tautan" value="{{ $data->tautan }}" readonly>
                                    @if ($errors->has('tautan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tautan') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <a href="{{route('buku.index')}}" class="btn btn-light pull-right"><i class="mdi mdi-keyboard-return"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection