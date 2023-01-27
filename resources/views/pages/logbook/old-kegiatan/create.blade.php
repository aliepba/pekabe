@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4" style="margin-top: -50px;">
        <div class="card-header py-3">
            <h4 class="h4">Form Kegiatan</h4>
        </div>
        <div class="card-body">
            <form action="{{route('kegiatan-terdaftar.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label  class="col-3 col-form-label">Subklasifikasi Tenaga Ahli <span class="text-danger">*</span></label>
                    <div class="col-9">
                        <select class="form-control" name="id_subklas">
                            @foreach ($subklas as $item)
                                <option value="{{$item->id_sub_bidang}}">{{$item->des_sub_klas}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-3 col-form-label">Provinsi <span class="text-danger">*</span></label>
                    <div class="col-9">
                        <select class="form-control" name="id_propinsi" required>
                            <option value="">Pilih Provinsi</option>
                            @foreach ($provinsi as $item)
                                <option value="{{$item->id_propinsi_dagri}}">{{$item->Nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-3 col-form-label">Tahun dan Bulan  <span class="text-danger">*</span></label>
                    <div class="col-4">
                        <input type="number" class="form-control" name="tahun" required>
                    </div>
                    <div class="col-4">
                        <select class="form-control" name="bulan" id="bulan" >
                            <option value="">--Pilih Bulan--</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-3 col-form-label">Nama Kegiatan<span class="text-danger">*</span></label>
                    <div class="col-9">
                        <select class="form-control bg-select" id="nama_kegiatan" name="nama_kegiatan">
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-3 col-form-label">Jenis Kegiatan  <span class="text-danger">*</span></label>
                    <div class="col-9">
                        <input type="text" class="form-control" name="jenis_kegiatan" id="jenis_kegiatan" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-3 col-form-label">Sub Kegiatan  <span class="text-danger">*</span></label>
                    <div class="col-9">
                        <input type="text" class="form-control" name="sub_kegiatan" id="sub_kegiatan" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-3 col-form-label">Tingkat Kegiatan  <span class="text-danger">*</span></label>
                    <div class="col-9">
                        <input type="text" class="form-control" name="tingkat_kegiatan" id="tingkat_kegiatan" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-3 col-form-label">Klasifikasi Peran <span class="text-danger">*</span></label>
                    <div class="col-9">
                        <select class="form-control" name="id_klas_peran" id="id_klas_peran">
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-3 col-form-label">Waktu Kegiatan  <span class="text-danger">*</span></label>
                    <div class="col-4">
                        <input type="date" class="form-control" name="start_kegiatan" id="start_kegiatan" required>
                    </div>
                    <div class="col-4">
                        <input type="date" class="form-control" name="end_kegiatan" id="end_kegiatan" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-3 col-form-label">Jumlah Jam <span class="text-danger">*</span></label>
                    <div class="col-9">
                        <input type="number" class="form-control" name="jumlah_jam" id="jumlah_jam" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-3 col-form-label">Perkiraan SKPK<span class="text-danger">*</span></label>
                    <div class="col-9">
                        <input type="number" class="form-control" name="nilai_skpk" id="nilai_skpk" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-3 col-form-label">Bukti Kegiatan <span class="text-danger">*</span></label>
                    <div class="col-9">
                        <input type="file" class="form-control" name="upload_persyaratan" required>
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
