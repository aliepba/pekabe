<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Penilaian\PenilaianService;
use App\Actions\Kegiatan\GetPenilaianValidator;
use App\Actions\Kegiatan\GetDetailPenilaianValidator;

class PenilaianValidatorController extends Controller
{

    private $penilaianService;

    public function __construct(PenilaianService $penilaianService)
    {
        $this->PenilaianService = $penilaianService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.penilaian-validator.index', GetPenilaianValidator::run());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->PenilaianService->penilaianValidator($request);
        return redirect(route('penilaian-validator.index'))->with('success', 'berhasil dinilai');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        return view('pages.penilaian-validator.penilaian', GetDetailPenilaianValidator::run($uuid));
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
