@section('js')
@stop

@extends('layouts.app')

@section('content')

<form action="{{ route('anggota.update', $data->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('put') }}
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Edit Anggota</h4>
                      
                        <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                            <label for="nama" class="col-md-4 control-label">Nama</label>
                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control" name="nama" value="{{ $data->nama }}" required>
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
                                <input id="nis" type="number" class="form-control" name="nis" value="{{ $data->nis }}" maxlength="8" required>
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
                                    <option value="X_1" {{$data->kelas === "X_1" ? "selected" : ""}}>X-1</option>
                                    <option value="X_2" {{$data->kelas === "X_2" ? "selected" : ""}}>X-2</option>
                                    <option value="X_3" {{$data->kelas === "X_3" ? "selected" : ""}}>X-3</option>
                                    <option value="XI_1" {{$data->kelas === "XI_1" ? "selected" : ""}}>XI-1</option>
                                    <option value="XI_2" {{$data->kelas === "XI_2" ? "selected" : ""}}>XI-2</option>
                                    <option value="XI_3" {{$data->kelas === "XI_3" ? "selected" : ""}}>XI-3</option>
                                    <option value="XII_1" {{$data->kelas === "XII_1" ? "selected" : ""}}>XII-1</option>
                                    <option value="XII_2" {{$data->kelas === "XII_2" ? "selected" : ""}}>XII-2</option>
                                    <option value="XII_3" {{$data->kelas === "XII_3" ? "selected" : ""}}>XII-3</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('jurusan') ? ' has-error' : '' }}">
                            <label for="jurusan" class="col-md-4 control-label">Kompetensi Keahlian</label>
                            <div class="col-md-6">
                                <select class="form-control" name="jurusan" required="">
                                    <option value=""></option>
                                    <option value="TKJ" {{$data->jurusan === "TKJ" ? "selected" : ""}} >Teknik Komputer dan Jaringan</option>
                                    <option value="OTK" {{$data->jurusan === "OTK" ? "selected" : ""}} >Otomatisasi dan Tata Kelola Perkantoran</option>
                                    <option value="ATS" {{$data->jurusan === "ATS" ? "selected" : ""}} >Akuntansi</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('tempat_lahir') ? ' has-error' : '' }}">
                            <label for="tempat_lahir" class="col-md-4 control-label">Tempat Lahir</label>
                            <div class="col-md-6">
                                <input id="tempat_lahir" type="text" class="form-control" name="tempat_lahir" value="{{ $data->tempat_lahir }}" required>
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
                                <input id="tgl_lahir" type="date" class="form-control" name="tgl_lahir" value="{{ $data->tgl_lahir }}" required>
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
                                    <option value="L" {{$data->jk === "L" ? "selected" : ""}}>Laki - Laki</option>
                                    <option value="P" {{$data->jk === "P" ? "selected" : ""}}>Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }} " style="margin-bottom: 20px;">
                            <label for="user_id" class="col-md-4 control-label">User Login</label>
                            <div class="col-md-6">
                                <select class="form-control" name="user_id" required="">
                                    <option value="">(Cari User)</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}" {{$data->user_id === $user->id ? "selected" : ""}}>{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success" id="submit"><i class="mdi mdi-content-save"></i>
                            Perbarui
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