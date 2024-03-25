<?php

namespace App\Providers;

use App\Models\DetailInstansi;
use App\Models\MtMenu;
use App\Models\RoleMenu;
use App\Models\Pengembangan\UserAPI;
use Illuminate\Support\ServiceProvider;
use View;
use Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\Kegiatan;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        Paginator::useBootstrap();

        View::composer('*', function ($view) {
            // Check if the current view is not 'indexing'
            if (auth()->check()) {
                $role = auth()->user()->roles()->first();
                $roleId = $role->id;
                $cachedName = 'chached_'.$roleId;
                $roleMenu = Cache::remember("menu_$roleId", 1800 , function () use ($roleId) {
                    return RoleMenu::with(['menu' => function($query){
                                    $query->orderBy('order', 'asc');
                                    }])->where('role_id', $roleId)->get();
                });

                // <sup class="badge badge-danger">{{count(App\Models\Kegiatan::where('status_permohonan_kegiatan', 'PELAPORAN')->where('is_open', false)->get())}}</sup>
                $persetujuan = Kegiatan::where([
                                'status_permohonan_kegiatan' => 'SUBMIT',
                                'is_open' => false
                            ])->count();

                $validasi = Kegiatan::where([
                                'status_permohonan_kegiatan' => 'PELAPORAN',
                                'is_open' => false
                ])->count();

                $verifikasi = Kegiatan::where([
                                'status_permohonan_kegiatan' => 'VALIDASI',
                                'is_open' => false
                            ])->count();

                $akun = DetailInstansi::where('status_permohonan', 'SUBMIT')->count();
    
                $menus = '';
                $count= '';
                foreach ($roleMenu as $item) {

                    $active = Request::url() ==  Request::is(app()->getLocale() .  $item->menu->url) ? 'active' : '';
                    
                    if($item->menu->count_type == 'akun'){
                        $count = '<sup class="badge badge-danger">'. $akun .'</sup>'; 
                    }elseif($item->menu->count_type == 'kegiatan'){
                        $count = '<sup class="badge badge-danger">'. $persetujuan .'</sup>';
                    }elseif($item->menu->count_type == 'verifikasi'){
                        $count = '<sup class="badge badge-danger">'. $verifikasi .'</sup>';
                    }elseif($item->menu->count_type == 'validasi'){
                        $count = '<sup class="badge badge-danger">'. $validasi .'</sup>';
                    }else{
                        $count = '';
                    }
                    
                    if ($item->menu->type == 'header') {
                        $menus .= '<li class="menu-section">';
                        $menus .= '<h4 class="menu-text">' . $item->menu->name . '</h4>';
                        $menus .= '<i class="menu-icon ki ki-bold-more-hor icon-md"></i>';
                        $menus .= "</li>";
                    } 
                    
                    if ($item->menu->type == 'menu'  && $item->menu->has_child == 0){
                        $route = !empty($item->menu->route) ? $item->menu->route : 'error.page';
                        $menus .= '<li class="menu-item menu-item" aria-haspopup="true">';
                        $menus .= '<a href="' . route($route) . '"' . ' class="menu-link'. $active . '">';
                        $menus .= '<span class="svg-icon menu-icon">';
                        $menus .= $item->menu->icon;
                        $menus .= "</span>";
                        $menus .= '<span class="menu-text"> ' . $item->menu->name . $count .'</span>';
                        $menus .= "</a></li>";
                    }

                    if ($item->menu->type == 'menu'  && $item->menu->has_child == 1){
                        $menus .= '<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">';
                        $menus .=       '<a href="javascript:;" class="menu-link menu-toggle">';
                        $menus .=           '<span class="svg-icon menu-icon">';
                        $menus .=               $item->menu->icon;
                        $menus .=           '</span>';
                        $menus .=           '<span class="menu-text"> ' . $item->menu->name . '</span>';
                        $menus .=       '</a>';
                        
                        $sub_menu = MtMenu::where(['parent_id' => $item->menu->id, 'type' => 'sub-menu'])->get();

                        if(!empty($sub_menu)){
                            $menus .= '<div class="menu-submenu">';
                            $menus .=   '<i class="menu-arrow"></i>';
                            $menus .=       '<ul class="menu-subnav">';
                            $menus .=           '<li class="menu-item menu-item-parent" aria-haspopup="true">';
                            $menus .=               '<span class="menu-link">';
                            $menus .=                   '<span class="menu-text">'. $item->menu->name .'</span>';
                            $menus .=                  '</span>';
                            $menus .=              '</li>';
                            
                            foreach($sub_menu as $mn){
                            $menus .=           '<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">';
                            $menus .=               '<a href="' . route($mn->route) . '"' . ' class="menu-link menu-toggle'. $active . '">';
                            $menus .=                    '<i class="menu-bullet menu-bullet-line">';
                            $menus .=                       '<span></span>';
                            $menus .=                      '</i>';
                            $menus .=                       '<span class="menu-text">'. $mn->name .'</span>';
                            $menus .=               '</a>';
                            $menus .=           '</li>';
                        }
                        $menus .=       '</ul>';
                        $menus .=   '</div>';
                        $menus .= '</li>';
                        }
                    }
                }

                if(!empty(UserAPI::where('id', Auth::user()->id)->first())){

                    $menus .= '<li class="menu-section">';
                    $menus .= '<h4 class="menu-text">Pengembangan Kegiatan</h4>';
                    $menus .= '<i class="menu-icon ki ki-bold-more-hor icon-md"></i>';
                    $menus .= "</li>";

                    $menus .= '<li class="menu-item menu-item" aria-haspopup="true">';
                    $menus .= '<a href=" '. route('asosiasi.index') .'" class="menu-link">';
                    $menus .= '<span class="svg-icon menu-icon">';
                    $menus .= '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><path d="M6.26193932,17.6476484 C5.90425297,18.0684559 5.27315905,18.1196257 4.85235158,17.7619393 C4.43154411,17.404253 4.38037434,16.773159 4.73806068,16.3523516 L13.2380607,6.35235158 C13.6013618,5.92493855 14.2451015,5.87991302 14.6643638,6.25259068 L19.1643638,10.2525907 C19.5771466,10.6195087 19.6143273,11.2515811 19.2474093,11.6643638 C18.8804913,12.0771466 18.2484189,12.1143273 17.8356362,11.7474093 L14.0997854,8.42665306 L6.26193932,17.6476484 Z" fill="#000000" fill-rule="nonzero" transform="translate(11.999995, 12.000002) rotate(-180.000000) translate(-11.999995, -12.000002) "/></g></svg>';
                    $menus .= "</span>";
                    $menus .= '<span class="menu-text">List Kegiatan Pengembangan</span>';
                    $menus .= "</a></li>";
                }
        
                Cache::put($cachedName, $menus, 1800);

                $view->with('menus', $menus);
            }
        });
    }
}
