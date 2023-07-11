<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="h4">Form Kegiatan</h4>
    </div>
    <div class="card-body">
        <div class="table mt-5">
            <table class="table table-bordered" id="kegiatan" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Laporan Kegiatan</th>
                  <th>Materi Kegiatan</th>
                  <th>Dokumentasi Kegiatan</th>
                  <th>Status Laporan</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <a href="http://localhost:2121/{{$data->laporan->laporan_kegiatan}}" class="btn btn-sm btn-primary rounded-lg" target="_blank"><i class="flaticon-file"></i>Laporan Kegiatan</a>
                    </td>
                    <td>
                        <a href="http://localhost:2121/{{$data->laporan->materi_kegiatan}}" class="btn btn-sm btn-primary rounded-lg" target="_blank"><i class="flaticon-file"></i>Materi Kegiatan</a>
                    </td>
                    <td>
                        <a href="http://localhost:2121/{{$data->laporan->dokumentasi_kegiatan}}" class="btn btn-sm btn-primary rounded-lg" target="_blank"><i class="flaticon-file"></i>Dokumentasi Kegiatan</a>
                    </td>
                </tr>
              </tbody>
            </table>
          </div>
    </div>
  </div>

