@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card card-custom shadow mb-4">
        <div class="card-header flex-wrap py-3">
            <div class="card-title">
                <h4 class="h4">Daftar Kegiatan Aplikasi Lama</h4>
            </div>
        </div>
        <div class="card-body">
          <div class="table">
            <table class="table table-bordered" id="kegiatan" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Id Sub Bidang</th>
                  <th>Nama Kegiatan</th>
                  <th>Tanggal Mulai</th>
                  <th>Tanggal Selesai</th>
                  <th>Prakiraan SKPK</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kegiatan as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->id_sub_bidang}}</td>
                        <td>{{$item->nama_kegiatan}}</td>
                        <td>{{$item->mulai_kegiatan}}</td>
                        <td>{{$item->selesai_kegiatan}}</td>
                        <td>{{$item->prakiraan_skpk}}</td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>
@endsection

@push('addon-script')
    <script>
        $(document).ready(function () {
            $('#kegiatan').DataTable();
        });
    </script>
@endpush

