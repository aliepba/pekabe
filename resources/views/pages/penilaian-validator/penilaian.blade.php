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
                            <a href="javascript:void(0)" onclick="updateKeabsahan({{$data->id}})" class="btn btn-sm btn-info"><i class="icon-x text-white-50 flaticon-eye"></i>Action</a>
                            {{-- <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('permohonan.approve', $data->uuid)}}">Submit</a>
                                </div>
                            </div> --}}
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
                                @if ($data->tingkat_kegiatan == 1)
                                    Nasional
                                @elseif ($data->tingkat_kegiatan == 2)
                                    Internasion Dalam Negeri
                                @else
                                    Internasion Luar Negeri
                                @endif
                                </a>
                                <a href="#" class="text-dark-50 text-hover-primary font-weight-bold">
                                <i class="flaticon-calendar-with-a-clock-time-tools mr-2 font-size-lg"></i>{{$data->start_kegiatan}} s/d {{$data->end_kegiatan}}</a>
                            </div>
                            <div class="row">
                            {{-- <a href="" class="btn btn-sm btn-primary rounded-lg col-md-3" target="_blank"><i class="flaticon-file"></i>{{$file1 != null ? $file1 : 'upload persyaratan'}}</a>
                            <a href="" class="btn btn-sm btn-primary rounded-lg col-md-3 ml-2" target="_blank"><i class="flaticon-file"></i>{{$file2 != null ? $file2 : 'upload persyaratan'}}</a>
                            <a href="" class="btn btn-sm btn-primary rounded-lg col-md-3 ml-2" target="_blank"><i class="flaticon-file"></i>{{$file2 != null ? $file2 : 'upload persyaratan'}}</a> --}}
                            </div>
                        </div>
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Info-->
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
                            <span class="text-muted">Penilai</span>
                            <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">{{$data->validator->Nama}}</a>
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
                            <span class="text-muted">Tingkat Kegiatan</span>
                            <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">{{$data->unsur->nama_sub_unsur}}</a>
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
    @if (!empty($data->nilaiPelaporan))
    <div class="row">
        <div class="col-lg-12 col-xxl-12">
            <!--begin::List Widget 9-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header align-items-center border-0 mt-4">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="font-weight-bolder text-dark">Penilaian Kegiatan</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-4">
                    <!--begin::Timeline-->
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="h5">Penilaian Sesuai Pelaporan</h5>
                            <div class="form-group row">
                                <label  class="col-2 col-form-label">Nilai SKPK</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" value="{{$data->nilaiPelaporan->nilai_skpk}}" readonly/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-2 col-form-label">Jenis Kegiatan</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" value="{{$data->nilaiPelaporan->is_jenis}}" readonly/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-2 col-form-label">Sifat Kegiatan</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" value="{{$data->nilaiPelaporan->is_sifat}}" readonly/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-2 col-form-label">Metode Kegiatan</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" value="{{$data->nilaiPelaporan->is_metode}}" readonly/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-2 col-form-label">Tingkat Kegiatan</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" value="{{$data->nilaiPelaporan->is_tingkat}}" readonly/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-2 col-form-label">Angka Kredit</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" value="{{$data->nilaiPelaporan->angka_kredit}}" readonly/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <form action="{{route('penilaian-validator.store')}}" method="POST">
                                @csrf
                                <h5 class="h5">Penilaian Validator</h5>
                                <div class="form-group row">
                                    <label  class="col-2 col-form-label">Nilai SKPK</label>
                                    <div class="col-10">
                                        <input class="form-control" type="number" min="0" max="{{$data->nilaiPelaporan->nilai_skpk}}" name="nilai_skpk" required/>
                                        <input name="id_kegiatan" value="{{$data->uuid}}" hidden/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label  class="col-2 col-form-label">Jenis Kegiatan</label>
                                    <div class="col-10">
                                        <select class="form-control" name="is_jenis" id="is_jenis">
                                            <option value="">Pilih Jenis</option>
                                            <option value="{{$bobot->verif}}">Terverfikasi</option>
                                            <option value="{{$bobot->no_verif_penyelenggara}}">Tidak Terverifikasi Penyelenggara PKB dapat diverifikasi dan divalidasi</optio   n>
                                            <option value="{{$bobot->no_verif_not_penyelenggara}}">Tidak Terverifikasi Penyelenggara PKB tidak dapat diverifikasi dan divalidasi</option>
                                            <option value="{{$bobot->mandiri}}">Mandiri</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label  class="col-2 col-form-label">Sifat Kegiatan</label>
                                    <div class="col-10">
                                        <select class="form-control" name="is_sifat" id="is_sifat">
                                            <option value="">Pilih Jenis</option>
                                            <option value="{{$bobot->umum}}">Umum</option>
                                            <option value="{{$bobot->khusus}}">Khusus</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label  class="col-2 col-form-label">Metode Kegiatan</label>
                                    <div class="col-10">
                                        <select class="form-control" name="is_metode" id="is_metode">
                                            <option value="">Pilih Metode</option>
                                            <option value="{{$bobot->tatap_muka}}">Tatap Muka</option>
                                            <option value="{{$bobot->daring}}">Daring</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label  class="col-2 col-form-label">Tingkat Kegiatan</label>
                                    <div class="col-10">
                                        <select class="form-control" name="is_tingkat" id="is_tingkat">
                                            <option value="">Pilih Tingkat</option>
                                            <option value="{{$bobot->nasional}}">Nasional</option>
                                            <option value="{{$bobot->internasional_dalam_negeri}}">Internasional Dalam Negeri</option>
                                            <option value="{{$bobot->internasional_luar_negeri}}">Internasional Luar Negeri</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button class="btn btn-primary btn-block" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--end::Timeline-->
                </div>
                <!--end: Card Body-->
            </div>
            <!--end: List Widget 9-->
        </div>
    </div>
    @endif
</div>
@endsection
