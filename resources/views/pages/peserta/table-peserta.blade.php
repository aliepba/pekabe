    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <a href="{{route('peserta.create', $data->uuid)}}" class="btn btn-sm btn-primary">
            <i class="flaticon-plus"></i>
            Tambah Peserta
          </a>
          <a href="{{route('excel', $data->uuid)}}" class="btn btn-sm btn-info">Upload Excel</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="peserta" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Metode</th>
                    <th>Unsur</th>
                    <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($data->peserta as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->nik_peserta}}</td>
                    <td>{{$item->metode_peserta}}</td>
                    <td>{{$item->unsur->nama_sub_unsur}}</td>
                    <td>
                        <a href="{{route('peserta.edit', $item->id)}}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{route('peserta.destroy', $item->id)}}" method="post">
                            @csrf
                            @method('delete')
                        <button class="btn btn-danger btn-sm mt-5"><i class="flaticon2-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
