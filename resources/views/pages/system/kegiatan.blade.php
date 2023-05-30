<div class="card shadow mb-4">  
    <div class="card-header">
        Setting Active / Nonactive Pengajuan Kegiatan
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Maks Hari Sebelum Kegiatan</th>
                <th>Status</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$kegiatan->maks_hari}} Hari</td>
                    <td>{{$kegiatan->is_active == 1 ? 'Active' : 'Nonactive'}}</td>
                    <td>
                        <a href="{{route('setting.kegiatan')}}" 
                            class="btn btn-sm btn-primary">{{$kegiatan->is_active == 1 ? 'Nonactive' : 'Active'}}</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>