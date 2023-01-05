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
                            <select class="form-control" name="penyelenggara_lain">
                            </select>
                        </div>
                        <h5 class="h5">Sasaran Utama Tenaga Ahli</h5>
                        <div class="form-group">
                            <label>Sub Klasifikasi <span class="text-danger">*</span></label>
                            <select class="form-control select2" id="kt_select2_3" name="subklas[]" multiple="multiple">
                                @foreach ($subklas as $item)
                                    <option value="{{$item->subklasifikasi}}">{{$item->subklasifikasi}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Verifikator/validator dan penilai <span class="text-danger">*</span></label>
                            <select class="form-control" name="penilai">
                                @foreach ($profesi as $item)
                                    <option value="{{$item->ID_Asosiasi_Profesi}}">{{$item->Nama_Lengkap}} ({{$item->Nama}})</option>
                                @endforeach
                            </select>
                        </div>
                        <h5 class="h5">Klasifikasi Kegiatan</h5>
                        <div class="form-group">
                            <label>Unsur Kegiatan <span class="text-danger">*</span></label>
                            <select class="form-control" name="unsur_kegiatan">
                                <option value="hehe">hehe</option>
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
                        <div class="form-group">
                            <label>Tingkat <span class="text-danger">*</span></label>
                            <select class="form-control" name="tingkat_kegiatan">
                                <option value="hehe">hehe</option>
                            </select>
                        </div>
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
                            <label>Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="date" name="start_kegiatan" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Tanggal Selesai <span class="text-danger">*</span></label>
                            <input type="date" name="end_kegiatan" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="h5">Berkas Persyaratan</h5>
                        <div class="form-group">
                            <label>Surat Permohonan <span class="text-danger">*</span></label>
                            <input type="file" name="surat_permohonan" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label>TOR/KAK <span class="text-danger">*</span></label>
                            <input type="file" name="tor_kak" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label>SK Panitia</label>
                            <input type="file" name="sk_panitia" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Daftar Riwayat</label>
                            <input type="file" name="cv" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Persyaratan Lain</label>
                            <input type="file" name="persyaratan_lain" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Lainnya</label>
                            <input type="file" name="persyaratan_lain_lain" class="form-control" />
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

    </script>
@endpush
