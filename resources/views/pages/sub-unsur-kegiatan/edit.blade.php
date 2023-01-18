@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="font-weight">Form Unsur Kegiatan</h5>
        </div>
        <div class="card-body">
            <form action="{{route('sub-unsur-kegiatan.update', $data->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="control-label">Jenis Kegiatan</label>
                    <input type="text" class="form-control" name="jenis" value="{{$data->jenis}}" required/>
                </div>
                <div class="form-group">
                    <label class="control-label">Nama Unsur Kegiatan</label>
                    <input type="text" class="form-control" name="unsur_kegiatan" value="{{$data->unsur_kegiatan}}" required/>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </form>
        </div>
      </div>
</div>
@endsection

