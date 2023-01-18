@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{route('unsur-kegiatan.create')}}" class="btn btn-sm btn-primary">
                <i class="flaticon-plus"></i>
                Tambah Unsur Kegiatan
            </a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Jenis</th>
                  <th>Nama</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->jenis}}</td>
                        <td>{{$item->unsur_kegiatan}}</td>
                        <td>
                            <a href="{{route('unsur-kegiatan.edit', $item->id)}}" class="btn btn-sm btn-primary">
                                Edit
                            </a>
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
