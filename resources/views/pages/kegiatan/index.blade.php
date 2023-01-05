@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="h4">List Kegiatan Penyelenggara</h4>
            <a href="{{route('kegiatan-penyelenggara.create')}}" class="btn btn-sm btn-primary">
                <i class="flaticon-plus"></i>
                Tambah Kegiatan
              </a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kegiatan</th>
                  <th>Status</th>
                  <th>Tanggal Pengajuan</th>
                  <th>Tanggal Kegiatan</th>
                  <th>Subklasifikasi Tenaga Ahli</th>
                  <th>Penilai</th>
                  <th>Unsur</th>
                  <th>Metode</th>
                  <th>Tingkat</th>
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
                        <td>{{$item->start_kegiatan}} - {{$item->end_kegiatan}}</td>
                        <td>
                            @for ($i = 0; $i < count($subklas); $i++)
                                <span class="badge badge-success mt-1">{{$subklas[$i]}}</span> <br />
                            @endfor
                        </td>
                        <td>{{$item->penilai}}</td>
                        <td>{{$item->unsur_kegiatan}}</td>
                        <td>
                            @for ($j = 0; $j < count($metode); $j++)
                                <span class="badge badge-success mt-1">{{$metode[$j]}}</span> <br />
                            @endfor
                        </td>
                        <td>{{$item->tingkat_kegiatan}}</td>
                        <td>
                            <a href="{{route('kegiatan-penyelenggara.show', $item->uuid)}}" class="btn btn-sm btn-primary"><i class="far fa-eye"></i>Detail</a>
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
