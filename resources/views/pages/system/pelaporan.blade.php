<div class="card shadow mb-4">  
    <div class="card-header">
        Setting Active / Nonactive Pelaporan
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Setting</th>
                <th>Status</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Pelaporan Maks 14 Hari</td>
                    <td>{{$item->is_active == 1 ? 'Active' : 'Nonactive'}}</td>
                    <td>
                        <a href="{{route('setting.update')}}" 
                            class="btn btn-sm btn-primary">{{$item->is_active == 1 ? 'Nonactive' : 'Active'}}</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>