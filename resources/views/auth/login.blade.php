@extends('layouts.auth')

@section('aside')
<div class="login-aside d-flex flex-column flex-row-auto" style="margin-top: -150px;">
    <!--begin::Aside Top-->
    <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
        <!--begin::Aside header-->
        <a href="#" class="login-logo text-center pt-lg-25 pb-10">
            <img src="{{asset('images/pupr.png')}}" class="max-h-70px" alt="" />
        </a>
        <!--end::Aside header-->
        <!--begin::Aside Title-->
        <h3 class="font-weight-bolder text-center font-size-h4 text-dark-50 line-height-xl">Login PKB</h3>
        <p class="text-weight-bolder font-size-h3 ml-5 mr-5">
            Bagi Penyelenggara Kegiatan PKB yang telah
            memiliki akun lama silakan melakukan reset password dengan cara
            klik menu Lupa Password!
        </p>
        <p class="text-weight-bolder font-size-h3 ml-5 mr-5">
            Terima Kasih.
        </p>
        <!--end::Aside Title-->
    </div>
    <!--end::Aside Top-->
    <!--begin::Aside Bottom-->
    <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-x-center" style="background-position-y: calc(100% + 5rem); background-image: url({{asset('images/konstruksi.jpg')}})"></div>
    <!--end::Aside Bottom-->
</div>
@endsection

@section('content')
<div class="login-content flex-row-fluid d-flex flex-column p-10" style="margin-top: -150px;">
    <!--begin::Wrapper-->
    <div class="d-flex flex-row-fluid flex-center">
        <!--begin::Signin-->
        <div class="login-form">
            <!--begin::Form-->
            <form class="form" action="{{route('login')}}" method="POST">
                @csrf
                <!--begin::Form group-->
                <div class="form-group">
                    <label class="font-size-h6 font-weight-bolder text-dark">Email</label>
                    <input class="form-control h-auto py-7 px-6 rounded-lg border-0" type="email" name="email" autocomplete="off" />
                </div>
                <!--end::Form group-->
                <!--begin::Form group-->
                <div class="form-group">
                    <div class="d-flex justify-content-between mt-n5">
                        <label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
                        <a href="{{route('password.request')}}" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5">Lupa Password ?</a>
                    </div>
                    <input class="form-control h-auto py-7 px-6 rounded-lg border-0" type="password" name="password" autocomplete="off" />
                </div>
                <div class="form-group">
                    {!! NoCaptcha::display() !!}
                    {!! NoCaptcha::renderJs() !!}
                    @error('g-recaptcha-response')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
            </div>
                <!--end::Form group-->
                <!--begin::Action-->
                <div class="pb-lg-0 pb-5">
                    <button type="submit" id="kt_login_singin_form_submit_button" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Sign In</button>
                </div>
                <!--end::Action-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Signin-->
    </div>
    <!--end::Wrapper-->
</div>
@endsection
