<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="h4">QR Code Absen Peserta Kegiatan</h4>
    </div>
    <div class="card-body">
        <span class="badge badge-success">Informasi
            Silahkan cek kembali data tenaga ahli yang terlibat dan laporan kegiatan. Setelah klik tombol LAPORKAN, maka berkas sudah final dan tidak dapat diubah.</span>
        <div class="table mt-5">
            <table class="table table-bordered" id="kegiatan" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>QRCode</th>
                  <th>Link</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td>1</td>
                    <td>
                      <img src="{{$data->qrcode}}">
                    </td>
                    <td>
                        <a href="{{$data->link_form}}" class="badge badge-success">{{$data->link_form}}</a>
                    </td>
                </tr>
              </tbody>
            </table>
          </div>
    </div>
</div>