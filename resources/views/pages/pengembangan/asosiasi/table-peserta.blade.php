<div class="card shadow mb-4">
    <div class="card-header py-3">
        
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="peserta" width="100%" cellspacing="0">
          <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Metode</th>
                <th>Unsur</th>
                <th>Nilai</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($data->peserta as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{\App\Actions\Logbook\GetNamaTenagaAhli::run($item->nik)}}</td>
                <td>{{$item->nik}}</td>
                <td>{{$item->metode}}</td>
                <td>{{$item->subUnsur->nama_sub_unsur}}</td>
                <td>{{\App\Actions\Referensi\GetNilaiPengembangan::run($item->id_kegiatan, $item->nik, $item->unsur)}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
