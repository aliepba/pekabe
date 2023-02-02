<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MtBobotPenilaian;
use App\Services\UnsurKegiatan\BobotPenilaianService;

class BobotPenilaianController extends Controller
{

    private $bobotPenilaianService;

    public function __construct(BobotPenilaianService $bobotPenilaianService)
    {
        $this->bobotPenilaianService = $bobotPenilaianService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view-bobot');
        return view('pages.bobot-penilaian.index', [
            'data' => MtBobotPenilaian::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-bobot');
        return view('pages.bobot-penilaian.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create-bobot');
        $this->bobotPenilaianService->store($request);
        return redirect()->route('bobot-penilaian.index')->with(['success', 'berhasil']);
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
        $this->authorize('edit-bobot');
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
        $this->authorize('edit-bobot');
        $this->bobotPenilaianService->update($request, $id);
        return redirect()->route('bobot-penilaian.index')->with(['success', 'berhasil']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete-bobot');
    }
}
