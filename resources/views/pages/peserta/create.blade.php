@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="h4">Form Kegiatan</h4>
        </div>
        <div class="card-body">
            <form action="{{route('peserta.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="number" class="form-control" name="nik" maxlength="16" placeholder="nik" required>
                            <input type="text" name="id_kegiatan" value="{{$data->uuid}}" hidden/>
                        </div>
                        <div class="form-group">
                            <label>Unsur Kegiatan</label>
                            <input type="text" class="form-control" name="unsur" value="{{$data->unsur_kegiatan}}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Metode Kegiatan</label>
                            <div class="radio-inline">
                                <label class="radio">
                                    <input type="radio" name="metode"/>
                                    <span></span>
                                    Tatap Muka
                                </label>
                                <label class="radio">
                                    <input type="radio" name="metode"/>
                                    <span></span>
                                    Daring
                                </label>
                            </div>
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
