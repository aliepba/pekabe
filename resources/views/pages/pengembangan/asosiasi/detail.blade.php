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
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex align-items-center mb-10">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-40 symbol-light-success mr-5">
                            <span class="symbol-label">
                                <img src="assets/media/svg/avatars/009-boy-4.svg" class="h-75 align-self-end" alt="" />
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                            <span class="text-muted">Nama Kegiatan</span>
                            <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">{{$data->nama_kegiatan}}</a>
                        </div>
                        <!--end::Text-->
                    </div>
                    <div class="d-flex align-items-center mb-10">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-40 symbol-light-success mr-5">
                            <span class="symbol-label">
                                <img src="assets/media/svg/avatars/009-boy-4.svg" class="h-75 align-self-end" alt="" />
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                            <span class="text-muted">Unsur Kegiatan</span>
                            <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">
                                @foreach ($data->unsurKegiatan as $unsurKegiatan)
                                {{$unsurKegiatan->unsur->nama_sub_unsur}}, <br/>
                                @endforeach
                            </a>
                        </div>
                        <!--end::Text-->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center mb-10">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-40 symbol-light-success mr-5">
                            <span class="symbol-label">
                                <img src="assets/media/svg/avatars/009-boy-4.svg" class="h-75 align-self-end" alt="" />
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                            <span class="text-muted">Subklasifikasi</span>
                            <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">{{$data->subklasifikasi}}</a>
                        </div>
                        <!--end::Text-->
                    </div>
                    <div class="d-flex align-items-center mb-10">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-40 symbol-light-success mr-5">
                            <span class="symbol-label">
                                <img src="assets/media/svg/avatars/009-boy-4.svg" class="h-75 align-self-end" alt="" />
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                            <span class="text-muted">Metode Kegiatan</span>
                            <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">{{$data->metode_kegiatan}}</a>
                        </div>
                        <!--end::Text-->
                    </div>
                    <div class="d-flex align-items-center mb-10">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-40 symbol-light-success mr-5">
                            <span class="symbol-label">
                                <img src="assets/media/svg/avatars/009-boy-4.svg" class="h-75 align-self-end" alt="" />
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                            <span class="text-muted">Tempat Kegiatan</span>
                            <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">{{$data->tempat_kegiatan}}</a>
                        </div>
                        <!--end::Text-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <ul class="nav nav-pills" id="myTab1" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="profile-tab-1" data-toggle="tab" href="#tab-peserta" aria-controls="profile">
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
        </ul>
    </div>
    <div class="tab-content mt-5" id="myTabContent1">
        <div class="tab-pane fade show active" id="tab-peserta" role="tabpanel" aria-labelledby="profile-tab-1">
            @include('pages.pengembangan.asosiasi.table-peserta')
        </div>
        <div class="tab-pane fade" id="tab-pelaporan" role="tabpanel" aria-labelledby="profile-tab-1">
            @include('pages.pengembangan.asosiasi.table-laporan')
        </div>
    </div>
</div>
@endsection