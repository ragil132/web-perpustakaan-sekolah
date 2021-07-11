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

<form method="POST" action="{{ route('buku.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tambah Data Buku</h4>

                            <div class="form-group{{ $errors->has('kode') ? ' has-error' : '' }}">
                                <label for="kode" class="col-md-4 control-label">Kode</label>
                                <div class="col-md-6">
                                    <input id="kode" type="text" class="form-control" name="kode" value="{{ old('kode') }}" required>
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
                                    <input id="judul" type="text" class="form-control" name="judul" value="{{ old('judul') }}" required>
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
                                    <select class="form-control" name="jenis" required="">
                                        <option value="">-Pilih-</option>
                                        <option value="karya_umum">Karya Umum</option>
                                        <option value="filsafat_psikologi">Filsafat & Psikologi</option>
                                        <option value="agama">Agama</option>
                                        <option value="ilmu_sosial">Ilmu Sosial</option>
                                        <option value="bahasa">Bahasa</option>
                                        <option value="ilmu_murni">Ilmu Murni</option>
                                        <option value="ilmu_terapan">Ilmu Terapan</option>
                                        <option value="kesenian">Kesenian</option>
                                        <option value="kesusastraan">Kesusastraan</option>
                                        <option value="sejarah">Sejarah</option>
                                        <option value="fiksi">Fiksi</option>
                                        <option value="eksternal">Eksternal (dari internet)</option>
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
                                    <input id="pengarang" type="text" class="form-control" name="pengarang" value="{{ old('pengarang') }}" required>
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
                                    <input id="penerbit" type="text" class="form-control" name="penerbit" value="{{ old('penerbit') }}" required>
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
                                    <input id="cetakan" type="number" maxlength="10" class="form-control" name="cetakan" value="{{ old('cetakan') }}" required>
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
                                    <input id="tahun_terbit" type="number" maxlength="4" class="form-control" name="tahun_terbit" value="{{ old('tahun_terbit') }}" required>
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
                                    <input id="jumlah_buku" type="number" maxlength="4" class="form-control" name="jumlah_buku" value="{{ old('jumlah_buku') }}" required>
                                    @if ($errors->has('jumlah_buku'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jumlah_buku') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
                                <label for="keterangan" class="col-md-4 control-label">Keterangan</label>
                                <div class="col-md-6">
                                    <textarea id="keterangan" type="text" class="form-control" name="keterangan" value="{{ old('keterangan') }}"></textarea>
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
                                    <input id="tautan" type="text" class="form-control" name="tautan" value="{{ old('tautan') }}">
                                    @if ($errors->has('tautan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tautan') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cover" class="col-md-4 control-label">Cover</label>
                                <div class="col-md-6">
                                    <img width="200" height="200" />
                                    <input type="file" class="uploads form-control" style="margin-top: 20px;" name="cover">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success" id="submit"><i class="mdi mdi-content-save"></i>
                                Simpan
                            </button>
                            <button type="reset" class="btn btn-danger"><i class="mdi mdi-backup-restore"></i>
                                Reset
                            </button>
                            <a href="{{route('buku.index')}}" class="btn btn-light pull-right"><i class="mdi mdi-keyboard-return"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
@endsection