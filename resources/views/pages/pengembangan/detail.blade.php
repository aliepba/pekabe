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
    @if ($data->laporan != null)
    <div class="card shadow mb-4">
        <div class="card-header py-2 mt-2">
            Dokumen Pelaporan
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3">
                    <a href="http://localhost:2121/{{$data->laporan->laporan_kegiatan}}" class="btn btn-sm btn-primary rounded-lg" target="_blank"><i class="flaticon-file"></i>Laporan Kegiatan *</a> <br />
                    <a href="http://localhost:2121/{{$data->laporan->materi_kegiatan}}" class="btn btn-sm btn-primary rounded-lg mt-2" target="_blank"><i class="flaticon-file"></i>Materi Kegiatan *</a> <br />
                    <a href="http://localhost:2121/{{$data->laporan->dokumentasi_kegiatan}}" class="btn btn-sm btn-primary rounded-lg mt-2" target="_blank"><i class="flaticon-file"></i>Dokumentasi Kegiatan *</a>
                </div>
                <div class="col-md-7">
                    <form action="{{route('pengembangan.sah', $data->uuid)}}" method="POST">
                    @method('PUT')
                    @csrf
                    <textarea rows="5" class="form-control" name="keterangan_pengesahan"></textarea>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            Peserta
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="peserta" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peserta</th>
                        <th>NIK</th>
                        <th>Metode</th>
                        <th>Unsur</th>
                        <th>Nilai</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($data->peserta as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{\App\Actions\Logbook\GetNamaTenagaAhli::run($item->nik)}}</td>
                        <td>{{$item->nik}}</td>
                        <td>{{$item->metode}}</td>
                        <td>{{$item->subUnsur->nama_sub_unsur}}</td>
                        <td>{{$item->subUnsur->nilai_skpk}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
        </div>
    </div>
    @endif
</div>
@endsection