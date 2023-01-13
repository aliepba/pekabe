@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4" style="margin-top: -50px;">
        <div class="card-header py-3">
            <h4 class="h4">Form Kegiatan</h4>
        </div>
        <div class="card-body">
            <form action="{{route('kegiatan-penyelenggara.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Nama Kegiatan <span class="text-danger">*</span></label>
                    <div class="col-10">
                        <textarea class="form-control" name="nama_kegiatan" rows="3" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Unsur Kegiatan <span class="text-danger">*</span></label>
                    <div class="col-10">
                        <select class="form-control" name="unsur_kegiatan" required>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Penyelenggara Kegiatan<span class="text-danger">*</span></label>
                    <div class="col-10">
                        <input type="text" class="form-control" name="nama_penyelenggara">
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Lokasi Kegiatan  <span class="text-danger">*</span></label>
                    <div class="col-10">
                        <input type="text" class="form-control" name="tempat_kegiatan" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Waktu Kegiatan  <span class="text-danger">*</span></label>
                    <div class="col-5">
                        <input type="date" class="form-control" name="start_kegiatan" required>
                    </div>
                    <div class="col-5">
                        <input type="date" class="form-control" name="end_kegiatan" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Klasifikasi <span class="text-danger">*</span></label>
                    <div class="col-10">
                        <select class="form-control" name="id_klasifikasi" required>
                            <option value="">Pilih Klasifikasi</option>
                            @foreach ($klas as $item)
                                <option value="{{$item->id_klasifikasi}}">{{$item->klasifikasi}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Metode Kegiatan <span class="text-danger">*</span></label>
                    <div class="col-10">
                        <div class="radio-inline">
                            <label class="radio">
                                <input type="radio" name="metode" value="Tatap Muka"/>
                                <span></span>
                                Tatap Muka
                            </label>
                            <label class="radio">
                                <input type="radio" name="metode" value="Daring"/>
                                <span></span>
                                Daring
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Tingkat <span class="text-danger">*</span></label>
                    <div class="col-10">
                        <select class="form-control" name="tingkat_kegiatan" required>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Bukti Kegiatan <span class="text-danger">*</span></label>
                    <div class="col-10">
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
