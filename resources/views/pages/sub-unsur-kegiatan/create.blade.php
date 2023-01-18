@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="font-weight">Sub Unsur Kegiatan</h5>
        </div>
        <div class="card-body">
            <form action="{{route('sub-unsur-kegiatan.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="control-label">Unsur Kegiatan</label>
                    <select class="form-control" name="id_unsur_kegiatan" required>
                        @foreach ($unsur as $item)
                            <option value="{{$item->id}}">{{$item->unsur_kegiatan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Nama Sub Kegiatan</label>
                    <input class="form-control" name="nama_sub_unsur" required/>
                </div>
                <div class="form-group">
                    <label class="control-label">Nilai SKPK</label>
                    <input class="form-control" name="nilai_skpk" required/>
                </div>
                <div class="form-group">
                    <label class="control-label">Bobot Penilaian</label>
                    <select class="form-control" name="id_bobot_penilaian">
                        @foreach ($bobot as $item)
                            <option value="{{$item->id}}">{{$item->nama_unsur}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </form>
        </div>
      </div>
</div>
@endsection

