@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <a href="{{route('roles.create')}}" class="btn btn-sm btn-primary">
            <i class="flaticon-plus"></i>
            Add Role
          </a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="akun" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Instansi</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Status Permohonan</th>
                    <th>Tanggal Proses</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($list as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->nama_instansi}}</td>
                    <td>{{$item->email_instansi}}</td>
                    <td>{{$item->alamat}}</td>
                    <td>{{$item->telepon}}</td>
                    <td>{{$item->status_permohonan}}</td>
                    <td>{{$item->tgl_proses == null ? 'Data Import PKB Lama' : $item->tgl_proses}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>
@endsection

@push('addon-script')
    <script>
        $(document).ready(function () {
            $('#akun').DataTable();
        });
    </script>
@endpush
