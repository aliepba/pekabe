@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-2 mt-2">
            <h4 class="h4">{{$data->nama_kegiatan}}</h4>
        </div>
        <div class="card-body">
            <div class="d-flex mb-9">
                <!--begin: Pic-->
                <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                    <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                        <span class="font-size-h3 symbol-label font-weight-boldest">JM</span>
                    </div>
                </div>
                <!--end::Pic-->
                <!--begin::Info-->
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex justify-content-between flex-wrap mt-1">
                        <div class="d-flex mr-3">
                            <a href="#" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">{{$data->nama_kegiatan}}</a>
                            <a href="#">
                                <i class="flaticon2-correct text-success font-size-h5"></i>
                            </a>
                        </div>
                        <div class="my-lg-0 my-3">
                            @if ($data->status_permohonan_kegiatan == 'SUBMIT' || $data->status_permohonan_kegiatan == 'PELAPORAN' || $data->status_permohonan_kegiatan == 'VALIDASI' || $data->status_permohonan_kegiatan == 'PENGESAHAN' )
                            <span class="badge badge-primary">SUBMITTED</span>
                            @elseif ($data->status_permohonan_kegiatan == 'APPROVE')
                            <span class="badge badge-danger">Submit Pelaporan</span>
                            @else
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('submit.kegiatan', $data->uuid)}}">Submit</a>
                                    <a href="{{route('kegiatan-penyelenggara.edit', $data->id)}}" class="dropdown-item">Edit</a>
                                </div>
                            </div>
                            @endif
                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'root')
                            <a href="{{route('kegiatan-penyelenggara.edit', $data->id)}}" class="btn btn-sm btn-primary">Edit</a>
                            @endif
                        </div>
                    </div>
                    <!--end::Title-->
                    <!--begin::Content-->
                    <div class="d-flex flex-wrap justify-content-between mt-1">
                        <div class="d-flex flex-column flex-grow-1 pr-8">
                            <div class="d-flex flex-wrap mb-4">
                                <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                <i class="flaticon2-pen mr-2 font-size-lg"></i>{{$data->validator->Nama}}</a>
                                <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                <i class="flaticon-map-location mr-2 font-size-lg"></i>{{$data->tempat_kegiatan}}</a>
                                <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                <i class="flaticon-earth-globe mr-2 font-size-lg"></i>
                                {{$result = ($data->tingkat_kegiatan == 1) ? 'Nasional' : (($data->tingkat_kegiatan == 2) ? 'Internasional Dalam Negeri' : 'Internasional Luar Negeri')}}
                                </a>
                                <a href="#" class="text-dark-50 text-hover-primary font-weight-bold">
                                <i class="flaticon-calendar-with-a-clock-time-tools mr-2 font-size-lg"></i>{{$data->start_kegiatan}} s/d {{$data->end_kegiatan}}</a>
                            </div>
                        </div>
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Info-->
            </div>
            <div class="row">
                <a href="{{asset('storage/'. $data->surat_permohonan)}}" class="btn btn-sm btn-primary rounded-lg ml-2" target="_blank"><i class="flaticon-file"></i>Surat Permohonan</a>
                <a href="{{asset('storage/'. $data->tor_kak)}}" class="btn btn-sm btn-primary rounded-lg ml-2" target="_blank"><i class="flaticon-file"></i>TOR / KAK</a>
                <a href="{{asset('storage/'. $data->cv)}}" class="btn btn-sm btn-primary rounded-lg ml-2" target="_blank"><i class="flaticon-file"></i>CV</a>
                <a href="{{asset('storage/'. $data->sk_panitia)}}" class="btn btn-sm btn-primary rounded-lg ml-2" target="_blank"><i class="flaticon-file"></i>SK Panitia</a>
                <a href="{{asset('storage/'. $data->persyaratan_lain)}}" class="btn btn-sm btn-primary rounded-lg ml-2" target="_blank"><i class="flaticon-file"></i>Persyaratan Lain</a>
                <a href="{{asset('storage/'. $data->persyaratan_lain_lain)}}" class="btn btn-sm btn-primary rounded-lg ml-2" target="_blank"><i class="flaticon-file"></i>Lainnya</a>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <ul class="nav nav-pills" id="myTab1" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab-1" data-toggle="tab" href="#detail">
                    <span class="nav-icon">
                        <i class="flaticon2-chat-1"></i>
                    </span>
                    <span class="nav-text">Detail</span>
                </a>
            </li>
            @if ($setting->is_active == 1)
                @if ($data->status_permohonan_kegiatan == 'APPROVE' && \Carbon\Carbon::parse(\Carbon\Carbon::now())->diffInDays($data->end_kegiatan) <= 14 && (Auth::user()->id == $data->user_id ))
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab-1" data-toggle="tab" href="#tab-peserta" aria-controls="profile">
                        <span class="nav-icon">
                            <i class="flaticon2-layers-1"></i>
                        </span>
                        <span class="nav-text">Peserta Kegiatan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab-1" data-toggle="tab" href="#tab-pelaporan" aria-controls="profile">
                        <span class="nav-icon">
                            <i class="flaticon2-layers-1"></i>
                        </span>
                        <span class="nav-text">Berkas Laporan Kegiatan</span>
                    </a>
                </li>
                @endif
            @endif
            @if ($setting->is_active == 0 && (Auth::user()->id == $data->user_id) && $data->status_permohonan_kegiatan == 'APPROVE')
            <li class="nav-item">
                <a class="nav-link" id="profile-tab-1" data-toggle="tab" href="#tab-peserta" aria-controls="profile">
                    <span class="nav-icon">
                        <i class="flaticon2-layers-1"></i>
                    </span>
                    <span class="nav-text">Peserta Kegiatan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab-1" data-toggle="tab" href="#tab-pelaporan" aria-controls="profile">
                    <span class="nav-icon">
                        <i class="flaticon2-layers-1"></i>
                    </span>
                    <span class="nav-text">Berkas Laporan Kegiatan</span>
                </a>
            </li>
            @endif
            @if ($data->is_verifikasi == 1 && $data->tgl_penilaian)
            <li class="nav-item">
                <a class="nav-link" id="profile-tab-1" data-toggle="tab" href="#tab-penilaian" aria-controls="profile">
                    <span class="nav-icon">
                        <i class="flaticon2-layers-1"></i>
                    </span>
                    <span class="nav-text">Hasil Penilaian</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
    <div class="tab-content mt-5" id="myTabContent1">
        <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="home-tab-1">
            @include('pages.kegiatan.detail')
        </div>
        <div class="tab-pane fade" id="tab-peserta" role="tabpanel" aria-labelledby="profile-tab-1">
            @include('pages.peserta.table-peserta')
        </div>
        <div class="tab-pane fade" id="tab-pelaporan" role="tabpanel" aria-labelledby="profile-tab-1">
            @include('pages.kegiatan.pelaporan.create')
        </div>
        @if (!empty($data->nilaiValidasi))
        <div class="tab-pane fade" id="tab-penilaian" role="tabpanel" aria-labelledby="profile-tab-1">
            @include('components.hasil-penilaian')
        </div>
        @endif
    </div>

</div>
@endsection

@push('addon-script')
    <script>
        $(document).ready(function () {
            $('#peserta').DataTable();
        });
    </script>
@endpush
