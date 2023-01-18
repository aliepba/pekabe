@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{route('bobot-penilaian.create')}}" class="btn btn-sm btn-primary">
                <i class="flaticon-plus"></i>
                Tambah Sub Unsur Kegiatan
            </a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th class="align-middle" rowspan="4">No</th>
                  <th class="align-middle" rowspan="4">Nama</th>
                  <th class="align-middle" colspan="4">Jenis</th>
                  <th class="align-middle" colspan="2">Sifat</th>
                  <th class="align-middle" colspan="2">Metode</th>
                  <th class="align-middle" colspan="3">Tingkat</th>
                  <th class="align-middle" rowspan="4">Action</th>
                </tr>
                <tr>
                    <th class="align-middle" rowspan="3">Terverifikasi</th>
                    <th class="align-middle" colspan="2">Tidak Terverifikasi</th>
                    <th class="align-middle" rowspan="3">Mandiri</th>
                    <th class="align-middle" rowspan="3">Umum</th>
                    <th class="align-middle" rowspan="3">Khusus</th>
                    <th class="align-middle" rowspan="3">Tatap Muka</th>
                    <th class="align-middle" rowspan="3">Daring</th>
                    <th class="align-middle" rowspan="3">Nasional</th>
                    <th class="align-middle" rowspan="3">Internasional (dalam negeri)</th>
                    <th class="align-middle" rowspan="3">Internasional (luar negeri)</th>
                </tr>
                <tr>
                    <th class="align-middle" colspan="2">Penyelenggara PKB</th>
                </tr>
                <tr>
                    <th class="align-middle">dapat diverifikasi dan divalidasi</th>
                    <th class="align-middle">tidak dapat diverifikasi dan divalidasi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->nama_unsur}}</td>
                        <td>{{$item->verif != null ? $item->verif : "-"}}</td>
                        <td>{{$item->not_verif_penyelenggara != null ? $item->not_verif_penyelenggara : "-"}}</td>
                        <td>{{$item->not_verif_not_penyelenggara != null ? $item->not_verif_not_penyelenggara : "-"}}</td>
                        <td>{{$item->mandiri != null ? $item->mandiri : "-"}}</td>
                        <td>{{$item->umum != null ? $item->umum : "-"}}</td>
                        <td>{{$item->khusus != null ? $item->khusus : "-"}}</td>
                        <td>{{$item->tatap_muka != null ? $item->tatap_muka : "-"}}</td>
                        <td>{{$item->daring != null ? $item->daring : "-"}}</td>
                        <td>{{$item->nasional != null ? $item->nasional : "-"}}</td>
                        <td>{{$item->internasional_dalam_negeri != null ? $item->internasional_dalam_negeri : "-"}}</td>
                        <td>{{$item->internasional_luar_negeri != null ? $item->internasional_luar_negeri : "-"}}</td>
                        <td></td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>
@endsection
