@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card card-custom shadow mb-4">
        <div class="card-header flex-wrap py-3">
            <div class="card-title">
                <h4 class="h4">List Kegiatan Penyelenggara</h4>
            </div>
            {{-- <div class="card-toolbar">
                <a href="{{route('kegiatan-penyelenggara.create')}}" class="btn btn-sm btn-primary">
                    <i class="flaticon-plus"></i>
                    Tambah Kegiatan
                  </a>
            </div> --}}
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
                  <th>Terverifikasi</th>
                  <th>Penilaian Validator</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                    @foreach ($setuju as $item)
                        <?php
                        $subklas = explode(",",$item->subklasifikasi);
                        $metode = explode(",", $item->metode_kegiatan);
                        ?>
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->nama_kegiatan}}</td>
                            <td>{{$item->status_permohonan_kegiatan}} - (Masa Pelaporan Kegiatan {{$DeferenceInDays = \Carbon\Carbon::parse(\Carbon\Carbon::now())->diffInDays($item->end_kegiatan)}} Hari)</td>
                            <td>{{$item->tgl_pengajuan}}</td>
                            <td>{{$item->start_kegiatan}} <br/> {{$item->end_kegiatan}}</td>
                            <td>
                                @for ($i = 0; $i < count($subklas); $i++)
                                    <span class="badge badge-success mt-1">{{$subklas[$i]}}</span>
                                @endfor
                            </td>
                            <td>{{$item->validator->Nama}}</td>
                            <td>
                                <span class="badge badge-success">{{$item->is_verifikasi == '1' ? 'YES' : 'NO'}}</span>
                            </td>
                            <td>
                                <span class="badge badge-success">{{$item->tgl_penilaian == null ? 'BELUM' : 'SUDAH'}}</span>
                            </td>
                            <td>
                                <a href="{{route('kegiatan-penyelenggara.show', $item->uuid)}}" class="btn btn-sm btn-primary">Detail</a>
                            </td>
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

