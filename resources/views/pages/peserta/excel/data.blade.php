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
              <a href="javascript:void(0)" onclick="updatePeserta({{$item->id}})" class="btn btn-sm btn-primary">Edit</a>
              <form action="{{route('excel.destroy', ['id' => $item->id, 'uuid' => $item->id_kegiatan])}}" method="post">
                  @csrf
                  @method('delete')
              <button class="btn btn-danger btn-sm mt-5"><i class="flaticon2-trash"></i></button>
              </form>
              @endif

              @if ($item->unsur_peserta != null)
              <a href="javascript:void(0)" onclick="updatePeserta({{$item->id}})" class="btn btn-sm btn-primary">Edit</a>
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
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" ></script>
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<script>
$(document).ready(function () {
        $('#peserta').DataTable();
    });
</script>