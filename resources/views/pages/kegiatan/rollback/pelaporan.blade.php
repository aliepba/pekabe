@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="h4">Form Kegiatan</h4>
        </div>
        <div class="card-body">
            <form action="{{route('rollback.pelaporan.proses')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nama Kegiatan</label>
                            <br/>
                            <select class="form-control" id="kt_select2_1" name="id_hash" required>
                                <option value=""></option>
                                @foreach ($kegiatan as $item)
                                    <option value="{{$item->id_hash}}">{{$item->nama_kegiatan}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Status Rollback<span class="text-danger">*</span></label>
                            <select class="form-control select2 selectpicker" name="is_open" required>
                                <option value="0">CLOSED PELAPORAN</option>
                                <option value="1">OPEN PELAPORAN</option>
                            </select>
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

