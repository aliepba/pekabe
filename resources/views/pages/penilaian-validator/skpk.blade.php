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
                <form action="{{route('penilaian-validator.store')}}" method="POST">
                @csrf
                @foreach ($data->nilaiPelaporan as $item)
                <div class="row">
                    {{-- <div class="col-md-6">
                        <h6 class="h6 border-bottom">Penilaian Sesuai Pelaporan - {{$item->unsur->nama_sub_unsur}}</h6>
                        <div class="form-group row mt-5">
                            <label  class="col-2 col-form-label">Nilai SKPK</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$item->nilai_skpk}}" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-2 col-form-label">Jenis Kegiatan</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$item->is_jenis}}" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-2 col-form-label">Sifat Kegiatan</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$item->is_sifat}}" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-2 col-form-label">Metode Kegiatan</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$item->is_metode}}" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-2 col-form-label">Tingkat Kegiatan</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$item->is_tingkat}}" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-2 col-form-label">Angka Kredit</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="{{$item->angka_kredit}}" readonly/>
                            </div>
                        </div>
                    </div> --}}
                    @foreach (\App\Models\MtBobotPenilaian::where('id', $item->unsur->id_bobot_penilaian)->get() as $j)
                    <div class="col-md-6">
                            <h5 class="h5">Penilaian Validator</h5>
                            <div class="form-group row mt-5">
                                <label  class="col-2 col-form-label">Nilai SKPK</label>
                                <div class="col-10">
                                    <input class="form-control" type="number" min="0" max="{{$item->nilai_skpk}}" name="nilai_skpk[]" required/>
                                    <input name="id_kegiatan" value="{{$data->uuid}}" hidden/>
                                    <input name="id_unsur[]" value={{$item->id_unsur}} hidden/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-2 col-form-label">Jenis Kegiatan</label>
                                <div class="col-10">
                                    <select class="form-control" name="is_jenis[]" id="is_jenis">
                                        <option value="">Pilih Jenis</option>
                                        <option value="{{$j->verif}}">Terverfikasi</option>
                                        <option value="{{$j->no_verif_penyelenggara}}">Tidak Terverifikasi Penyelenggara PKB dapat diverifikasi dan divalidasi</optio   n>
                                        <option value="{{$j->no_verif_not_penyelenggara}}">Tidak Terverifikasi Penyelenggara PKB tidak dapat diverifikasi dan divalidasi</option>
                                        <option value="{{$j->mandiri}}">Mandiri</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-2 col-form-label">Sifat Kegiatan</label>
                                <div class="col-10">
                                    <select class="form-control" name="is_sifat[]" id="is_sifat">
                                        <option value="">Pilih Jenis</option>
                                        <option value="{{$j->umum}}">Umum</option>
                                        <option value="{{$j->khusus}}">Khusus</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-2 col-form-label">Metode Kegiatan</label>
                                <div class="col-10">
                                    <select class="form-control" name="is_metode[]" id="is_metode">
                                        <option value="">Pilih Metode</option>
                                        <option value="{{$j->tatap_muka}}">Tatap Muka</option>
                                        <option value="{{$j->daring}}">Daring</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-2 col-form-label">Tingkat Kegiatan</label>
                                <div class="col-10">
                                    <select class="form-control" name="is_tingkat[]" id="is_tingkat">
                                        <option value="">Pilih Tingkat</option>
                                        <option value="{{$j->nasional}}">Nasional</option>
                                        <option value="{{$j->internasional_dalam_negeri}}">Internasional Dalam Negeri</option>
                                        <option value="{{$j->internasional_luar_negeri}}">Internasional Luar Negeri</option>
                                    </select>
                                </div>
                            </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
                <div class="form-group row">
                    <button class="btn btn-primary btn-block" type="submit">Submit</button>
                </div>
            </form>
                <!--end::Timeline-->
            </div>
            <!--end: Card Body-->
        </div>
        <!--end: List Widget 9-->
    </div>
</div>
