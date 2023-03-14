@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="h5">List Penilaian Validator Kegiatan</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="kegiatan" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Kegiatan</th>
                    <th>Status</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Tanggal Kegiatan</th>
                    <th>Subklasifikasi Tenaga Ahli</th>
                    <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($data as $item)
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
                    <td>
                        <a href="{{route('verifikasi-validasi.show', $item->uuid)}}" class="btn btn-sm btn-primary">Proses</a>
                    </td>
                </tr>
                @endforeach
              </tbody>
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
