    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="h4">Form Kegiatan</h4>
        </div>
        <div class="card-body">
            @if ($data->laporan != null)
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
            @endif

            @if ($data->laporan == null)
            <form action="{{route('pelaporan.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="h5">Pelaporan</h5>
                        <div class="form-group">
                            <label>Upload Laporan Kegiatan</label>
                            <input type="file" class="form-control" name="upload_persyaratan" required />
                            <input type="hidden" name="id_kegiatan" value="{{$data->uuid}}" />
                            <span class="text-muted">Accepted formats: pdf Max file size 1Mb</span>
                        </div>
                        <div class="form-group">
                            <label>Upload Materi Kegiatan</label>
                            <input type="file" class="form-control" name="materi_kegiatan" required />
                            <span class="text-muted">Accepted formats: pdf Max file size 1Mb</span>
                        </div>
                        <div class="form-group">
                            <label>Upload Dokumentasi Kegiatan</label>
                            <input type="file" class="form-control" name="dokumentasi_kegiatan" required />
                            <span class="text-muted">Accepted formats: pdf Max file size 1Mb</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="h5">Format Laporan Kegiatan</h5>
                        <div class="form-group">
                            <label><span class="text-danger">*</span> acuan bagi penyelenggara PKB dalam menyusun pelaporan kegiatan</label><br/>
                            <a href="{{asset('format/format_laporan_kak_kegiatan.docx')}}" class="btn btn-sm btn-primary rounded-lg ml-2" target="_blank"><i class="flaticon-file"></i>Unduh</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </div>
                </div>
            </form>

            @endif
        </div>
      </div>

