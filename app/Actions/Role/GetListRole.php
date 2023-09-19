<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Role;
use Lorisleiva\Actions\Concerns\AsAction;

class GetListRole
{
    use AsAction;

    public function handle()
    {
        return [
            'roles' => Role::with('permissions')->orderByDesc('id')->paginate(10)
        ];
    }
}
