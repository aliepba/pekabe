<?php

namespace App\Http\Controllers;

use App\Actions\Instansi\GetProsesInstansi;
use App\Actions\Instansi\GetTolakPenyelenggara;
use Illuminate\Http\Request;
use App\Models\DetailInstansi;
use App\Services\PermohonanAkun\PermohonanAkunService;

class VerifikasiAkunController extends Controller
{
    private $permohonanAkunService;

    public function __construct(PermohonanAkunService $permohonanAkunService)
    {
        $this->permohonanAkunService = $permohonanAkunService;
    }

    public function list(){
        $this->authorize('list-akun', DetailInstansi::class);
        return view('pages.verifikasi.list', [
            'list' => DetailInstansi::with(['penanggungjawab'])->where('status_permohonan', 'SUBMIT')->get()
        ]);
    }

    public function setuju(){
        return view('pages.verifikasi.setuju', GetProsesInstansi::run());
    }

    public function tolak(){
        return view('pages.verifikasi.tolak', GetTolakPenyelenggara::run());
    }

    public function detailPermohonan($uuid){
        $this->authorize('detail-akun', DetailInstansi::class);
        $data = DetailInstansi::with(['penanggungjawab', 'provinsi', 'kabKota', 'Jenispenyelenggara'])->where('uuid', $uuid)->first();

        if($data->jenis == 1){
            return view('pages.verifikasi.detail', [
                'data' => $data,
                'file1' => null,
                'file2' => null,
                'file3' => null,
            ]);
        }

        if($data->jenis == 2){
            return view('pages.verifikasi.detail', [
                'data' => $data,
                'file1' => "Akta notaris atas pendirian asosiasi",
                'file2' => "Pengesahan badan hukum",
                'file3' => "Perkumpulan dari Kemenkumham"
            ]);
        }

        if($data->jenis == 3){
            return view('pages.verifikasi.detail', [
                'data' => $data,
                'file1' => "Akta notaris atas pendirian asosiasi",
                'file2' => "Pengesahan badan hukum",
                'file3' => "Perkumpulan dari Kemenkumham"
            ]);
        }

        if($data->jenis == 4){
            return view('pages.verifikasi.detail', [
                'data' => $data,
                'file1' => "Akta notaris atas pendirian asosiasi",
                'file2' => "Pengesahan badan hukum",
                'file3' => null,
            ]);
        }

        if($data->jenis == 5){
            return view('pages.verifikasi.detail', [
                'data' => $data,
                'file1' => "Data Pokok Pendidikan (Dapodik) untuk lembaga pendidikan",
                'file2' => "Izin lembaga pelatihan dari dinas terkait untuk lembaga pelatihan",
                'file3' => "Perkumpulan dari Kemenkumham"
            ]);
        }

        if($data->jenis == 6){
            return view('pages.verifikasi.detail', [
                'data' => $data,
                'file1' => "Akta Pendirian Perusahaan",
                'file2' => "SBU dan/atau IUJK yang masih berlaku",
                'file3' => null,
            ]);
        }

        if($data->jenis == 7){
            return view('pages.verifikasi.detail', [
                'data' => $data,
                'file1' => "Akta Pendirian Perusahaan",
                'file2' => "SIUP",
                'file3' => null,
            ]);
        }

        if($data->jenis == 8){
            return view('pages.verifikasi.detail', [
                'data' => $data,
                'file1' => "Akta Notaris",
                'file2' => "SIUP",
                'file3' => null,
            ]);
        }
    }

    public function tolakPermohonan(Request $request, $uuid){
        $this->authorize('tolak-akun', DetailInstansi::class);
        $this->permohonanAkunService->tolak($request, $uuid);
        return redirect()->route('list.permohonan')->with('success', 'Permohonan berhasil di tolak');
    }

    public function perbaikanPermohonan(Request $request, $uuid){
        $this->authorize('perbaikan-akun', DetailInstansi::class);
        $this->permohonanAkunService->perbaikan($request, $uuid);
        return redirect()->route('list.permohonan')->with('success', 'Permohonan berhasil di minta perbaikan');
    }

    public function approvePermohonan($uuid){
        $this->authorize('approve-akun', DetailInstansi::class);
        $this->permohonanAkunService->approve($uuid);
        return redirect()->route('list.permohonan')->with('success', 'Permohonan berhasil di approve');
    }

}
