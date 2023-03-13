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
                            {{-- <a href="javascript:void(0)" onclick="updateKeabsahan({{$data->id}})" class="btn btn-sm btn-info"><i class="icon-x text-white-50 flaticon-eye"></i>Action</a> --}}
                            <a href="{{route('kegiatan-penyelenggara.edit', $data->id)}}" class="btn btn-sm btn-primary">Edit</a>
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
    @if ($data->laporan->status_laporan == 'SUBMIT')
    <div class="card shadow mb-4">
        <div class="card-header py-2 mt-2">
            Dokumen Pelaporan
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3">
                    <a href="{{asset('storage/'. $data->laporan->upload_persyaratan)}}" target="_blank" class="btn btn-sm btn-primary rounded-lg"><i class="flaticon-file"></i>Laporan Kegiatan *</a> <br />
                    <a href="{{asset('storage/'. $data->laporan->materi_kegiatan)}}" target="_blank" class="btn btn-sm btn-primary rounded-lg mt-2"><i class="flaticon-file"></i>Materi Kegiatan *</a> <br />
                    <a href="{{asset('storage/'. $data->laporan->dokumentasi_kegiatan)}}" target="_blank" class="btn btn-sm btn-primary rounded-lg mt-2"><i class="flaticon-file"></i>Dokumentasi Kegiatan *</a>
                </div>
                <div class="col-md-7">
                    <form action="{{route('pengesahan.selesai', $data->uuid)}}" method="POST">
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
            <a href="{{route('peserta.create', $data->uuid)}}" class="btn btn-sm btn-primary">
              <i class="flaticon-plus"></i>
              Tambah Peserta
            </a>
          </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="peserta" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Metode</th>
                        <th>Unsur</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($data->peserta as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->nik_peserta}}</td>
                        <td>{{$item->metode_peserta}}</td>
                        <td>{{$item->unsur->nama_sub_unsur}}</td>
                        <td>
                            <a href="{{route('peserta.edit', $item->id)}}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{route('peserta.destroy', $item->id)}}" method="post">
                                @csrf
                                @method('delete')
                            <button class="btn btn-danger btn-sm mt-5">Hapus</button>
                            </form>
                        </td>
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

@push('addon-script')
<script>
    document.getElementById('checkSurat').onchange = function() {
            document.getElementById('keterangan_surat').disabled = !this.checked;
        };

        document.getElementById('checkTor').onchange = function() {
            document.getElementById('tor_kak').disabled = !this.checked;
        };

        document.getElementById('checkCV').onchange = function() {
            document.getElementById('cv').disabled = !this.checked;
        };
</script>
@endpush
