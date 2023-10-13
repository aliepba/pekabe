<?php

namespace App\Services\SubPenyelenggara;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SubPenyelenggara;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SubPenyelenggaraService {
    public function store(Request $request){
        DB::transaction(function () use($request) {
            $data = SubPenyelenggara::query()->create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'email' => $request->email,
                'id_propinsi' => $request->id_propinsi,
                'password' => $request->password,
                'is_active' => 1,
                'user_id' => Auth::user()->id,
                'jenis' => Auth::user()->jenis_penyelenggara
            ]);

            $user = User::query()->create([
                'name' => $data->nama,
                'email' => $data->email,
                'password' => Hash::make($data->password),
                'role' => 'sub-user',
                'jenis_penyelenggara' => Auth::user()->jenis_penyelenggara
            ]);

            $user->assignRole('sub-user');
        });
    }

    public function update(Request $request, SubPenyelenggara $subPenyelenggara){
        $user = User::where('email', $subPenyelenggara->email)->first();
        DB::transaction(function () use($request, $user, $subPenyelenggara){
            $subPenyelenggara->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'id_propinsi' => $request->id_propinsi,
                'email' => $request->email,
            ]);

            $user->update([
                'name' => $request->nama,
                'email' => $request->email,
            ]);
        });
    }

    public function destroy(SubPenyelenggara $subPenyelenggara)
    {
        $user = User::where('email', $subPenyelenggara->email)->first();
        $user->forceDelete();
        $subPenyelenggara->forceDelete();
    }

    public function changeStatus($id){
        $subPenyelenggara = SubPenyelenggara::find($id);
        $user = User::where('email', $subPenyelenggara->email)->first();
        DB::transaction(function () use($subPenyelenggara, $user) {
            if($subPenyelenggara->is_active == 1){
                $subPenyelenggara->update(['is_active' => 0]);

                $user->update([
                    'deleted_at' => Carbon::now()
                ]);
            }else{
                $subPenyelenggara->update(['is_active' => 1]);

                $user->update([
                    'deleted_at' => null
                ]);
            }
        });
    }
}
