<div class="card card-custom shadow mb-4">
    <div class="card-header flex-wrap py-3">
        <div class="card-title">
            <h4 class="h4">Daftar Kegiatan Aplikasi Lama</h4>
        </div>
    </div>
    <div class="card-body">
      <div class="table">
        <table class="table table-bordered" id="kegiatan" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Id Sub Bidang</th>
              <th>Deskripsi Bidang</th>
              <th>Kualifikasi</th>
              <th>Prakiraan SKPK</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($skpk as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item['id_sub_bidang']}}</td>
                    <td>{{$item['des_sub_klas']}}</td>
                    <td>{{$item['kualifikasi']}}</td>
                    <td>{{$item['nilai_skpk']}}</td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
</div>
