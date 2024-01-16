@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="h4">Form Kegiatan</h4>
        </div>
        <div class="card-body">
            <form action="{{route('pelaporan.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="h5">Pelaporan</h5>
                        <div class="form-group">
                            <label>Upload Berkas Pelaporan</label>
                            <input type="file" class="form-control" name="upload_persyaratan" required/>
                            <input type="text" name="id_kegiatan" value="{{$item->id_kegiatan}}" hidden/>
                            <span class="text-muted">Accepted formats: pdf Max file size 1Mb</span>
                        </div>
                        <div class="form-group">
                            <label>Upload Materi Kegiatan</label>
                            <input type="file" class="form-control" name="materi_kegiatan" required />
                            <span class="text-muted">Accepted formats: pdf Max file size 1Mb</span>
                        </div>
                        <div class="form-group">
                            <label>Upload Dokumentasi Kegiatan</label>
                            <input type="file" class="form-control" name="dokumentasi_kegiatan" required />
                            <span class="text-muted">Accepted formats: pdf Max file size 1Mb</span>
                        </div>
                        <div class="form-group">
                            <label>Undangan Kegiatan</label>
                            <input type="file" class="form-control" name="undangan_kegiatan" required />
                            <span class="text-muted">Accepted formats: pdf Max file size 1Mb</span>
                        </div>
                        <div class="form-group">
                            <label>Daftar Hadir Kegiatan</label>
                            <input type="file" class="form-control" name="daftar_hadir" required />
                            <span class="text-muted">Accepted formats: pdf Max file size 1Mb</span>
                        </div>
                        <div class="form-group">
                            <label>Link Pelaporan *)</label>
                            <input type="text" class="form-control" name="link_pelaporan" value="{{$item->link_pelaporan}}"/>
                            <span class="text-muted">*) Jika ada File Pelaporan dengan size terlalu besar dan melebihi yang dimintakan</span>
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

