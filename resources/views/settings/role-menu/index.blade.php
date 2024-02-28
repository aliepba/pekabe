@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <a href="{{route('setting.role-menu.create')}}" class="btn btn-sm btn-primary">
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
                  <th>Role</th>
                  <th>Menus</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $item)
                    <tr>
                      <td></td>
                      <td>{{$item->name}}</td>
                      <td>@foreach ($item->mns as $mn)
                        <span class="badge badge-primary">
                             {{$mn->menu->name}}
                        </span>
                      @endforeach</td>
                      <td>
                        <a href="{{route('setting.role-menu.edit', $item->id)}}" class="btn btn-sm btn-primary">
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
