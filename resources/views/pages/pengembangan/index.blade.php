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
                  <th>Tanggal Pengajuan</th>
                  <th>Jumlah Peserta</th>
                  <th>Sudah Sah</th>
                  <th>Belum Sah</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->asosiasi->name}}</td>
                        <td>{{$item->nama_kegiatan}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{count($item->peserta)}}</td>
                        <td>
                          <span class="badge badge-success">Sudah di Sahkan : {{count($item->peserta()->where('is_sah', 1)->get())}}</span><br/>
                        </td>
                        <td>
                          <span class="badge badge-warning mt-2">Belum di Sahkan : {{count($item->peserta()->whereNull('is_sah')->get())}}</span>
                        </td>
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

