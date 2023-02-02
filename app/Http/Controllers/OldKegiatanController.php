<?php

namespace App\Http\Controllers;

use App\Actions\Logbook\TenagaAhli;
use App\Models\MtProvinsi;
use Illuminate\Http\Request;
use App\Services\Kegiatan\OldKegiatanService;
use Illuminate\Support\Facades\Auth;

class OldKegiatanController extends Controller
{
    private $oldKegiatanService;

    public function __construct(OldKegiatanService $oldKegiatanService)
    {
        $this->OldKegiatanService = $oldKegiatanService;
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
    public function create()
    {
        $this->authorize('all-kegiatan');
        return view('pages.logbook.old-kegiatan.create', [
            'provinsi' => MtProvinsi::all()
        ], TenagaAhli::run(Auth::user()->nik));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->oldKegiatanService->store($request);
        return redirect(route('kegiatan.unverified'))->with('success', 'berhasil disimpan!');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
