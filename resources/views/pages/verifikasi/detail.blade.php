@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="display-5 mt-2">Detail Permohonan</h4>
        </div>
        <div class="card-body">
            <!--begin::Details-->
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
                            <a href="#" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">{{$data->nama_instansi}}</a>
                            <a href="#">
                                <i class="flaticon2-correct text-success font-size-h5"></i>
                            </a>
                        </div>
                        <div class="my-lg-0 my-3">
                            <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Hasil Periksa
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('permohonan.approve', $data->uuid)}}">Approve</a>
                                    <a href="javascript:void(0)" onclick="kirimPerbaikan({{$data->id}})" class="dropdown-item" href="#">Perbaikan</a>
                                    <a href="javascript:void(0)" onclick="kirimTolak({{$data->id}})" class="dropdown-item" href="#">Tolak</a>
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
                                <i class="flaticon2-new-email mr-2 font-size-lg"></i>{{$data->email_instansi}}</a>
                                <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                <i class="flaticon2-new-email mr-2 font-size-lg"></i>{{$data->Jenispenyelenggara->jenis_penyelenggara}}</a>
                                <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i>{{$data->telepon}}</a>
                                <a href="#" class="text-dark-50 text-hover-primary font-weight-bold">
                                <i class="flaticon2-placeholder mr-2 font-size-lg"></i>{{$data->provinsi->Nama. ' , '. $data->kabKota->nama_kabupaten_dagri. ' , ' .$data->alamat}}</a>
                            </div>
                            <div class="row">
                            <a href="{{asset('storage/'. $data->file1)}}" class="btn btn-sm btn-primary rounded-lg col-md-3" target="_blank"><i class="flaticon-file"></i>{{$file1 != null ? $file1 : 'upload persyaratan'}}</a>
                            <a href="{{asset('storage/'. $data->file2)}}" class="btn btn-sm btn-primary rounded-lg col-md-3 ml-2" target="_blank"><i class="flaticon-file"></i>{{$file2 != null ? $file2 : 'upload persyaratan'}}</a>
                            <a href="{{asset('storage/'. $data->file3)}}" class="btn btn-sm btn-primary rounded-lg col-md-3 ml-2" target="_blank"><i class="flaticon-file"></i>{{$file2 != null ? $file2 : 'upload persyaratan'}}</a>
                            </div>
                        </div>
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Details-->
            <div class="separator separator-solid"></div>
            <!--begin::Items-->
            <h4 class="display-5 mt-5 mb-5">Penanggung Jawab</h4>
            <div class="separator separator-solid"></div>
            <div class="d-flex align-items-center flex-wrap mt-8">
                <!--begin::Item-->
                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                    <span class="mr-4">
                        <i class="flaticon-piggy-bank display-4 text-muted font-weight-bold"></i>
                    </span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-sm">Nama Penanggung Jawab</span>
                        <span class="text-primary font-weight-bolder">{{$data->penanggungjawab->nama_penanggung_jawab}}</span>
                    </div>
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                    <span class="mr-4">
                        <i class="flaticon-confetti display-4 text-muted font-weight-bold"></i>
                    </span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-sm">NIK</span>
                        <span class="text-primary font-weight-bolder">{{$data->penanggungjawab->nik}}</span>
                    </div>
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                    <span class="mr-4">
                        <i class="flaticon-pie-chart display-4 text-muted font-weight-bold"></i>
                    </span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-sm">Jabatan</span>
                        <span class="text-primary font-weight-bolder">{{$data->penanggungjawab->jabatan}}</span>
                    </div>
                </div>
                <!--end::Item-->
                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                    <span class="mr-4">
                        <i class="flaticon-pie-chart display-4 text-muted font-weight-bold"></i>
                    </span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-sm">Email</span>
                        <span class="text-primary font-weight-bolder">{{$data->penanggungjawab->email}}</span>
                    </div>
                </div>
                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                    <span class="mr-4">
                        <i class="flaticon-pie-chart display-4 text-muted font-weight-bold"></i>
                    </span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-sm">NPWP</span>
                        <span class="text-primary font-weight-bolder">{{$data->penanggungjawab->npwp}}</span>
                    </div>
                </div>
            </div>
            <h6 class="h6 mt-5 ml-2">SK Pengangkatan</h6>
            <a href="{{asset('storage/'. $data->penanggungjawab->upload_persyaratan)}}" class="btn btn-sm btn-primary rounded-lg col-md-2 ml-2" target="_blank"><i class="flaticon-file"></i>Persyaratan</a>
            <!--begin::Items-->
        </div>
      </div>
