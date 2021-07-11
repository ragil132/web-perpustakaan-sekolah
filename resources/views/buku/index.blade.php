@section('js')
<script src="{{ asset('js/sweetalert2.all.js') }}"></script>
<script src="{{ asset('js/buku.js') }}"></script>
@stop
@extends('layouts.app')

@section('content')
<div class="row">

  <div class="col-lg-2">
    <a href="{{ route('buku.create') }}" class="btn btn-inverse-success btn-fw"><i class="fa fa-plus"></i> Tambah Data Buku</a>
  </div>
</div>
<div class="row" style="margin-top: 20px;">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">

      <div class="card-body">
        <h4 class="card-title pull-left">Data Buku</h4>

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
                  Jumlah Buku
                </th>
                <th>
                  Dibuat pada
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
                  <a href="{{route('buku.show', $d->id)}}">
                    {{$d->judul}}
                  </a>
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
                  {{$d->jumlah_buku}}
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
                      <a class="dropdown-item" href="{{route('buku.edit', $d->id)}}"> Edit </a>
                      <button data-id="{{ $d->id }}" class="dropdown-item btn-hapusbuku"> Hapus
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