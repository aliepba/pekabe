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
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('permohonan.approve', $data->uuid)}}">Submit</a>
                                    <a href="javascript:void(0)" onclick="kirimPerbaikan({{$data->id}})" class="dropdown-item" href="#">Edit</a>
                                </div>
                            </div>
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
                                <i class="flaticon-earth-globe mr-2 font-size-lg"></i>{{$data->tingkat_kegiatan}}</a>
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
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xxl-4">
            <!--begin::List Widget 9-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header align-items-center border-0 mt-4">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="font-weight-bolder text-dark">Timeline Kegiatan</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-4">
                    <!--begin::Timeline-->
                    @foreach ($data->timeline as $item)
                    <div class="timeline timeline-6 mt-3">
                        <!--begin::Item-->
                        <div class="timeline-item align-items-start">
                            <!--begin::Label-->
                            <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">{{$item->status_permohonan}}</div>
                            <!--end::Label-->
                            <!--begin::Badge-->
                            <div class="timeline-badge ml-5">
                                <i class="fa fa-genderless text-warning icon-xl"></i>
                            </div>
                            <!--end::Badge-->
                            <!--begin::Text-->
                            <div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3">{{$item->created_at}}</div>
                            <!--end::Text-->
                        </div>
                        <!--end::Item-->
                    </div>
                    @endforeach
                    <!--end::Timeline-->
                </div>
                <!--end: Card Body-->
            </div>
            <!--end: List Widget 9-->
        </div>
    </div>
</div>
@endsection
