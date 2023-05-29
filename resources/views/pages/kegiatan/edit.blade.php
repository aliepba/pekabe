@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="h4">Form Kegiatan</h4>
        </div>
        <div class="card-body">
            <form action="{{route('kegiatan-penyelenggara.update', $data->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="h5">Kolaborasi Penyelenggara</h5>
                        <div class="form-group">
                            <label>Penyelenggara Lain</label>
                            <select class="form-control selectpicker" name="penyelenggara_lain[]" multiple>
                                @foreach ($penyelenggara as $item)
                                <option value="{{$item->id}}"
                                    @foreach ($data->penyelenggaraLain as $i)
                                    @if ($i->id_penyelenggara == $item->id)
                                    selected
                                    @endif
                                    @endforeach
                                >{{$item->nama_instansi}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="h5">Sasaran Utama Tenaga Ahli</h5>
                        <div class="form-group">
                            <label>Sub Klasifikasi <span class="text-danger">*</span></label>
                            <select class="form-control select2" id="kt_select2_3" name="subklas[]" multiple="multiple">
                                @foreach ($subklas as $item)
                                    <option value="{{$item->subklasifikasi}}" @if (in_array($item->subklasifikasi, $subklasifikasi))
                                        selected
                                    @endif>{{$item->subklasifikasi}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if (Auth::user()->jenis_penyelenggara == 1)
                        <div class="form-group">
                            <label>Verifikator/validator dan penilai <span class="text-danger">*</span></label>
                            <select class="form-control" name="penilai">
                                <option value="{{$data->penilai}}" selected>{{$data->validator->Nama_Lengkap}} ({{$data->validator->Nama}})</option>
                                @foreach ($profesi as $item)
                                    <option value="{{$item->ID_Asosiasi_Profesi}}">{{$item->Nama_Lengkap}} ({{$item->Nama}})</option>
                                    <option value="000">Lembaga Pengembangan Jasa Konstruksi (LPJK)</option>
                                @endforeach
                            </select>
                        </div>
                        @else
                        <div class="form-group">
                            <label>Verifikator/validator dan penilai <span class="text-danger">*</span></label>
                            <select class="form-control" name="penilai">
                                <option value="{{$data->penilai}}" selected>{{$data->validator->Nama_Lengkap}} ({{$data->validator->Nama}})</option>
                                @foreach ($profesi as $item)
                                    <option value="{{$item->ID_Asosiasi_Profesi}}">{{$item->Nama_Lengkap}} ({{$item->Nama}})</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="h5">Klasifikasi Kegiatan</h5>
                        <div class="form-group">
                            <label>Jenis Kegiatan <span class="text-danger">*</span></label>
                            <select class="form-control selectpicker" name="jenis_kegiatan[]" id="jenis_kegiatan" multiple>
                                @foreach ($jenis as $item)
                                <option value="{{$item->id}}">
                                    {{$item->unsur_kegiatan}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Unsur Kegiatan <span class="text-danger">*</span></label>
                            <select class="form-control selectpicker" name="unsur_kegiatan[]" id="unsur_kegiatan" multiple>
                                @foreach ($unsur as $item)
                                    <option value="{{$item->id}}"  @foreach($data->unsurKegiatan as $unsurKegiatan)
                                        @if ($unsurKegiatan->id_unsur == $item->id)
                                        selected
                                        @endif
                                        @endforeach>{{$item->nama_sub_unsur}}</option>
                                @endforeach
                                foreac
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="h5">Klasifikasi Kegiatan</h5>
                        <div class="form-group">
                            <label>Tingkat <span class="text-danger">*</span></label>
                            <select class="form-control" name="tingkat_kegiatan">
                                <option value="{{$data->tingkat_kegiatan}}">
                                    @if ($data->tingkat_kegiatan == 1)
                                        Nasional
                                    @elseif ($data->tingkat_kegiatan == 2)
                                    Internasional Dalam Negeri
                                    @else
                                    Internasional Luar Negeri
                                    @endif
                                </option>
                                <option value="1">Nasional</option>
                                <option value="2">Internasional Dalam Negeri</option>
                                <option value="3">Internasional Luar Negeri</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Metode <span class="text-danger">*</span></label>
                            <div class="checkbox-inline">
                                <label class="checkbox">
                                    <input type="checkbox" name="metode_kegiatan[]" value="Tatap Muka" @if (in_array('Tatap Muka',$metode))
                                    checked
                                @endif/>
                                    <span></span>
                                    Tatap Muka
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" name="metode_kegiatan[]" value="Daring" @if (in_array('Daring',$metode))
                                    checked
                                @endif/>
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
                            <input type="text" name="nama_kegiatan" class="form-control" value="{{$data->nama_kegiatan}}"/>
                        </div>
                        <div class="form-group">
                            <label>Tempat <span class="text-danger">*</span></label>
                            <input type="text" name="tempat_kegiatan" class="form-control" value="{{$data->tempat_kegiatan}}" />
                        </div>
                        <div class="form-group">
                            <label>Contact Person Kegiatan</label>
                            <input type="text" name="cp" class="form-control" value="{{$data->contact_person}}"/>
                            <span class="text-muted">** Jika Ada</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="h5">Data Kegiatan</h5>
                        <div class="form-group">
                            <label>Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="date" name="start_kegiatan" class="form-control" value="{{$data->start_kegiatan}}" />
                        </div>
                        <div class="form-group">
                            <label>Tanggal Selesai <span class="text-danger">*</span></label>
                            <input type="date" name="end_kegiatan" class="form-control" value="{{$data->end_kegiatan}}"/>
                        </div>
                        <div class="form-group">
                            <label>Link Pendaftaran</label>
                            <input type="text" name="link_kegiatan" class="form-control" value="{{$data->link_kegiatan}}"/>
                            <span class="text-muted">** Jika Ada</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="h5">Berkas Persyaratan</h5>
                        <div class="form-group">
                            <label>TOR/KAK <span class="text-danger">*</span></label>
                            <input type="file" name="tor_kak" class="form-control"/>
                            <span class="text-muted">Accepted formats: pdf Max file size 1Mb</span>
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

    $('#jenis_kegiatan').change(function(){
      var id = $(this).val();
      console.log(id)
      if(id){
        $.ajax({
          type : "GET",
          url : "/get-unsur-kegiatan?id="+id,
          dataType : 'JSON',
          success:function(res){
            console.log(res)
            if(res){
              $('#unsur_kegiatan').empty();
              $("#unsur_kegiatan").append('<option>---Pilih Unsur Kegiatan---</option>');
              $.each(res,function(nama_sub_unsur,id){
                    $("#unsur_kegiatan").append('<option value="'+id+'">'+nama_sub_unsur+'</option>');
              });
            }else{
              $('#unsur_kegiatan').empty();
            }
          }
        })
      }else{
        $('#unsur_kegiatan').empty();
      }
    })

    $('.multiplee').change(function(){
        var subklas = $(this).val();
        if(subklas){
            $.ajax({
                type : "GET",
                url : "/get-validator?subklas="+subklas,
                dataType : 'JSON',
                success:function(res){
                    console.log(res)
                    if(res){
                    res.forEach(item => {
                        let option = document.createElement("option");
                        option.text = item.Nama_Lengkap;
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

    </script>
@endpush
