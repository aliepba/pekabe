    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <a href="{{route('peserta.create', $data->uuid)}}" class="btn btn-sm btn-primary">
            <i class="flaticon-plus"></i>
            Tambah Peserta
          </a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="peserta" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Unsur</th>
                    <th>Metode</th>
                    <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($data->peserta as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->nik_peserta}}</td>
                    <td>{{$item->unsur_peserta}}</td>
                    <td>{{$item->metode_peserta}}</td>
                    <td>
                        <a href="{{route('peserta.edit', $item->id)}}" class="btn btn-sm btn-primary">Edit</a>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>