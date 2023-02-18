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
                                <i class="flaticon-earth-globe mr-2 font-size-lg"></i>@if ($data->tingkat_kegiatan == 1)
                                Nasional
                            @elseif ($data->tingkat_kegiatan == 2)
                                Internasion Dalam Negeri
                            @else
                                Internasion Luar Negeri
                            @endif</a>
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
                        <span class="text-muted">Penyelanggara Lain</span>
                        <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">
                            @foreach ($data->penyelenggaraLain as $item)
                                {{$item->userPenyelenggara->nama_instansi}}, <br/>
                            @endforeach
                        </a>
                    </div>
                    <!--end::Text-->
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xxl-12">
            <!--begin::List Widget 9-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header align-items-center border-0 mt-4">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="font-weight-bolder text-dark">Upload Persyaratan</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-4">
                    <!--begin::Timeline-->
                    <div class="row">
                        <div class="col-lg-2">
                            <a href="{{asset('storage/'. $data->surat_permohonan)}}" target="_blank" class="btn btn-sm btn-primary rounded-lg"><i class="flaticon-file"></i>Surat Permohonan *</a>
                        </div>
						<div class="col-lg-2">
							<span class="switch switch-icon">
								<label>
								<input type="checkbox" name="select" id="checkSurat"/>
								<span></span>
								</label>
							</span>
						</div>
                        <div class="col-lg-8">
                            <form id="suratPermohonan">
                                @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Keterangan Perbaikan" name="keterangan_surat" id="keterangan_surat" disabled/>
                                <input type="hidden" value="{{$data->uuid}}" name="id_kegiatan"/>
                                <input type="hidden" value="edit.surat" name="linkSurat"/>
                                <input type="hidden" value="{{$data->user_id}}" name="user_id_surat"/>
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">Kirim!</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2">
                            <a href="{{asset('storage/'. $data->tor_kak)}}" target="_blank" class="btn btn-sm btn-primary rounded-lg"><i class="flaticon-file"></i>TOR / KAK</a><span class="text-danger">*</span>
                        </div>
                        <div class="col-lg-2">
							<span class="switch switch-icon">
								<label>
								<input type="checkbox" name="select" id="checkTor"/>
								<span></span>
								</label>
							</span>
						</div>
                        <div class="col-lg-8">
                            <form id="torKAK">
                                @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Keterangan Perbaikan" name="tor_kak" id="tor_kak" disabled/>
                                <input type="hidden" value="{{$data->uuid}}" name="id_kegiatan"/>
                                <input type="hidden" value="edit.tor" name="linkTor"/>
                                <input type="hidden" value="{{$data->user_id}}" name="user_id_surat"/>
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">Kirim!</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2">
                            <a href="{{asset('storage/'. $data->cv)}}" target="_blank" class="btn btn-sm btn-primary rounded-lg"><i class="flaticon-file"></i>CV</a>
                        </div>
                        <div class="col-lg-2">
							<span class="switch switch-icon">
								<label>
								<input type="checkbox" name="select" id="checkCV"/>
								<span></span>
								</label>
							</span>
						</div>
                        <div class="col-lg-8">
                            <form id="cvForm">
                                @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Keterangan Perbaikan" name="cv" id="cv" disabled/>
                                <input type="hidden" value="{{$data->uuid}}" name="id_kegiatan"/>
                                <input type="hidden" value="edit.cv" name="linkCV"/>
                                <input type="hidden" value="{{$data->user_id}}" name="user_id_surat"/>
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">Kirim!</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2">
                            <a href="{{asset('storage/'. $data->sk_panitia)}}" target="_blank" class="btn btn-sm btn-primary rounded-lg"><i class="flaticon-file"></i>SK Panitia</a>
                        </div>
                        <div class="col-lg-2">
							<span class="switch switch-icon">
								<label>
								<input type="checkbox" name="select" id="checkSK"/>
								<span></span>
								</label>
							</span>
						</div>
                        <div class="col-lg-8">
                            <form id="skForm">
                                @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Keterangan Perbaikan" name="sk" id="sk_panitia" disabled/>
                                <input type="hidden" value="{{$data->uuid}}" name="id_kegiatan"/>
                                <input type="hidden" value="edit.sk" name="linkSK"/>
                                <input type="hidden" value="{{$data->user_id}}" name="user_id_surat"/>
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">Kirim!</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2">
                            <a href="{{asset('storage/'. $data->persyaratan_lain)}}" target="_blank" class="btn btn-sm btn-primary rounded-lg"><i class="flaticon-file"></i>Persyaratan Lain</a>
                        </div>
                        <div class="col-lg-2">
							<span class="switch switch-icon">
								<label>
								<input type="checkbox" name="select" id="checklain1"/>
								<span></span>
								</label>
							</span>
						</div>
                        <div class="col-lg-8">
                            <form id="lain1Form">
                                @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Keterangan Perbaikan" name="lain1" id="persyaratan_lain" disabled/>
                                <input type="hidden" value="{{$data->uuid}}" name="id_kegiatan"/>
                                <input type="hidden" value="edit.lain1" name="linkLain1"/>
                                <input type="hidden" value="{{$data->user_id}}" name="user_id_surat"/>
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">Kirim!</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2">
                            <a href="{{asset('storage/'. $data->persyaratan_lain_lain)}}" target="_blank" class="btn btn-sm btn-primary rounded-lg"><i class="flaticon-file"></i>Lainnya</a>
                        </div>
                        <div class="col-lg-2">
							<span class="switch switch-icon">
								<label>
								<input type="checkbox" name="select" id="checklain2"/>
								<span></span>
								</label>
							</span>
						</div>
                        <div class="col-lg-8">
                            <form id="lain2Form">
                                @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Keterangan Perbaikan" name="lain2" id="lainnya" disabled/>
                                <input type="hidden" value="{{$data->uuid}}" name="id_kegiatan"/>
                                <input type="hidden" value="edit.lain2" name="linkLain2"/>
                                <input type="hidden" value="{{$data->user_id}}" name="user_id_surat"/>
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">Kirim!</button>
                                </div>
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
</div>
@endsection

