@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="font-weight">Form Penanggung Jawab</h5>
        </div>
        <div class="card-body">
            <form action="{{route('sub-penyelenggara.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="control-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required/>
                </div>
                <div class="form-group">
                    <label class="control-label">Alamat</label>
                    <textarea class="form-control" name="alamat" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label class="control-label">No Handphone</label>
                    <input type="text" class="form-control" name="telepon" placeholder="Nomor Handphone" required/>
                </div>
                <div class="form-group">
                    <label class="control-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email" required/>
                </div>
                <div class="form-group">
                    <label class="control-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required/>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </form>
        </div>
      </div>
</div>
@endsection


