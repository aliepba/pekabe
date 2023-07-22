@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card card-custom shadow mb-4">
        <div class="card-header flex-wrap py-3">
            <div class="card-title">
                <h4 class="h4">List Kegiatan Penyelenggara</h4>
            </div>
        </div>
        <div class="card-body">
          <div class="table">
            <table class="table table-bordered" id="kegiatan" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Asosiasi</th>
                  <th>Kegiatan</th>
                  <th>Jumlah Peserta</th>
                  <th>Tanggal Pengajuan</th>
                  <th>Tanggal Kegiatan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->asosiasi->name}}</td>
                        <td>{{$item->nama_kegiatan}}</td>
                        <td>{{count($item->peserta)}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->start_kegiatan}} <br/> {{$item->end_kegiatan}}</td>
                        <td>
                            <a href="{{route('pengembangan.detail', $item->uuid)}}" class="btn btn-sm btn-primary">Detail</a>
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            <div class="row">
                <span class="text-muted">*OPEN - kegiatan dibuat</span>
                <span class="text-muted">*SUBMIT - kegiatan diajukan</span>
                <span class="text-muted">*APPROVE - kegiatan disetujui</span>
            </div>
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

