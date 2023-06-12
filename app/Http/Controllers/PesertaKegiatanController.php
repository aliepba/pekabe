<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Services\Peserta\PesertaService;
use App\Http\Resources\Peserta\PesertaResource;
use App\Http\Resources\Peserta\PesertaCollection;
use App\Models\PesertaKegiatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class PesertaKegiatanController extends Controller
{

    private $pesertaService;

    public function __construct(PesertaService $pesertaService)
    {
        $this->pesertaService = $pesertaService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($uuid)
    {
        $this->authorize('create-peserta', PesertaKegiatan::class);
        return view('pages.peserta.create', [
            'data' => Kegiatan::with('unsurKegiatan', 'unsurKegiatan.unsur')->where('uuid', $uuid)->first()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create-peserta', PesertaKegiatan::class);
        $this->pesertaService->store($request);
        return redirect(route('kegiatan-penyelenggara.show', $request->id_kegiatan))->with('success', 'berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('edit-peserta', PesertaKegiatan::class);
        $data = PesertaKegiatan::with(['unsur'])->find($id);
        return view('pages.peserta.edit', [
            'data' => $data,
            'kegiatan' => Kegiatan::with('unsurKegiatan', 'unsurKegiatan.unsur')->where('uuid', $data->id_kegiatan)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update-peserta', PesertaKegiatan::class);
        if(Auth::user()->role == 'root' || Auth::user()->role == 'admin'){
            $this->pesertaService->update($request, $id);
            $kegiatan = PesertaKegiatan::find($id);
            return redirect(route('verifikasi-validasi.show', $kegiatan->id_kegiatan))->with('success', 'berhasil diupdate');
        }
        $this->pesertaService->update($request, $id);
        return redirect(route('kegiatan-penyelenggara.index'))->with('success', 'berhasil diupdate!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->pesertaService->delete($id);
        return redirect(route('kegiatan-penyelenggara.index'))->with('success', 'peserta berhasil dihapus');
    }

    public function getPeserta($id){
        $peserta = PesertaKegiatan::find($id);
        return response()->json($peserta);
    }

    public function addPeserta(Request $request){
        $this->pesertaService->store($request);
        return response()->json([
            "message" => "success"
        ]);
    }

    public function deletePeserta($id){
        $this->pesertaService->delete($id);
        
        return response()->json([
            "message" => "success"
        ]);
    }
    
}
