<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Permission;
use Lorisleiva\Actions\Concerns\AsAction;

class ListPermission
{
    use AsAction;

    public function handle() :array
    {
        return [
            'allPermissions' => Permission::query()
                ->whereNotIn('name', config('permission-list.full_access_permission'))
                ->get('name'),
            'fullAccessPermission' => Permission::query()
                ->whereIn('name', config('permission-list.full_access_permission'))
                ->get('name'),
            'dashboardPermissions' => Permission::query()
                ->whereIn('name', config('permission-list.dashboard_permissions'))
                ->get('name'),
            'rolePermissions' => Permission::query()
                ->whereIn('name', config('permission-list.role_permissions'))
                ->get('name'),
            'userPermissions' => Permission::query()
                ->whereIn('name', config('permission-list.user_permissions'))
                ->get('name'),
            'validatorPermissions' => Permission::query()
                ->whereIn('name', config('permission-list.validator_permissions'))
                ->get('name'),
            'unsurPermissions' => Permission::query()
                ->whereIn('name', config('permission-list.master_unsur_kegiatan'))
                ->get('name'),
            'permohonanAkunPermissions' => Permission::query()
                ->whereIn('name', config('permission-list.permohonan_akun_permissions'))
                ->get('name'),
            'verifikasiKegiatanPermissions' => Permission::query()
                ->whereIn('name', config('permission-list.verifikasi_kegiatan_permission'))
                ->get('name'),
            'permohonanKegiatanPermissions' => Permission::query()
                ->whereIn('name', config('permission-list.permohonan_kegiatan_permissions'))
                ->get('name'),
            'subPenyelenggaraPermissions' => Permission::query()
                ->whereIn('name', config('permission-list.sub_penyelenggara_permissions'))
                ->get('name'),
            'pesertaPermissions' => Permission::query()
                ->whereIn('name', config('permission-list.peserta_permissions'))
                ->get('name'),
            'logbookPermissions' => Permission::query()
                ->whereIn('name', config('permission-list.logbook_permissions'))
                ->get('name'),
        ];
    }
}
