@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="h4">Form Kegiatan</h4>
        </div>
        <div class="card-body">
            <form action="{{route('kegiatan-penyelenggara.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="h5">Kolaborasi Penyelenggara</h5>
                        <div class="form-group">
                            <label>Penyelenggara Lain</label>
                            <select class="form-control selectpicker" name="penyelenggara_lain[]" multiple>
                                    <option value="">pilih penyelenggara lain</option>
                                @foreach ($penyelenggara as $item)
                                    <option value="{{$item->id}}">{{$item->nama_instansi}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="h5">Sasaran Utama Tenaga Ahli</h5>
                        <div class="form-group">
                            <label>Sub Klasifikasi <span class="text-danger">*</span></label>
                            <select class="form-control select2 multiplee selectpicker" name="subklas[]" multiple="multiple">
                                @foreach ($subklas as $item)
                                    <option value="{{$item->subklasifikasi}}">{{$item->subklasifikasi}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if (Auth::user()->jenis_penyelenggara == 1)
                        <div class="form-group">
                            <label>Verifikator/validator dan penilai <span class="text-danger">*</span></label>
                            <select class="form-control" name="penilai" id="validator1">
                                <option>-- pilih validator -- </option>
                                <option value="000">Lembaga Pengembangan Jasa Konstruksi (LPJK)</option>
                            </select>
                        </div>
                        @else
                        <div class="form-group">
                            <label>Verifikator/validator dan penilai <span class="text-danger">*</span></label>
                            <select class="form-control" name="penilai" id="validator">
                                <option>-- pilih validator -- </option>
                                <option value="000">Lembaga Pengembangan Jasa Konstruksi (LPJK)</option>
                            </select>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="h5">Klasifikasi Kegiatan</h5>
                        <div class="form-group">
                            <label>unsur Kegiatan <span class="text-danger">*</span></label>
                            <select class="form-control selectpicker" name="jenis_kegiatan[]" id="jenis_kegiatan"  multiple>
                                <option value="">Pilih Jenis Kegiatan</option>
                                @foreach ($jenis as $item)
                                <option value="{{$item->id}}">{{$item->unsur_kegiatan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Unsur Kegiatan <span class="text-danger">*</span></label>
                            <select class="form-control" name="unsur_kegiatan[]" id="unsur_kegiatan" multiple>
                                @foreach ($unsur as $item)
                                    <option value="{{$item->id}}">{{$item->nama_sub_unsur}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="h5">Klasifikasi Kegiatan</h5>
                        <div class="form-group">
                            <label>Tingkat <span class="text-danger">*</span></label>
                            <select class="form-control" name="tingkat_kegiatan" required>
                                <option value="hehe">pilih tingkat</option>
                                <option value="1">Nasional</option>
                                <option value="2">Internasional Dalam Negeri</option>
                                <option value="3">Internasional Luar Negeri</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Metode <span class="text-danger">*</span></label>
                            <div class="checkbox-inline">
                                <label class="checkbox">
                                    <input type="checkbox" name="metode_kegiatan[]" value="Tatap Muka"/>
                                    <span></span>
                                    Tatap Muka
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" name="metode_kegiatan[]" value="Daring"/>
                                    <span></span>
                                    Daring
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="h5">Data Kegiatan</h5>
                        <div class="form-group">
                            <label>Nama <span class="text-danger">*</span></label>
                            <input type="text" name="nama_kegiatan" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Tempat <span class="text-danger">*</span></label>
                            <input type="text" name="tempat_kegiatan" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Contact Person Kegiatan</label>
                            <input type="text" name="cp" class="form-control" />
                            <span class="text-muted">** Jika Ada</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="h5">Data Kegiatan</h5>
                        <div class="form-group">
                            <label>Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="date" name="start_kegiatan" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Tanggal Selesai <span class="text-danger">*</span></label>
                            <input type="date" name="end_kegiatan" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Link Pendaftaran</label>
                            <input type="text" name="link_kegiatan" class="form-control" />
                            <span class="text-muted">** Jika Ada</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="h5">Berkas Persyaratan</h5>
                        <div class="form-group">
                            <label>TOR/KAK <span class="text-danger">*</span></label>
                            <input type="file" name="tor_kak" class="form-control" required/>
                            <span class="text-muted">Accepted formats: pdf Max file size 1Mb</span>
                            <br/>
                            <a href="{{asset('format/format_kak_kegiatan.docx')}}" class="btn btn-sm btn-primary" target="_blank">Unduh Format TOR/KAK</a>
                        </div>
                        <div class="form-group">
                            <label>SK Panitia</label>
                            <input type="file" name="sk_panitia" class="form-control" />
                            <span class="text-muted">Accepted formats: pdf Max file size 1Mb</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="h5">Berkas Persyaratan</h5>
                        <div class="form-group">
                            <label>CV</label>
                            <input type="file" name="cv" class="form-control" />
                            <span class="text-muted">Accepted formats: pdf Max file size 1Mb</span>
                        </div>
                        <div class="form-group">
                            <label>Persyaratan Lain</label>
                            <input type="file" name="persyaratan_lain" class="form-control" />
                            <span class="text-muted">Accepted formats: pdf Max file size 1Mb</span>
                        </div>
                        <div class="form-group">
                            <label>Lainnya</label>
                            <input type="file" name="persyaratan_lain_lain" class="form-control" />
                            <span class="text-muted">Accepted formats: pdf Max file size 1Mb</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script src="{{asset('assets/js/pages/crud/forms/widgets/select2.js')}}"></script>
    <script>
    // Class definition
    var KTSelect2 = function() {
    // Private functions
    var demos = function() {

    // multi select
    $('#kt_select2_3').select2({
    placeholder: "pilih subklasifikasi",
    });
    }

    // Public functions
    return {
    init: function() {
    demos();
        }
    };
    }();

    // Initialization
    jQuery(document).ready(function() {
    KTSelect2.init();
    });

    var KTSelect2 = function() {
    // Private functions
    var demos = function() {

    // multi select
    $('#unsur_kegiatan').select2({
    placeholder: "pilih unsur kegiatan",
    });
    }

    // Public functions
    return {
    init: function() {
    demos();
        }
    };
    }();

    // Initialization
    jQuery(document).ready(function() {
    KTSelect2.init();
    });

    // $('#jenis_kegiatan').change(function(){
    //   var id = $(this).val();
    //   console.log(id)
    //   if(id){
    //     $.ajax({
    //       type : "GET",
    //       url : "/get-unsur-kegiatan?id="+id,
    //       dataType : 'JSON',
    //       success:function(res){
    //         console.log(res)
    //         if(res){
    //           $('#unsur_kegiatan').empty();
    //           $("#unsur_kegiatan").append('<option>---Pilih Unsur Kegiatan---</option>');
    //           $.each(res,function(nama_sub_unsur,id){
    //                 $("#unsur_kegiatan").append('<option value="'+id+'">'+nama_sub_unsur+'</option>');
    //           });
    //         }else{
    //           $('#unsur_kegiatan').empty();
    //         }
    //       }
    //     })
    //   }else{
    //     $('#unsur_kegiatan').empty();
    //   }
    // })

    $('.multiplee').change(function(){
        var subklas = $(this).val();
        if(subklas){
            $.ajax({
                type : "GET",
                url : "/get-validator?subklas="+subklas,
                dataType : 'JSON',
                success:function(res){
                    if(res){
                    res.forEach(item => {
                        let option = document.createElement("option");
                        option.text = item.Nama_Lengkap + ' (' + item.Nama + ')' ;
                        option.value = item.ID_Asosiasi_Profesi;
                        document.getElementById("validator").appendChild(option);
                    });
                    }else{
                    $('#validator').empty();
                    }
                }
            })
        }
    })

    // unsur_kegiatan

    </script>
@endpush
