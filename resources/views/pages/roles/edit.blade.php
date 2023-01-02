@extends('layouts.admin')

@section('subheader')
<div class="subheader py-2 py-lg-2 gutter-b subheader-transparent" id="kt_subheader" style="background-color: #663259; background-position: right bottom; background-size: auto 100%; background-repeat: no-repeat; background-image: url(assets/media/svg/patterns/taieri.svg)">
    <div class="container d-flex flex-column">
        <!--begin::Title-->
        <div class="d-flex align-items-sm-end flex-column flex-sm-row my-5">
            <h2 class="d-flex align-items-center text-white mr-5 mb-0">
            <!--begin::Mobile Toggle-->
            <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                <span></span>
            </button>
            <!--end::Mobile Toggle-->
            Management {{$title}}</h2>
            <span class="text-white opacity-60 font-weight-bold">{{$item}}</span>
        </div>
        <!--end::Title-->
    </div>
</div>

@endsection

@section('content')
<div class="container">
    <div class="card card-custom">
        <div class="card-header">
         <h3 class="card-title">
          Base Controls
         </h3>
         <div class="card-toolbar">
          <div class="example-tools justify-content-center">
           <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
           <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
          </div>
         </div>
        </div>
        <!--begin::Form-->
        <form action="{{route('roles.update', $role->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
        <div class="card-body">
                <div class="form-group">
                    <label>Role Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{$role->name}}" placeholder="Enter Role Name"/>
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
                            @endforeach
                            />
                            <span></span>
                            {{$item->name}}
                        </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label>Dashboard Permissions</label>
                    <div class="checkbox-inline">
                        @foreach ($rolePermissions as $item)
                        <label class="checkbox">
                            <input type="checkbox" name="permissions" value="{{$item->name}}" />
                            <span></span>
                            {{$item->name}}
                        </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label>Dashboard Permissions</label>
                    <div class="checkbox-inline">
                        @foreach ($userPermissions as $item)
                        <label class="checkbox">
                            <input type="checkbox" name="permissions[]" value="{{$item->name}}"
                            @foreach ($role->permissions as $permission)
                            @if ($permission->name == $item->name)
                            checked
                            @endif
                            @endforeach
                            />
                            <span></span>
                            {{$item->name}}
                        </label>
                        @endforeach
                    </div>
                </div>
         </div>
         <div class="card-footer">
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
          <button type="reset" class="btn btn-secondary">Cancel</button>
         </div>
        </form>
        <!--end::Form-->
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
