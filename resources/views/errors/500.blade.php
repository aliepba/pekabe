@extends('layouts.apps')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom">
                <!--begin::Body-->
                <div class="card-body p-0">
                    <div class="d-flex flex-column flex-root">
                        <!--begin::Error-->
                        <div class="error error-5 d-flex flex-row-fluid bgi-size-cover bgi-position-center" style="background-image: url(assets/media/error/bg5.jpg);">
                            <!--begin::Content-->
                            <div class="container d-flex flex-row-fluid flex-column justify-content-md-center p-12">
                                <h1 class="error-title font-weight-boldest text-info mt-10 mt-md-0 mb-12">Oops!</h1>
                                <p class="font-weight-boldest display-4">Something went wrong here.</p>
                                <p class="font-size-h3">We're working on it and we'll get it fixedas soon possible.You can back or use our Help Center.</p>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Error-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection