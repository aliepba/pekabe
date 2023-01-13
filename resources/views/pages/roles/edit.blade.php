@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="font-weight">Form Role</h5>
        </div>
        <div class="card-body">
            <form action="{{route('roles.update', $role->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="control-label">Role Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Role Name" value="{{$role->name}}" required/>
                </div>
                <div class="form-group">
                    <label class="control-label">Permission</label>
                </div>
                <div class="form-group">
                    <label>All Permissions</label>
                    <div class="checkbox-inline">
                        @foreach ($fullAccessPermission as $item)
                        <label class="checkbox">
                            <input type="checkbox" name="permissions[]" value="{{$item->name}}" id="select-all"
                            @foreach ($role->permissions as $permission)
                            @if ($permission->name == $item->name)
                            checked
                            @endif
                            @endforeach/>
                            <span></span>
                            {{$item->name}}
                        </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label>Dashboard Permissions</label>
                    <div class="checkbox-inline">
                            @foreach ($dashboardPermissions as $item)
                            <label class="checkbox">
                                <input type="checkbox" name="permissions[]" value="{{$item->name}}"
                                @foreach ($role->permissions as $permission)
                                @if ($permission->name == $item->name)
                                checked
                                @endif
                                @endforeach/>
                                <span></span>
                                {{$item->name}}
                            </label>
                            @endforeach
                        </div>
                </div>
                <div class="form-group">
                        <label>Role Permissions</label>
                        <div class="checkbox-inline">
                            @foreach ($rolePermissions as $item)
                            <label class="checkbox">
                                <input type="checkbox" name="permissions[]" value="{{$item->name}}"
                                @foreach ($role->permissions as $permission)
                                @if ($permission->name == $item->name)
                                checked
                                @endif
                                @endforeach/>
                                <span></span>
                                {{$item->name}}
                            </label>
                            @endforeach
                        </div>
                </div>
                <div class="form-group">
                        <label>User Permissions</label>
                        <div class="checkbox-inline">
                            @foreach ($userPermissions as $item)
                            <label class="checkbox">
                                <input type="checkbox" name="permissions[]" value="{{$item->name}}"
                                @foreach ($role->permissions as $permission)
                            @if ($permission->name == $item->name)
                            checked
                            @endif
                            @endforeach/>
                                <span></span>
                                {{$item->name}}
                            </label>
                            @endforeach
                        </div>
                </div>
                <div class="form-group">
                        <label>Verifikasi Akun Permissions</label>
                        <div class="checkbox-inline">
                            @foreach ($verifikasiKegiatanPermissions as $item)
                            <label class="checkbox">
                                <input type="checkbox" name="permissions[]" value="{{$item->name}}"
                                @foreach ($role->permissions as $permission)
                            @if ($permission->name == $item->name)
                            checked
                            @endif
                            @endforeach/>
                                <span></span>
                                {{$item->name}}
                            </label>
                            @endforeach
                        </div>
                </div>
                <div class="form-group">
                    <label>Verifikasi Kegiatan Permissions</label>
                    <div class="checkbox-inline">
                        @foreach ($permohonanAkunPermissions as $item)
                        <label class="checkbox">
                            <input type="checkbox" name="permissions[]" value="{{$item->name}}"
                            @foreach ($role->permissions as $permission)
                        @if ($permission->name == $item->name)
                        checked
                        @endif
                        @endforeach/>
                            <span></span>
                            {{$item->name}}
                        </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label>Permohonan Kegiatan Permissions</label>
                    <div class="checkbox-inline">
                        @foreach ($permohonanKegiatanPermissions as $item)
                        <label class="checkbox">
                            <input type="checkbox" name="permissions[]" value="{{$item->name}}"
                            @foreach ($role->permissions as $permission)
                            @if ($permission->name == $item->name)
                            checked
                            @endif
                            @endforeach/>
                            <span></span>
                            {{$item->name}}
                        </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label>Penanggung Jawab Permissions</label>
                    <div class="checkbox-inline">
                        @foreach ($subPenyelenggaraPermissions as $item)
                        <label class="checkbox">
                            <input type="checkbox" name="permissions[]" value="{{$item->name}}"
                            @foreach ($role->permissions as $permission)
                            @if ($permission->name == $item->name)
                            checked
                            @endif
                            @endforeach/>
                            <span></span>
                            {{$item->name}}
                        </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label>Peserta Permissions</label>
                    <div class="checkbox-inline">
                        @foreach ($pesertaPermissions as $item)
                        <label class="checkbox">
                            <input type="checkbox" name="permissions[]" value="{{$item->name}}"
                            @foreach ($role->permissions as $permission)
                            @if ($permission->name == $item->name)
                            checked
                            @endif
                            @endforeach/>
                            <span></span>
                            {{$item->name}}
                        </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label>LogBook Permissions</label>
                    <div class="checkbox-inline">
                        @foreach ($logbookPermissions as $item)
                        <label class="checkbox">
                            <input type="checkbox" name="permissions[]" value="{{$item->name}}"
                            @foreach ($role->permissions as $permission)
                            @if ($permission->name == $item->name)
                            checked
                            @endif
                            @endforeach/>
                            <span></span>
                            {{$item->name}}
                        </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </form>
        </div>
      </div>
</div>
@endsection

@push('addon-script')
<script>
    $('#select-all').click(function(e){
        if(this.checked){
            $(':checkbox').each(function(){
                this.checked = true
            })
        }else{
            $(':checkbox').each(function(){
                this.checked = false
            })
        }
    })
</script>
@endpush

