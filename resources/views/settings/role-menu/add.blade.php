@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="font-weight">Form Role</h5>
        </div>
        <div class="card-body">
            <form action="{{route('setting.role-menu.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="control-label">Role Name</label>
                    <select class="form-control" id="role_id" name="role_id" required>
                        @foreach ($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Menu</label>
                </div>
                <div class="form-group">
                    <label>All Menu</label>
                    <div class="checkbox-inline">
                        <label class="checkbox">
                            <input type="checkbox" name="" id="select-all"/>
                            <span></span>
                            All Menu
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Menu</label>
                    <div class="checkbox-inline">
                        @foreach ($mtmenu as $item)
                        <label class="checkbox">
                            <input type="checkbox" name="menus[]" value="{{$item->id}}"/>
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

