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
                            <a href="" class="btn btn-sm btn-info"><i class="icon-x text-white-50 flaticon-eye"></i>Submit</a>
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
                        </div>
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Info-->
            </div>
            <div class="row">
                <div class="col-md-6">
                   <div class="row">
                    <div class="col-md-4">
                        <label>Nama Kegiatan : </label>
                    </div>
                    <div class="col-md-6">
                        <label>{{$data->nama_kegiatan}}</label>
                    </div>
                    <div class="col-md-2">
                        <div class="checkbox-inline">
                            <label class="checkbox">
                                <input type="checkbox" name="Checkboxes2"/>
                                <span></span>
                            </label>
                        </div>
                    </div>
                   </div>
                   <div class="row">
                        <div class="col-md-4">
                            <label>Unsur Kegiatan : </label>
                        </div>
                        <div class="col-md-6">
                            <label>  @foreach ($data->unsurKegiatan as $unsurKegiatan)
                                {{$unsurKegiatan->unsur->nama_sub_unsur}}, <br/>
                                @endforeach</label>
                        </div>
                        <div class="col-md-2">
                            <div class="checkbox-inline">
                                <label class="checkbox">
                                    <input type="checkbox" name="Checkboxes2"/>
                                    <span></span>
                                </label>
                            </div>
                        </div>
                   </div>
                   <div class="row">
                    <div class="col-md-4">
                        <label>Metode Kegiatan : </label>
                    </div>
                    <div class="col-md-6">
                        <label>{{$data->metode_kegiatan}}</label>
                    </div>
                    <div class="col-md-2">
                        <div class="checkbox-inline">
                            <label class="checkbox">
                                <input type="checkbox" name="Checkboxes2"/>
                                <span></span>
                            </label>
                        </div>
                    </div>
                   </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                     <div class="col-md-4">
                         <label>Nama Kegiatan : </label>
                     </div>
                     <div class="col-md-6">
                         <label>{{$data->nama_kegiatan}}</label>
                     </div>
                     <div class="col-md-2">
                         <div class="checkbox-inline">
                             <label class="checkbox">
                                 <input type="checkbox" name="Checkboxes2"/>
                                 <span></span>
                             </label>
                         </div>
                     </div>
                    </div>
                    <div class="row">
                         <div class="col-md-4">
                             <label>Subklasifikasi : </label>
                         </div>
                         <div class="col-md-6">
                             <label>{{$data->subklasifikasi}}</label>
                         </div>
                         <div class="col-md-2">
                             <div class="checkbox-inline">
                                 <label class="checkbox">
                                     <input type="checkbox" name="Checkboxes2"/>
                                     <span></span>
                                 </label>
                             </div>
                         </div>
                    </div>
                    <div class="row">
                     <div class="col-md-4">
                         <label>Tingkat Kegiatan : </label>
                     </div>
                     <div class="col-md-6">
                         <label>@if ($data->tingkat_kegiatan == 1)
                             Nasional
                         @elseif ($data->tingkat_kegiatan == 2)
                             Internasion Dalam Negeri
                         @else
                             Internasion Luar Negeri
                         @endif</label>
                     </div>
                     <div class="col-md-2">
                         <div class="checkbox-inline">
                             <label class="checkbox">
                                 <input type="checkbox" name="Checkboxes2"/>
                                 <span></span>
                             </label>
                         </div>
                     </div>
                    </div>
                 </div>
                </div>
            <div class="row mt-5">
                <div class="col-md-3">
                    <a href="{{asset('storage/'. $data->laporan->upload_persyaratan)}}" target="_blank" class="btn btn-sm btn-primary rounded-lg"><i class="flaticon-file"></i>Laporan Kegiatan *</a> <br />
                </div>
                <div class="col-md-6 mt-3">
                    <div class="checkbox-inline">
                        <label class="checkbox">
                            <input type="checkbox" name="Checkboxes2"/>
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-3">
                    <a href="{{asset('storage/'. $data->laporan->materi_kegiatan)}}" target="_blank" class="btn btn-sm btn-primary rounded-lg mt-2"><i class="flaticon-file"></i>Materi Kegiatan *</a> <br />
                </div>
                <div class="col-md-6 mt-4">
                    <div class="checkbox-inline">
                        <label class="checkbox">
                            <input type="checkbox" name="Checkboxes2"/>
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-3">
                    <a href="{{asset('storage/'. $data->laporan->dokumentasi_kegiatan)}}" target="_blank" class="btn btn-sm btn-primary rounded-lg mt-2"><i class="flaticon-file"></i>Dokumentasi Kegiatan *</a>
                </div>
                <div class="col-md-2 mt-4">
                    <div class="checkbox-inline">
                        <label class="checkbox">
                            <input type="checkbox" name="Checkboxes2"/>
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="keterangan" rows="5"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
