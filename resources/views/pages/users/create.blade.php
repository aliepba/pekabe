@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="font-weight">Form Role</h5>
        </div>
        <div class="card-body">
            <form action="{{route('users.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="control-label">Jenis Penyelenggara</label>
                    <select class="form-control" name="jenis_penyelenggara" required>
                        @foreach ($jenis as $item)
                        <option value="{{$item->id}}">{{$item->jenis_penyelenggara}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Nama</label>
                    <input type="text" class="form-control" name="name" placeholder="FullName" required/>
                </div>
                <div class="form-group">
                    <label class="control-label">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Email" required/>
                </div>
                <div class="form-group">
                    <label class="control-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required/>
                </div>
                <div class="form-group">
                    <label class="control-label">Role</label>
                    <select class="form-control" name="role" required>
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

