<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Logbook\TenagaAhli;
use Illuminate\Support\Facades\Auth;
use App\Actions\Dashboard\CountKegiatan;
use App\Actions\Logbook\GetAngkaKreditTerverifikasi;
use App\Actions\Dashboard\CountKegiatanByPenyelenggara;
use App\Models\DetailInstansi;
use App\Models\Kegiatan;
use App\Models\KegiatanPenyelenggaraLain;
use App\Enums\PermohonanStatus;
use App\Models\User;
use App\Models\PelaporanKegiatan;
use App\Services\Logbook\LogbookService;
use helpers\MyHelper;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{

    private $logbookService;

    public function __construct(LogbookService $logbookService)
    {
        $this->middleware('isAdmin')->only('index');
        $this->middleware('isPenyelenggara')->only('dashboardUser');
        $this->middleware(['isSKA', 'isTenagaAhli'])->only(['dashboardTenagaAhli','indexSKK']);
        $this->middleware('isAPT')->only('dashboardApt');
        $this->logbookService = $logbookService;
    }

    public function index(){
        $this->authorize('view-dashboard');
        return view('dashboard', CountKegiatan::run());
    }

    public function dashboardUser(){
        return view('pages.dashboard.dashboard-user', CountKegiatanByPenyelenggara::run());
    }

    public function indexSKK(Request $request){
        $nik = Auth::user()->nik;
        $userId = (string)Auth::user()->id;

        $data = [];
        try{
        $ta = $this->logbookService->getSertifikat($nik);
        
            foreach($ta as $item){
                $syarat = MyHelper::syarat($item->kualifikasi);
                $syarat1 = MyHelper::nilaiSyarat(75, $item->kualifikasi);
                $syarat2 = MyHelper::nilaiSyarat(25, $item->kualifikasi);
                $syarat3 = MyHelper::nilaiSyarat(60, $item->kualifikasi);
                $syarat4 = MyHelper::nilaiSyarat(40, $item->kualifikasi);

                $utama = $this->logbookService->AKKegiatanUtama($nik, $userId, $item->id_sub_bidang, $item->tanggal_cetak);
                $penunjang = $this->logbookService->AKKegiatanPenunjang($nik, $userId, $item->id_sub_bidang, $item->tanggal_cetak);
                $selainNon = $this->logbookService->AKKegiatanSelainNonFormal($nik, $userId, $item->id_sub_bidang, $item->tanggal_cetak);
                $non = $this->logbookService->AKKegiatanNonFormal($item->id_sub_bidang, $item->tanggal_cetak);
                $terverifikasi = $this->logbookService->NilaiTerverifikasi($item->id_sub_bidang);
                $unverifed =  $this->logbookService->NilaiUnverified($item->tanggal_cetak);
                $khusus = $this->logbookService->nilaiKhusus($nik, $userId, $item->id_sub_bidang, $item->tanggal_cetak);
                $umum = $this->logbookService->nilaiUmum($item->id_sub_bidang);
                $all  = $this->logbookService->nilaiAll($item->id_sub_bidang, $item->tanggal_cetak);
                $status = MyHelper::status($item->kualifikasi, $item->id_sub_bidang, $item->tanggal_cetak);                

                array_push($data, [
                    'jabatan_kerja' => $item->id_sub_bidang . ' - ' . $item->des_sub_klas,
                    'kualifikasi' => $item->kualifikasi,
                    'berlaku' => $item->tanggal_cetak,
                    'syarat' => $syarat,
                    'syarat1' => $syarat1,
                    'syarat2' => $syarat2,
                    'syarat3' => $syarat3,
                    'syarat4' => $syarat4,
                    'utama' => $utama,
                    'utama1' => $utama - $syarat1,
                    'penunjang' => $penunjang,
                    'penunjang1' => $penunjang - $syarat2,
                    'selainNon' => $selainNon,
                    'selainNon1' => $selainNon - $syarat1,
                    'non' => $non,
                    'non1' => $non - $syarat2,
                    'terverifikasi' => $terverifikasi,
                    'terverifikasi1' => $terverifikasi - $syarat3,
                    'unverifed' => $unverifed,
                    'unverifed1' => $unverifed - $syarat4,
                    'khusus' => $khusus,
                    'khusus1' => $khusus - $syarat3,
                    'umum' => $umum,
                    'umum1' => $umum - $syarat4,
                    'all' => $all,
                    'status' => $status
                ]);
            }
            return view('pages.dashboard.dashboard-ska', [
                'data' => $data
            ]);
        }catch (\Exception $e) {
            $this->logService->store($request, $e->getMessage(), url()->current());
            return redirect(route('error.page'))->with('errro', 'Error');
        }
    }

    public function dashboardApt(){
        return view('pages.dashboard.dashboard-apt', CountKegiatanByPenyelenggara::run());
    }

    public function dashboardTenagaAhli(){
        return view('pages.dashboard.index-ska');
    }

    public function getRekap(Request $request)
    {
        $start = $request->date_from;
        $end = $request->date_end;

        $user = DetailInstansi::
                        where('status_permohonan', 'APPROVE')
                        ->whereBetween('created_at', [$start, $end])
                        ->count();
        $all = Kegiatan::whereNotIn('status_permohonan_kegiatan', ['OPEN'])
                        ->whereBetween('created_at', [$start, $end]) 
                        ->count(); 
        $kolaborasi = KegiatanPenyelenggaraLain::whereBetween('created_at', [$start, $end])->count();
        $setuju = Kegiatan::where('status_permohonan_kegiatan', PermohonanStatus::APPROVE)
                            ->whereBetween('created_at', [$start, $end])
                            ->count();
        $tolak = Kegiatan::where('status_permohonan_kegiatan', PermohonanStatus::TOLAK)
                            ->whereBetween('created_at', [$start, $end])
                            ->count();
        $tolakPenyelenggara = DetailInstansi::where('status_permohonan', PermohonanStatus::TOLAK)
                            ->whereBetween('created_at', [$start, $end])
                            ->count();
        $sah  =  Kegiatan::where('status_permohonan_kegiatan', PermohonanStatus::PENGESAHAN)
                            ->whereBetween('created_at', [$start, $end])
                            ->count();
        $akun = User::whereIn('role', ['user', 'sub-user'])->whereBetween('created_at', [$start, $end])->count();
        $pelaporan= PelaporanKegiatan::where('status_laporan', PermohonanStatus::SUBMIT)->whereBetween('created_at', [$start, $end])->count();
        $usertk = User::where('role', 'skk-ska')->whereBetween('created_at', [$start, $end])->count();

        return response()->json([
            'user' => $user,
            'all' => $all,
            'kolaborasi' => $kolaborasi,
            'setuju' => $setuju,
            'tolak' => $tolak,
            'tolakPenyelenggara' => $tolakPenyelenggara,
            'sah' => $sah,
            'pelaporan' => $pelaporan,
            'usertk' => $usertk,
            'akun' => $akun
         ]);
        

    }

}
