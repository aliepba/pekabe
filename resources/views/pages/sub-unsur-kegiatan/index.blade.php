@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{route('sub-unsur-kegiatan.create')}}" class="btn btn-sm btn-primary">
                <i class="flaticon-plus"></i>
                Tambah Sub Unsur Kegiatan
            </a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Jenis Kegiatan</th>
                  <th>Unsur Kegiatan</th>
                  <th>Nilai SKPK</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->jenisKegiatan->unsur_kegiatan}}</td>
                        <td>{{$item->nama_sub_unsur}}</td>
                        <td>{{$item->nilai_skpk}}</td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>
@endsection
