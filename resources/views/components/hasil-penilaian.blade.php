<div class="row">
    <div class="col-lg-12 col-xxl-12">
        <!--begin::List Widget 9-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header align-items-center border-0 mt-4">
                <h3 class="card-title align-items-start flex-column">
                    <span class="font-weight-bolder text-dark">Penilaian Kegiatan</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-4">
                <!--begin::Timeline-->
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="h5">Penilaian Sesuai Pelaporan</h5>
                        <div class="form-group row">
                            <label  class="col-2 col-form-label">Nilai SKPK</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$data->nilaiPelaporan->nilai_skpk}}" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-2 col-form-label">Jenis Kegiatan</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$data->nilaiPelaporan->is_jenis}}" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-2 col-form-label">Sifat Kegiatan</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$data->nilaiPelaporan->is_sifat}}" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-2 col-form-label">Metode Kegiatan</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$data->nilaiPelaporan->is_metode}}" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-2 col-form-label">Tingkat Kegiatan</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$data->nilaiPelaporan->is_tingkat}}" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-2 col-form-label">Angka Kredit</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$data->nilaiPelaporan->angka_kredit}}" readonly/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="h5">Penilaian Sesuai Validasi</h5>
                        <div class="form-group row">
                            <label  class="col-2 col-form-label">Nilai SKPK</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$data->nilaiValidasi->nilai_skpk}}" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-2 col-form-label">Jenis Kegiatan</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$data->nilaiValidasi->is_jenis}}" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-2 col-form-label">Sifat Kegiatan</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$data->nilaiValidasi->is_sifat}}" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-2 col-form-label">Metode Kegiatan</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$data->nilaiValidasi->is_metode}}" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-2 col-form-label">Tingkat Kegiatan</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$data->nilaiValidasi->is_tingkat}}" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-2 col-form-label">Angka Kredit</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$data->nilaiValidasi->angka_kredit}}" readonly/>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Timeline-->
            </div>
            <!--end: Card Body-->
        </div>
        <!--end: List Widget 9-->
    </div>
</div>
