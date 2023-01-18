@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="font-weight">Form Role</h5>
        </div>
        <div class="card-body">
            <form action="{{route('bobot-penilaian.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Nama Unsur</label>
                            <input type="text" class="form-control" name="nama_unsur"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nilai Terverifikasi</label>
                            <input type="number" class="form-control" name="verif" step=".01"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nilai Tidak Terverifikasi Penyelenggara Terverfikasi</label>
                            <input type="number" class="form-control" name="not_verif_penyelenggara" step=".01"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nilai Tidak Terverifikasi Penyelenggara Tidak Terverfikasi</label>
                            <input type="number" class="form-control" name="not_verif_not_penyelenggara" step=".01"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nilai Mandiri</label>
                            <input type="number" class="form-control" name="mandiri" step=".01"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nilai Umum</label>
                            <input type="number" class="form-control" name="umum" step=".01"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Nilai Khusus</label>
                            <input type="text" class="form-control" name="khusus" step=".01"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nilai Tatap Muka</label>
                            <input type="number" class="form-control" name="tatap_muka" step=".01"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nilai Daring</label>
                            <input type="number" class="form-control" name="daring" step=".01"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nilai Nasional</label>
                            <input type="number" class="form-control" name="nasional" step=".01"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nilai Internasional Dalam Negeri</label>
                            <input type="number" class="form-control" name="internasional_dalam_negeri" step=".01"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nilai Internasional Luar Negeri</label>
                            <input type="number" class="form-control" name="internasional_luar_negeri" step=".01"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </form>
        </div>
      </div>
</div>
@endsection

