@section('js')
@stop

@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('anggota.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tambah Anggota baru</h4>
                            
                            <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                                <label for="nama" class="col-md-4 control-label">Nama</label>
                                <div class="col-md-6">
                                <input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama') }}" required>
                                @if ($errors->has('nama'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('nis') ? ' has-error' : '' }}">
                                <label for="nis" class="col-md-4 control-label">NIS</label>
                                <div class="col-md-6">
                                <input id="nis" type="number" min="0" max="9999999999" class="form-control" name="nis" value="{{ old('nis') }}" maxlength="8" required>
                                @if ($errors->has('nis'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nis') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('kelas') ? ' has-error' : '' }}">
                                <label for="kelas" class="col-md-4 control-label">Kelas</label>
                                <div class="col-md-6">
                                <select class="form-control" name="kelas" required="">
                                <option value=""></option>
                                <option value="X_1">X-1</option>
                                <option value="X_2">X-2</option>
                                <option value="X_3">X-3</option>
                                <option value="XI_1">XI-1</option>
                                <option value="XI_2">XI-2</option>
                                <option value="XI_3">XI-3</option>
                                <option value="XII_1">XII-1</option>
                                <option value="XII_2">XII-2</option>
                                <option value="XII_3">XII-3</option>
                                </select>
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('jurusan') ? ' has-error' : '' }}">
                                <label for="jurusan" class="col-md-4 control-label">Kompetensi Keahlian</label>
                                <div class="col-md-6">
                                <select class="form-control" name="jurusan" required="">
                                <option value=""></option>
                                <option value="TKJ">Teknik Komputer dan Jaringan</option>
                                <option value="OTK">Otomatisasi dan Tata Kelola Perkantoran</option>
                                <option value="ATS">Akuntansi</option>
                                </select>
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('tempat_lahir') ? ' has-error' : '' }}">
                                <label for="tempat_lahir" class="col-md-4 control-label">Tempat Lahir</label>
                                <div class="col-md-6">
                                <input id="tempat_lahir" type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                                @if ($errors->has('tempat_lahir'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tempat_lahir') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('tgl_lahir') ? ' has-error' : '' }}">
                                <label for="tgl_lahir" class="col-md-4 control-label">Tanggal Lahir</label>
                                <div class="col-md-6">
                                <input id="tgl_lahir" type="date" class="form-control" name="tgl_lahir" value="{{ old('tgl_lahir') }}" required>
                                @if ($errors->has('tgl_lahir'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tgl_lahir') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('jk') ? ' has-error' : '' }}">
                                <label for="jk" class="col-md-4 control-label">Jenis Kelamin</label>
                                <div class="col-md-6">
                                <select class="form-control" name="jk" required="">
                                <option value=""></option>
                                <option value="L">Laki - Laki</option>
                                <option value="P">Perempuan</option>
                                </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }} " style="margin-bottom: 20px;">
                                <label for="user_id" class="col-md-4 control-label">Pilih User</label>
                                <div class="col-md-6">
                                <select class="form-control" name="user_id" required="">
                                <option value="">Pilih User</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                                </select>
                                <br>
                                <label for="disclaimer" class="control-label">(Disclaimer: Pastikan sebelum menambah data anggota, anda sudah membuat data user untuk anggota tersebut)</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success" id="submit"><i class="mdi mdi-content-save"></i>
                                Simpan
                            </button>
                            <button type="reset" class="btn btn-danger"><i class="mdi mdi-backup-restore"></i>
                                Reset
                            </button>
                            <a href="{{route('anggota.index')}}" class="btn btn-light pull-right"><i class="mdi mdi-keyboard-return"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection