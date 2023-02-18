<div class="row">
    <div class="col-lg-6 col-xxl-6">
        <!--begin::List Widget 9-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header align-items-center border-0 mt-4">
                <h3 class="card-title align-items-start flex-column">
                    <span class="font-weight-bolder text-dark">Timeline Kegiatan</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-4">
                <!--begin::Timeline-->
                @foreach ($data->timeline as $item)
                <div class="timeline timeline-6 mt-3">
                    <!--begin::Item-->
                    <div class="timeline-item align-items-start">
                        <!--begin::Label-->
                        <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">{{$item->status_permohonan}}</div>
                        <!--end::Label-->
                        <!--begin::Badge-->
                        <div class="timeline-badge ml-5">
                            <i class="fa fa-genderless text-warning icon-xl"></i>
                        </div>
                        <!--end::Badge-->
                        <!--begin::Text-->
                        <div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3">{{$item->created_at}}, {{$item->keterangan    }}</div>
                        <!--end::Text-->
                    </div>
                    <!--end::Item-->
                </div>
                @endforeach
                <!--end::Timeline-->
            </div>
            <!--end: Card Body-->
        </div>
        <!--end: List Widget 9-->
    </div>
    <div class="col-lg-6 col-xxl-6">
        <!--begin::List Widget 9-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header align-items-center border-0 mt-4">
                <h3 class="card-title align-items-start flex-column">
                    <span class="font-weight-bolder text-dark">Detail Kegiatan</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-4">
                <!--begin::detail kegiatan-->
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
                        <span class="text-muted">Unsur Kegiatan</span>
                        <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">
                            @foreach ($data->unsurKegiatan as $unsurKegiatan)
                                {{$unsurKegiatan->unsur->nama_sub_unsur}}, <br />
                            @endforeach
                        </a>
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
                        <span class="text-muted">Tingkat Kegiatan</span>
                        <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">
                            {{$result = ($data->tingkat_kegiatan == 1) ? 'Nasional' : (($data->tingkat_kegiatan == 2) ? 'Internasional Dalam Negeri' : 'Internasional Luar Negeri')}}
                        </a>
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
                @if ((Auth::user()->role == 'admin' || Auth::user()->role == 'root' ) && ($data->status_permohonan_kegiatan == 'APPROVE' || $data->status_permohonan_kegiatan == 'TOLAK'))
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
                        <span class="text-muted">Keterangan Pengajuan Kegiatan {{$data->status_permohonan_kegiatan}}</span>
                        <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">
                            {{$data->keterangan}}
                        </a>
                    </div>
                    <!--end::Text-->
                </div>
                @endif
                <!--end::detail kegiatan-->
            </div>
            <!--end: Card Body-->
        </div>
        <!--end: List Widget 9-->
    </div>
</div>
