@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="h4">Form Kegiatan</h4>
        </div>
        <div class="card-body">
            <form action="{{route('excel.import', $data->uuid)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Upload File</label>
                            <input type="file" class="form-control" name="excel" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Format Upload Excel</label><br />
                            <a href="{{asset('format/format_excel.xlsx')}}" class="btn btn-sm btn-info">Format Excel</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="h4">Peserta Import</h4>
        </div>
        <div class="card-body">
            <span class="badge badge-success">Mohon Edit dan Submit untuk Peserta untuk pelaporan</span>
            <div class="table-responsive mt-5">
                <table class="table table-bordered" id="peserta" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Kegiatan</th>
                        <th>NIK</th>
                        <th>Metode</th>
                        <th>Unsur</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($data->excelPeserta as $item)
                    @if ($item->acc == 0)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->id_kegiatan}}</td>
                        <td>{{$item->nik}}</td>
                        <td>{{$item->metode}}</td>
                        <td>{{$item->unsur_peserta != null ? $item->unsur->nama_sub_unsur : 'Harap Edit'}}</td>
                        <td>
                            @if ($item->unsur_peserta == null)
                            <a href="{{route('excel.edit', $item->id)}}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{route('excel.destroy', ['id' => $item->id, 'uuid' => $item->id_kegiatan])}}" method="post">
                                @csrf
                                @method('delete')
                            <button class="btn btn-danger btn-sm mt-5"><i class="flaticon2-trash"></i></button>
                            </form>
                            @endif

                            @if ($item->unsur_peserta != null)
                            <a href="{{route('excel.edit', $item->id)}}" class="btn btn-sm btn-primary">Edit</a>
                            <a href="{{route('excel.acc', ['id' => $item->id, 'uuid' => $item->id_kegiatan])}}" class="btn btn-sm btn-success">Simpan</a>
                            <form action="{{route('excel.destroy', ['id' => $item->id, 'uuid' => $item->id_kegiatan])}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm mt-5"><i class="flaticon2-trash"></i></button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
        </div>
    </div>
</div>
@endsection
