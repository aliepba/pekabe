@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <a href="{{route('roles.create')}}" class="btn btn-sm btn-primary">
            <i class="flaticon-plus"></i>
            Add Role
          </a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Instansi</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($list as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->nama_instansi}}</td>
                    <td>{{$item->email_instansi}}</td>
                    <td>{{$item->alamat}}</td>
                    <td>{{$item->telepon}}</td>
                    <td>
                        <a href="{{route('detail.permohonan', $item->uuid)}}" class="btn btn-sm btn-primary"><i class="flaticon-eye"></i></a>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>
@endsection
