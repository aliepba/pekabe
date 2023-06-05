<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="h4">Form Kegiatan</h4>
    </div>
    <div class="card-body">
        <span class="badge badge-success">Informasi
            Silahkan cek kembali data tenaga ahli yang terlibat dan laporan kegiatan. Setelah klik tombol LAPORKAN, maka berkas sudah final dan tidak dapat diubah.</span>
        <div class="table mt-5">
            <table class="table table-bordered" id="kegiatan" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>File</th>
                  <th>Materi Kegiatan</th>
                  <th>Dokumentasi Kegiatan</th>
                  <th>Status Laporan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <a href="{{asset('storage/'. $data->laporan->upload_persyaratan)}}" class="btn btn-sm btn-primary rounded-lg" target="_blank"><i class="flaticon-file"></i>Laporan Kegiatan</a>
                    </td>
                    <td>
                        <a href="{{asset('storage/'. $data->laporan->materi_kegiatan)}}" class="btn btn-sm btn-primary rounded-lg" target="_blank"><i class="flaticon-file"></i>Materi Kegiatan</a>
                    </td>
                    <td>
                        <a href="{{asset('storage/'. $data->laporan->dokumentasi_kegiatan)}}" class="btn btn-sm btn-primary rounded-lg" target="_blank"><i class="flaticon-file"></i>Dokumentasi Kegiatan</a>
                    </td>
                    <td>{{$data->laporan->status_laporan}}</td>
                    <td>
                        @if ($data->laporan->status_laporan == 'OPEN')
                        <a href="{{route('pelaporan.edit', $data->laporan->id)}}" class="btn btn-sm btn-primary">Edit</a>
                        <a href="{{route('pelaporan.submit', $data->laporan->id)}}" class="btn btn-sm btn-success">Submit</a>
                        @else
                        <span class="badge badge-success">Submitted</span>
                        @endif
                    </td>
                </tr>
              </tbody>
            </table>
          </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
      <span class="badge badge-danger mt-2">
        *) Disclamer!, Dengan menyetujui ketentuan ini kami sepenuhnya bertanggungjawab terhadap segala resiko sebagai akibat dari pelaporan kegiatan PKB,
         termasuk bukti laporan yang disampaikan <br/> beserta daftar peserta kegiatan yang
        telah kami selenggarakan.Kami siap melayani segala bentuk pengaduan dari Peserta kegiatan sebagai akibat kelalaian pelaporan kegiatan ini.
      </span>
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
              </tr>
          </thead>
          <tbody>
            @foreach ($data->peserta as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{\App\Actions\Logbook\GetNamaTenagaAhli::run($item->nik_peserta)}}</td>
                <td>{{$item->nik_peserta}}</td>
                <td>{{$item->metode_peserta}}</td>
                <td>{{$item->unsur->nama_sub_unsur}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

