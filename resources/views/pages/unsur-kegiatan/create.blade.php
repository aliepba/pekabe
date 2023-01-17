@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="font-weight">Form Role</h5>
        </div>
        <div class="card-body">
            <form action="{{route('unsur-kegiatan.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="control-label">Nama Unsur Kegiatan</label>
                    <input type="text" class="form-control" name="unsur_kegiatan" placeholder="Nama Unsur Kegiatan" required/>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </form>
        </div>
      </div>
</div>
@endsection