@push('addon-script')
<div class="modal fade" id="keabsahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Approve / Tolak Kegiatan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{route('verifikasi.status')}}" method="POST" id="perbaikanForm">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status_permohonan">
                            <option value="APPROVE">APPROVE</option>
                            <option value="TOLAK">TOLAK</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Keterangan Perbaikan</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" rows="5"></textarea>
                        <input type="text" class="form-control" name="id" id="id" hidden/>
                        <input type="text" class="form-control" name="uuid" id="uuid" Hidden/>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>

        function updateKeabsahan(id){
            $.get('/detail/'+id, function(data){
                $("#id").val(data.id);
                $("#uuid").val(data.uuid);
                $("#keabsahan").modal("toggle");
            })
        }

        document.getElementById('checkSurat').onchange = function() {
            document.getElementById('keterangan_surat').disabled = !this.checked;
        };

        document.getElementById('checkTor').onchange = function() {
            document.getElementById('tor_kak').disabled = !this.checked;
        };

        document.getElementById('checkCV').onchange = function() {
            document.getElementById('cv').disabled = !this.checked;
        };


        document.getElementById('checkSK').onchange = function() {
            document.getElementById('sk_panitia').disabled = !this.checked;
        };


        document.getElementById('checklain1').onchange = function() {
            document.getElementById('persyaratan_lain').disabled = !this.checked;
        };


        document.getElementById('checklain2').onchange = function() {
            document.getElementById('lainnya').disabled = !this.checked;
        };


        $('#suratPermohonan').submit(function(e){
            e.preventDefault();
            var idKegiatan = $("input[name=id_kegiatan]").val();
            var linkSurat = $("input[name=linkSurat]").val();
            var komen = $("input[name=keterangan_surat]").val();
            var user_id = $("input[name=user_id_surat]").val();
            var _token = $("input[name=_token]").val();

            $.ajax({
                url : "{{route('add.komen')}}",
                type : "POST",
                data : {
                    id_kegiatan : idKegiatan,
                    link : linkSurat,
                    keterangan : komen,
                    user_id : user_id,
                    _token : _token
                },
                success:function(response){
                    swal("Done!","Deskripsi Perbaikan Dikirim","success");
                    document.getElementById('keterangan_surat').value = '';
                }
            });
        })

        $('#torKAK').submit(function(e){
            e.preventDefault();
            var idKegiatan = $("input[name=id_kegiatan]").val();
            var linkSurat = $("input[name=linkTor]").val();
            var komen = $("input[name=tor_kak]").val();
            var user_id = $("input[name=user_id_surat]").val();
            var _token = $("input[name=_token]").val();

            $.ajax({
                url : "{{route('add.komen')}}",
                type : "POST",
                data : {
                    id_kegiatan : idKegiatan,
                    link : linkSurat,
                    keterangan : komen,
                    user_id : user_id,
                    _token : _token
                },
                success:function(response){
                    swal("Done!","Deskripsi Perbaikan Dikirim","success");
                    document.getElementById('tor_kak').value = '';
                }
            });
        })

        $('#cvForm').submit(function(e){
            e.preventDefault();
            var idKegiatan = $("input[name=id_kegiatan]").val();
            var linkSurat = $("input[name=linkCV]").val();
            var komen = $("input[name=cv]").val();
            var user_id = $("input[name=user_id_surat]").val();
            var _token = $("input[name=_token]").val();

            $.ajax({
                url : "{{route('add.komen')}}",
                type : "POST",
                data : {
                    id_kegiatan : idKegiatan,
                    link : linkSurat,
                    keterangan : komen,
                    user_id : user_id,
                    _token : _token
                },
                success:function(response){
                    swal("Done!","Deskripsi Perbaikan Dikirim","success");
                    document.getElementById('cv').value = '';
                }
            });
        })

        $('#skForm').submit(function(e){
            e.preventDefault();
            var idKegiatan = $("input[name=id_kegiatan]").val();
            var linkSurat = $("input[name=linkSK]").val();
            var komen = $("input[name=sk]").val();
            var user_id = $("input[name=user_id_surat]").val();
            var _token = $("input[name=_token]").val();

            $.ajax({
                url : "{{route('add.komen')}}",
                type : "POST",
                data : {
                    id_kegiatan : idKegiatan,
                    link : linkSurat,
                    keterangan : komen,
                    user_id : user_id,
                    _token : _token
                },
                success:function(response){
                    swal("Done!","Deskripsi Perbaikan Dikirim","success");
                    document.getElementById('sk_panitia').value = '';
                }
            });
        })

        $('#lain1Form').submit(function(e){
            e.preventDefault();
            var idKegiatan = $("input[name=id_kegiatan]").val();
            var linkSurat = $("input[name=linkLain1]").val();
            var komen = $("input[name=lain1]").val();
            var user_id = $("input[name=user_id_surat]").val();
            var _token = $("input[name=_token]").val();

            $.ajax({
                url : "{{route('add.komen')}}",
                type : "POST",
                data : {
                    id_kegiatan : idKegiatan,
                    link : linkSurat,
                    keterangan : komen,
                    user_id : user_id,
                    _token : _token
                },
                success:function(response){
                    swal("Done!","Deskripsi Perbaikan Dikirim","success");
                    document.getElementById('persyaratan_lain').value = '';
                }
            });
        })

        $('#lain2Form').submit(function(e){
            e.preventDefault();
            var idKegiatan = $("input[name=id_kegiatan]").val();
            var linkSurat = $("input[name=linkLain2]").val();
            var komen = $("input[name=lain2]").val();
            var user_id = $("input[name=user_id_surat]").val();
            var _token = $("input[name=_token]").val();

            $.ajax({
                url : "{{route('add.komen')}}",
                type : "POST",
                data : {
                    id_kegiatan : idKegiatan,
                    link : linkSurat,
                    keterangan : komen,
                    user_id : user_id,
                    _token : _token
                },
                success:function(response){
                    swal("Done!","Deskripsi Perbaikan Dikirim","success");
                    document.getElementById('lainnya').value = '';
                }
            });
        })

    </script>
@endpush
