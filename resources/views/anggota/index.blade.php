@section('js')
<script src="{{ asset('js/sweetalert2.all.js') }}"></script>
<script src="{{ asset('js/anggota.js') }}"></script>
@stop
@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-2">
    <a href="{{ route('anggota.create') }}" class="btn btn-inverse-success btn-fw"><i class="fa fa-plus"></i> Tambah Anggota</a>
  </div>
</div>
<div class="row" style="margin-top: 20px;">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Data Anggota</h4>
        <div class="table-responsive">
          <table class="table table-striped" id="table">
            <thead>
              <tr>
                <th>
                  Nama
                </th>
                <th>
                  NIS
                </th>
                <th>
                  Kelas
                </th>
                <th>
                  Kompetensi Keahlian
                </th>
                <th>
                  Dibuat Pada
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
                  @if($d->user->gambar)
                  <img src="{{url('images/user', $d->user->gambar)}}" alt="image" style="margin-right: 10px;" />
                  @else
                  <img src="{{url('images/user/default.png')}}" alt="image" style="margin-right: 10px;" />
                  @endif

                  {{$d->nama}}
                </td>
                <td>
                  <a href="{{route('anggota.show', $d->id)}}">
                    {{$d->nis}}
                  </a>
                </td>
                <td>
                  @if($d->kelas == 'X_1')
                  X-1
                  @elseif($d->kelas == 'X_2')
                  X-2
                  @elseif($d->kelas == 'X_3')
                  X-3
                  @elseif($d->kelas == 'XI_1')
                  XI-1
                  @elseif($d->kelas == 'XI_2')
                  XI-2
                  @elseif($d->kelas == 'XI_3')
                  XI-3
                  @elseif($d->kelas == 'XII_1')
                  XII-1
                  @elseif($d->kelas == 'XII_2')
                  XII-2
                  @else
                  XII-3
                  @endif
                </td>
                <td>
                  @if($d->jurusan == 'TKJ')
                  Teknik Komputer dan Jaringan
                  @elseif($d->jurusan == 'OTK')
                  Otomatisasi dan Tata Kelola Perkantoran
                  @else
                  Akuntansi
                  @endif
                </td>
                <td>
                  {{$d->created_at}}
                </td>
                <td>
                  <div class="btn-group dropdown">
                    <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Aksi
                    </button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                      <a class="dropdown-item" href="{{route('anggota.edit', $d->id)}}"> Edit </a>
                      <button data-id="{{ $d->id }}" class="dropdown-item btn-hapusanggota"> Hapus
                      </button>
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