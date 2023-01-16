@extends('layouts.auth')

@section('aside')
<div class="login-aside d-flex flex-column flex-row-auto">
    <!--begin::Aside Top-->
    <div class="d-flex flex-column-auto flex-column pt-15 px-30">
        <!--begin::Aside header-->
        <a href="#" class="login-logo py-6">
            {{-- <img src="assets/media/logos/logo-1.png" class="max-h-70px" alt="" /> --}}
            LPJK
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
                            <span class="wizard-number">1</span>
                        </div>
                        <div class="wizard-label">
                            <h3 class="wizard-title">Penyelenggara</h3>
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
        <div class="login-form login-form-signup" style="margin-top: -100px;">
            <!--begin::Form-->
            <form class="form" method="GET" action="{{route('form.akun')}}">
                <div class="pb-5">
                    <!--begin::Form Group-->
                    <div class="form-group">
                        <label class="font-size-h6 font-weight-bolder text-dark">Jenis Penyelenggara</label>
                        <select name="jenis_penyelenggara" id="jenis_penyelenggara" class="form-control selectpicker">
                            <option>Pilih Penyelenggara</option>
                            @foreach ($jenis as $item)
                                <option value="{{$item->id}}">{{$item->jenis_penyelenggara}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-md btn-primary">Next</button>
                    </div>
                    <!--end::Form Group-->
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Signin-->
    </div>
    <!--end::Wrapper-->
</div>
@endsection
