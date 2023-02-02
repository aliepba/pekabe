<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubPenyelenggara;
use App\Services\SubPenyelenggara\SubPenyelenggaraService;
use App\Http\Resources\SubPenyelenggara\SubPenyelenggaraResource;
use App\Http\Resources\SubPenyelenggara\SubPenyelenggaraCollection;

class SubPenyelenggaraController extends Controller
{
    private $subPenyelenggaraService;

    public function __construct(SubPenyelenggaraService $subPenyelenggaraService)
    {
        $this->subPenyelenggaraService = $subPenyelenggaraService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view-sub-penyelenggara', SubPenyelenggara::class);
        return view('pages.sub-penyelenggara.index', [
            'data' => new SubPenyelenggaraCollection(
                SubPenyelenggara::query()->paginate(10)
            )
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-sub-penyelenggara', SubPenyelenggara::class);
        return view('pages.sub-penyelenggara.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create-sub-penyelenggara', SubPenyelenggara::class);
        $this->subPenyelenggaraService->store($request);
        return redirect(route('sub-penyelenggara.index'))->with('success', 'berhasil dibuat');
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
    public function edit(SubPenyelenggara $subPenyelenggara)
    {
        $this->authorize('edit-sub-penyelenggara', SubPenyelenggara::class);
        return view('pages.sub-penyelenggara.edit', [
            'data' => new SubPenyelenggaraResource($subPenyelenggara)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubPenyelenggara $subPenyelenggara)
    {
        $this->authorize('update-sub-penyelenggara', SubPenyelenggara::class);
        $this->subPenyelenggaraService->update($request, $subPenyelenggara);
        return redirect(route('sub-penyelenggara.index'))->with('success', 'berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubPenyelenggara $subPenyelenggara)
    {
        $this->subPenyelenggaraService->destroy($subPenyelenggara);
        return redirect(route('sub-penyelenggara.index'))->with('success', 'berhasil didelete');
    }

    public function change($id)
    {
        $this->authorize('change-status-sub-penyelenggara', SubPenyelenggara::class);
        $this->subPenyelenggaraService->changeStatus($id);
        return redirect(route('sub-penyelenggara.index'))->with('success', 'berhasil diupdate status');
    }
}
