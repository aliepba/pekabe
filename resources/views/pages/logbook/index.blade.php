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

