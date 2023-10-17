@extends('layouts.apps')

@section('content')
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                    </div>
                </div>
                <!--begin::Body-->
                <div class="card-body">
                    <table class="table table-bordered" id="peserta" width="100%" cellspacing="0">
                        <thead class="text-center" style="vertical-align: middle;">
                            <tr>
                                <td rowspan="3">No</td>
                                <td rowspan="3">Asosiasi Profesi</td>
                                <td rowspan="3">Status</td>
                                <td colspan="3">Kegiatan PKB Reguler</td>
                                <td colspan="2">Pengembangan PKB</td>
                                <td colspan="4">Jumlah SKK Anggota</td>
                                <td colspan="3">Kebutuhan VS Perolehan Nilai Kredit</td> 
                            </tr>
                            <tr>
                                <td rowspan="2">Kegiatan Disetujui</td>
                                <td colspan="2">kegiatan yang dilaporkan</td>
                                <td rowspan="2">Jumlah Kegiatan</td>
                                <td rowspan="2">Jumlah TA Kegiatan</td>
                                <td rowspan="2">Total</td>
                                <td rowspan="2">7</td>
                                <td rowspan="2">8</td>
                                <td rowspan="2">9</td>
                                <td rowspan="2">Kebutuhan Nilai Kredit</td>
                                <td rowspan="2">Perolehan Nilai Kredit</td>
                                <td rowspan="2">Rasio *)</td>
                            </tr>
                            <tr>
                                <td>Jumlah kegiatan</td>
                                <td>Jumlah TA kegiatan</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asosiasi as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->Nama}}</td>
                                    <td>{{$item->Terakreditasi == 1 ? 'Terakreditasi' : 'Belum Teralreditasi'}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{$item->jenjang7}}</td>
                                    <td>{{$item->jenjang8}}</td>
                                    <td>{{$item->jenjang9}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!--end::Body-->
            </div>
        </div>
    </div>
</div>
@endsection