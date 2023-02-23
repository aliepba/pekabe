@extends('layouts.apps')

@section('subheader')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Page Title-->
            <a href="{{route('kegiatan-terdaftar.create')}}" class="btn btn-md btn-success"> <i class="flaticon-plus"></i> Tambah Kegiatan Terdaftar Tahun 2020 - 2021</a>
            <a href="{{route('kegiatan.unverified')}}" class="btn btn-md btn-warning ml-2"> <i class="flaticon-plus"></i> Tambah Kegiatan Tidak Terverifikasi</a>
            <!--end::Page Title-->
            <!--begin::Actions-->

            <!--end::Actions-->
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container">
    {{-- <div class="card card-custom shadow mb-4">
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
                  <th>Nama Kegiatan</th>
                  <th>Tanggal Mulai</th>
                  <th>Tanggal Selesai</th>
                  <th>Jenis Kegiatan</th>
                  <th>Unsur Kegiatan</th>
                  <th>Metode Kegiatan</th>
                  <th>Tingkat Kegiatan</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->nama_kegiatan}}</td>
                        <td>{{$item->start_kegiatan}}</td>
                        <td>{{$item->end_kegiatan}}</td>
                        <td>{{$item->jenis_kegiatan}}</td>
                        <td>{{$item->unsur_kegiatan}}</td>
                        <td>{{$item->metode_kegiatan}}</td>
                        <td>
                            @if ($item->tingkat_kegiatan == 1)
                                    Nasional
                                @elseif ($item->tingkat_kegiatan == 2)
                                    Internasion Dalam Negeri
                                @else
                                    Internasion Luar Negeri
                                @endif
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div> --}}
    @include('components.table-logbook')
</div>
@endsection


