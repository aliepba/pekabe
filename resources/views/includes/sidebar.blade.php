<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
    <!--begin::Menu Nav-->
    @include('includes.menu.dynamic-menu')
    {{-- @if(Auth::user()->role == 'admin')
    @include('includes.menu.admin')
    @endif
    @if(Auth::user()->role == 'user')
    @include('includes.menu.user')
    @endif
    @if(Auth::user()->role == 'root')
    @include('includes.menu.root')
    @endif
    @if(Auth::user()->role == 'sub-user')
    @include('includes.menu.sub-user')
    @endif
    @if(Auth::user()->role == 'skk-ska')
    @include('includes.menu.skk')
    @endif
    @if (Auth::user()->role == 'apt')
    @include('includes.menu.apt')
    @endif --}}
    <!--end::Menu Nav-->
</div>
