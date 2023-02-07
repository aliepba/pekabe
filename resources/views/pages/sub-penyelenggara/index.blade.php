@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card card-custom shadow mb-4">
        <div class="card-header flex-wrap py-3">
            <div class="card-title">
                <h4 class="h4">List Penanggung Jawab</h4>
            </div>
            <div class="card-toolbar">
                <a href="{{route('sub-penyelenggara.create')}}" class="btn btn-sm btn-primary">
                    <i class="flaticon-plus"></i>
                    Tambah Penanggung Jawab
                  </a>
            </div>
        </div>
        <div class="card-body">
          <div class="table">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Full Name</th>
                  <th>Alamat</th>
                  <th>Email</th>
                  <th>Active</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->nama}}</td>
                        <td>{{$item->alamat}}</td>
                        <td>{{$item->propinsi->Nama}}</td>
                        <td>{{$item->email}}</td>
                        <td><span class="badge badge-{{$item->is_active == 1 ? "success" : "danger"}}">{{$item->is_active == 1 ? "Active" : "Deactive"}}</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a href="{{route('sub-penyelenggara.edit', $item->id)}}" class="dropdown-item"> Edit</a>
                                    @if ($item->is_active == 1)
                                    <a href="{{route('change.status', $item->id)}}" class="dropdown-item">Deactive</a>
                                    @endif
                                    @if ($item->is_active == 0)
                                    <a href="{{route('change.status', $item->id)}}" class="dropdown-item">Active</a>
                                    @endif
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
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
