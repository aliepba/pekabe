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
                    <div class="form-group">
                        <label>Penyelenggara Lain</label>
                        <select class="form-control" name="penyelenggara_lain">
                        </select>
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
