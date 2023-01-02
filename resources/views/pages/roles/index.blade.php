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
                  <th>Role Name</th>
                  <th>Permission</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$role->name}}</td>
                        <td>
                        @foreach ($role->permissions as $permission)
                        <span class="badge badge-primary mt-2">{{$permission->name}}</span>
                        @endforeach
                        </td>
                        <td class="text-center">
                            <a href="{{route('roles.edit', $role->id)}}" class="btn btn-sm btn-primary">
                                <i class="flaticon-edit"></i></a>
                            <form action="{{route('roles.destroy', $role->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                <button class="btn btn-danger btn-sm mt-5"><i class="flaticon2-trash"></i></button>
                            </form>
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
