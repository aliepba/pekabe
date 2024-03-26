    <div class="card shadow mb-4">
        <div class="card-header py-3">
          @if (($data->status_permohonan_kegiatan == 'APPROVE' || $data->is_open == true || $data->status_permohonan_kegiatan == 'PERBAIKAN PELAPORAN' || $data->is_open == false) && \Carbon\Carbon::parse(\Carbon\Carbon::now())->diffInDays($data->end_kegiatan) <= 14 && (Auth::user()->id == $data->user_id ) )    
          <a href="{{route('peserta.create', $data->uuid)}}" class="btn btn-sm btn-primary">
            <i class="flaticon-plus"></i>
            Tambah Peserta
          </a>
          <a href="{{route('excel', $data->uuid)}}" class="btn btn-sm btn-info">Upload Excel</a>
          <br/>
          @endif
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
                    <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($peserta as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{\App\Actions\Logbook\GetNamaTenagaAhli::run($item->nik_peserta)}}</td>
                    <td>{{$item->nik_peserta}}</td>
                    <td>{{$item->metode_peserta}}</td>
                    <td>{{$item->unsur}}</td>
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
          {{ $peserta->links() }}
        </div>
      </div>
