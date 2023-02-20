@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            Daftar Permohonan Akun
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
                    <th>Tanggal Pengajuan</th>
                    <th class="text-center">Action</th>
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
                    <td>
                        <a href="{{route('detail.permohonan', $item->uuid)}}" class="btn btn-sm btn-primary"><i class="flaticon-eye"></i> Proses</a>
                    </td>
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
