<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
    <!--begin::Menu Nav-->
    @if(Auth::user()->role == 'admin')
    @include('includes.menu.admin')
    @endif
    @if(Auth::user()->role == 'user')
    @include('includes.menu.user')
    @endif
    @if(Auth::user()->role == 'root')
    @include('includes.menu.root')
    @endif
    <!--end::Menu Nav-->
</div>
5
