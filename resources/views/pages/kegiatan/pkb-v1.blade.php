@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card card-custom shadow mb-4">
        <div class="card-header flex-wrap py-3">
            <div class="card-title">
                <h4 class="h4">List Kegiatan Penyelenggara</h4>
            </div>
            <div class="card-toolbar">
                <a href="{{route('kegiatan-penyelenggara.create')}}" class="btn btn-sm btn-primary">
                    <i class="flaticon-plus"></i>
                    Tambah Kegiatan
                  </a>
            </div>
        </div>
        <div class="card-body">
          <div class="table">
            <table class="table table-bordered" id="kegiatan" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Tempat Kegiatan</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Tanggal Kegiatan</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->nama_kegiatan}}</td>
                        <td>{{$item->tempat_kegiatan}}</td>
                        <td>{{$item->mulai_kegiatan}}</td>
                        <td>{{$item->selesai_kegiatan}}</td>
                    <tr>
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

