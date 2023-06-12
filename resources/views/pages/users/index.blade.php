@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{route('users.create')}}" class="btn btn-sm btn-primary">
                <i class="flaticon-plus"></i>
                Tambah User
            </a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="users" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Jenis Penyelenggara</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Roles</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->penyelenggara->jenis_penyelenggara ?? "-"}}
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>
                    @foreach ($item->roles as $role)
                        {{$role->name}}
                    @endforeach
                    </td>
                    <td>
                        <a href="{{route('users.edit', $item->id)}}" class="btn btn-sm btn-primary">Edit</a>
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

@push('addon-script')
    <script>
        $(document).ready(function () {
            $('#users').DataTable();
        });
    </script>
@endpush
