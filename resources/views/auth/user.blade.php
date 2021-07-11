@section('js')
<script src="{{ asset('js/sweetalert2.all.js') }}"></script>
<script src="{{ asset('js/user.js') }}"></script>
@stop
@extends('layouts.app')

@section('content')
<div class="row">

  <div class="col-lg-2">
    <a href="{{ route('user.create') }}" class="btn btn-inverse-success btn-fw"><i class="fa fa-plus"></i> Register akun baru</a>
  </div>
</div>
<div class="row" style="margin-top: 20px;">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">

      <div class="card-body">
        <h4 class="card-title">Data Akun</h4>

        <div class="table-responsive">
          <table id="table" class="table table-striped">
            <thead>
              <tr>
                <th>
                  Name
                </th>
                <th>
                  Username
                </th>
                <th>
                  Email
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
                <td class="py-1">
                  @if($d->gambar)
                  <img src="{{url('images/user', $d->gambar)}}" alt="image" style="margin-right: 10px;" />
                  @else
                  <img src="{{url('images/user/default.png')}}" alt="image" style="margin-right: 10px;" />

                  @endif


                  {{$d->name}}
                </td>
                <td>
                  <a href="{{route('user.show', $d->id)}}">
                    {{$d->username}}
                  </a>
                </td>
                <td>
                  {{$d->email}}
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
                      <a class="dropdown-item" href="{{route('user.edit', $d->id)}}"> Edit </a>
                      <button data-id="{{ $d->id }}" class="dropdown-item btn-hapususer"> Hapus
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