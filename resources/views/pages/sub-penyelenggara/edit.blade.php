@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="font-weight">Edit Penanggung Jawab</h5>
        </div>
        <div class="card-body">
            <form action="{{route('sub-penyelenggara.update', $data->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="control-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" value="{{$data->nama}}"  required/>
                </div>
                <div class="form-group">
                    <label class="control-label">Alamat</label>
                    <textarea class="form-control" name="alamat" rows="5">{{$data->alamat}}</textarea>
                </div>
                <div class="form-group">
                    <label class="control-label">Provinsi</label>
                    <select class="form-control" name="id_propinsi" required>
                        <option value="">Pilih Provinsi</option>
                        @foreach ($propinsi as $prov)
                        <option value="{{$prov->id_propinsi_dagri}}">{{$prov->Nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">No Handphone</label>
                    <input type="text" class="form-control" name="telepon"  value="{{$data->telepon}}" required/>
                </div>
                <div class="form-group">
                    <label class="control-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{$data->email}}" required/>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </form>
        </div>
      </div>
</div>
@endsection


