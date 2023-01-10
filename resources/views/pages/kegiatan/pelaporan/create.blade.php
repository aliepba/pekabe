    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="h4">Form Kegiatan</h4>
        </div>
        <div class="card-body">
            @if ($data->laporan != null)
            <div class="table">
                <table class="table table-bordered" id="kegiatan" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>File</th>
                      <th>Status Laporan</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td>1</td>
                        <td>
                            <a href="" class="btn btn-sm btn-primary rounded-lg"><i class="flaticon-file"></i>Laporan</a>
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
                            <label>Upload Berkas Pelaporan</label>
                            <input type="file" class="form-control" name="upload_persyaratan" required />
                            <input type="text" name="id_kegiatan" value="{{$data->uuid}}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="h5">Format Laporan Kegiatan</h5>
                        <div class="form-group">
                            <label><span class="text-danger">*</span> acuan bagi penyelenggara PKB dalam menyusun pelaporan kegiatan</label><br/>
                            <a href="" class="btn btn-sm btn-primary rounded-lg ml-2" target="_blank"><i class="flaticon-file"></i>Unduh</a>
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

