@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="font-weight">Form Role</h5>
        </div>
        <div class="card-body">
            <form action="{{route('users.update', $data->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="control-label">Nama</label>
                    <input type="text" class="form-control" name="name" placeholder="FullName" value="{{$data->name}}" required/>
                </div>
                <div class="form-group">
                    <label class="control-label">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Email" value="{{$data->email}}" required/>
                </div>
                <div class="form-group">
                    <label class="control-label">Role</label>
                    <select class="form-control" name="role" required>
                        <option value="{{!empty($data->roles->first()) ? $data->roles->first()->name : 'user'}}">{{!empty($data->roles->first()) ? $data->roles->first()->name : 'user'}}</option>
                        @foreach ($roles as $item)
                        <option value="{{$item->name}}">{{$item->name}}</option>
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