</div>
@endsection

@push('addon-script')
<div class="modal fade" id="tolak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kirim Email Penolakan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form id="tolakForm">
                <div class="form-group">
                    <label>Email PenanggungJawab</label>
                    <input type="text" class="form-control" name="emailPemohon" id="emailPemohon" readonly/>
                    <input type="text" class="form-control" name="idPermohonan" id="idPermohonan" hidden/>
                    <input type="text" class="form-control" name="uuid" id="uuidTolak" hidden/>
                </div>
                <div class="form-group">
                    <label>Keterangan Penolakan</label>
                    <textarea class="form-control" name="keterangan" id="keteranganTolak" rows="5"></textarea>
                </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Kirim Perbaikan</button>
        </div>
        </form>

    </div>
    </div>
</div>

<div class="modal fade" id="perbaikan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kirim Email Perbaikan Berkas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form id="perbaikanForm">
                <div class="form-group">
                    <label>Email PenanggungJawab</label>
                    <input type="text" class="form-control" name="emailPemohon" id="emailPerbaikan" readonly/>
                    <input type="text" class="form-control" name="idPermohonan" id="idPerbaikan" hidden/>
                    <input type="text" class="form-control" name="uuid" id="uuidPerbaikan" hidden/>
                </div>
                <div class="form-group">
                    <label>Keterangan Perbaikan</label>
                    <textarea class="form-control" name="keterangan" id="keteranganPerbaikan" rows="5"></textarea>
                </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Kirim Perbaikan</button>
        </div>
        </form>

    </div>
    </div>
</div>

<script>

     function kirimPerbaikan(id){
        $.get('/detail-instansi/'+id, function(data){
                console.log(data.penanggungjawab);
                $("#idPerbaikan").val(data.id);
                $("#emailPerbaikan").val(data.penanggungjawab.email);
                $("#uuidPerbaikan").val(data.uuid);
                $("#perbaikan").modal("toggle");
            });
     }

     $('#perbaikanForm').submit(function(e){
        e.preventDefault();
        var idPermohonan = $("#idPerbaikan").val();
        var emailPemohon = $("#emailPerbaikan").val();
        var keterangan = $("#keteranganPerbaikan").val();
        var uuid = $("#uuidPerbaikan").val();

        $.ajax({
                url : "{{route('permohonan.perbaikan', $data->uuid)}}",
                type : "POST",
                data : {
                    id : idPermohonan,
                    uuid : uuid,
                    emailPemohon : emailPemohon,
                    keterangan : keterangan,
                    _token : "{{csrf_token()}}"
                },
                success:function(){
                     // $('#sid'+response.id + 'td.nth-child(1)').text(response.nama_skema);
                     $("#perbaikan").modal('toggle');
                     $("#perbaikanForm")[0].reset();
                     alert('Permohonan Perbaikan Berhasil di kirim');
                 }
        })

     });



     function kirimTolak(id){
            $.get('/detail-instansi/'+id, function(data){
                console.log(data.penanggungjawab);
                $("#idPermohonan").val(data.id);
                $("#emailPemohon").val(data.penanggungjawab.email);
                $("#uuidTolak").val(data.uuid);
                $("#tolak").modal("toggle");
            });
        }

        $('#tolakForm').submit(function(e){
            e.preventDefault();
            var idPermohonan = $("#idPermohonan").val();
            var emailPemohon = $("#emailPemohon").val();
            var keterangan = $("#keteranganTolak").val();
            var uuid = $("#uuidTolak").val();

            $.ajax({
                url : "{{route('permohonan.tolak', $data->uuid)}}",
                type : "POST",
                data : {
                    id : idPermohonan,
                    uuid : uuid,
                    emailPemohon : emailPemohon,
                    keterangan : keterangan,
                    _token : "{{csrf_token()}}"
                },
                success:function(){
                     // $('#sid'+response.id + 'td.nth-child(1)').text(response.nama_skema);
                     $("#tolak").modal('toggle');
                     $("#tolakForm")[0].reset();
                     alert('Permohonan Tolak Berhasil di kirim');
                 }
                })
            })
</script>
@endpush
