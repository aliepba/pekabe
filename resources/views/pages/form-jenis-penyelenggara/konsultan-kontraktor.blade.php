@extends('layouts.auth')


@section('aside')
<div class="login-aside d-flex flex-column flex-row-auto">
    <!--begin::Aside Top-->
    <div class="d-flex flex-column-auto flex-column pt-15 px-30">
        <!--begin::Aside header-->
        <a href="#" class="login-logo py-6">
            lpjk
        </a>
        <!--end::Aside header-->
        <!--begin: Wizard Nav-->
        <div class="wizard-nav pt-5 pt-lg-30">
            <!--begin::Wizard Steps-->
            <div class="wizard-steps">
                <!--begin::Wizard Step 1 Nav-->
                <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                    <div class="wizard-wrapper">
                        <div class="wizard-icon">
                            <i class="wizard-check ki ki-check"></i>
                            <span class="wizard-number">2</span>
                        </div>
                        <div class="wizard-label">
                            <h3 class="wizard-title">Detail Permohonan</h3>
                        </div>
                    </div>
                </div>
                <!--end::Wizard Step 1 Nav-->
            </div>
            <!--end::Wizard Steps-->
        </div>
        <!--end: Wizard Nav-->
    </div>
    <!--end::Aside Top-->
    <!--begin::Aside Bottom-->
    <div class="aside-img-wizard d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center pt-2 pt-lg-5" style="background-position-y: calc(100% + 3rem); background-image: url(assets/media/svg/illustrations/features.svg)"></div>
    <!--end::Aside Bottom-->
</div>
@endsection

@section('content')
<div class="login-content flex-column-fluid d-flex flex-column p-10">
    <!--begin::Wrapper-->
    <div class="d-flex flex-row-fluid flex-center">
        <!--begin::Signin-->
        <div class="login-form login-form-signup">
            <!--begin::Form-->
            <a href="{{route('permohonan.akun')}}" class="btn btn-sm btn-primary mb-2"><i class="flaticon2-left-arrow-1"></i> Kembali</a>
            <form action="{{route('form.akun.save')}}" class="form" novalidate="novalidate" id="kt_login_signup_form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="font-weight">Instansi / Organisasi</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-sm font-weight-bolder text-dark">Nama Instansi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Nama Instansi" name="nama_instansi" required/>
                                    <input type="hidden" class="form-control" placeholder="Email Instansi" id="nama_instansi" name="jenis" value="6"/>
                                </div>
                                <div class="form-group">
                                    <label class="text-sm font-weight-bolder text-dark">Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Email Instansi" name="email_instansi" required/>
                                </div>
                                <div class="form-group">
                                    <label class="text-sm font-weight-bolder text-dark">Akta Pendirian Perusahaan <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="file1" required/>
                                    <span class="text-muted">Accepted formats: pdf Max file size 1Mb</span>
                                </div>
                                <div class="form-group">
                                    <label class="text-sm font-weight-bolder text-dark">SBU dan/atau IUJK yang masih berlaku <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="file2" required/>
                                    <span class="text-muted">Accepted formats: pdf Max file size 1Mb</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-sm font-weight-bolder text-dark">No Telepon <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" placeholder="No Telepon" name="telepon" required/>
                                </div>
                                <div class="form-group">
                                    <label class="text-sm font-weight-bolder text-dark">Propinsi <span class="text-danger">*</span></label>
                                    <select class="form-control selectpicker" name="provinsi" id="provinsi">
                                    <option value="">Pilih Provinsi</option>
                                    @foreach ($propinsi as $prov)
                                      <option value="{{$prov->id_propinsi_dagri}}">{{$prov->Nama}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="text-sm font-weight-bolder text-dark">Kabupaten / Kota <span class="text-danger">*</span></label>
                                    <select class="form-control" name="kab_kota" id="kab-kota">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="text-sm font-weight-bolder text-dark">Alamat <span class="text-danger">*</span></label>
                                    <textarea class="form-control" placeholder="Alamat" name="alamat" required></textarea>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <h5 class="font-weight">Penanggung Jawab</h5>
                        @include('pages.form-jenis-penyelenggara.penanggung-jawab')
                        @include('components.term-condition')
                        <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Signin-->
    </div>
    <!--end::Wrapper-->
</div>
@endsection

@push('addon-script')
<script>
    $('#provinsi').change(function(){
      var kode = $(this).val();
      if(kode){
        $.ajax({
          type : "GET",
          url : "/kab-kota?id_propinsi_dagri="+kode,
          dataType : 'JSON',
          success:function(res){
            console.log(res[0])
            if(res){
              $('#kab-kota').empty();
              $("#kab-kota").append('<option>---Pilih Kabupaten / Kota---</option>');
              $.each(res,function(nama_kabupaten_dagri,id_kabupaten_dagri){
                    $("#kab-kota").append('<option value="'+id_kabupaten_dagri+'">'+nama_kabupaten_dagri+'</option>');
              });
            }else{
              $('#kab-kota').empty();
            }
          }
        })
      }else{
        $('#kab-kota').empty();
      }
    })
</script>
@endpush
