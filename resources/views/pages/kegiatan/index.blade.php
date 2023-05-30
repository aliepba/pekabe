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
                  <th>Kegiatan</th>
                  <th>Status</th>
                  <th>Tanggal Pengajuan</th>
                  <th>Tanggal Kegiatan</th>
                  <th>Subklasifikasi Tenaga Ahli</th>
                  <th>Penilai</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kegiatan as $item)
                    <?php
                    $subklas = explode(",",$item->subklasifikasi);
                    $metode = explode(",", $item->metode_kegiatan);
                    ?>
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->nama_kegiatan}}</td>
                        <td>{{$item->status_permohonan_kegiatan}}</td>
                        <td>{{$item->tgl_pengajuan}}</td>
                        <td>{{$item->start_kegiatan}} <br/> {{$item->end_kegiatan}}</td>
                        <td>
                            @for ($i = 0; $i < count($subklas); $i++)
                                <span class="badge badge-success mt-1">{{$subklas[$i]}}</span>
                            @endfor
                        </td>
                        <td>{{$item->validator->Nama}}</td>
                        @if ($setting->is_active == 1)
                            @if (\Carbon\Carbon::parse(\Carbon\Carbon::now())->diffInDays($item->start_kegiatan) <= $setting->maks_hari)
                                <td>
                                    <a href="{{route('kegiatan-penyelenggara.show', $item->uuid)}}" class="btn btn-sm btn-primary">Detail</a>
                                    @if ($item->status_permohonan_kegiatan == 'OPEN')
                                    <form action="{{route('kegiatan-penyelenggara.destroy', $item->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                    <button class="btn btn-danger btn-sm mt-5"><i class="flaticon2-trash"></i></button>
                                </form>
                                @endif
                                </td>
                            @else
                                <td>
                                    Kegiatan tidak dapat diajukan karena maksimal 3 hari sebelum tanggal kegiatan
                                </td>
                            @endif
                        @endif
                        @if ($setting->is_active == 0)
                             <td>
                                    <a href="{{route('kegiatan-penyelenggara.show', $item->uuid)}}" class="btn btn-sm btn-primary">Detail</a>
                                    @if ($item->status_permohonan_kegiatan == 'OPEN')
                                    <form action="{{route('kegiatan-penyelenggara.destroy', $item->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                    <button class="btn btn-danger btn-sm mt-5"><i class="flaticon2-trash"></i></button>
                                </form>
                                @endif
                                </td>
                        @endif
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

