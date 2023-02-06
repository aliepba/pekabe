<div class="card card-custom mt-5">
    <div class="card-body pt-0 table-responsive scroller">
        <table class="table table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
            <!--begin::Table head-->
            <thead>
                <tr>
                <th rowspan=4 style="text-align:center;vertical-align: middle;"><div><b>No</b></div></th>
                <th rowspan=4 style="text-align:center;vertical-align: middle;"><div><b>Jabatan Kerja</b></div></th>
                <th rowspan=4 style="text-align:center;vertical-align: middle;"><div>Jenjang</div></th>
                <th rowspan=4 style="text-align:center;vertical-align: middle;"><div>Klasifikasi-Sub Klasifikasi</div></th>
                <th rowspan=4 style="text-align:center;vertical-align: middle;"><div>Mulai berlaku</div></th>
                <th rowspan=4 style="text-align:center;vertical-align: middle;"><div>Masa Berakhir</div></th>
                <th colspan=4 style="text-align:center"><div>Perolehan Angka Kredit</div></th>
                <th colspan=8 style="text-align:center"><div>Syarat 1</div></th>
                <th colspan=8 style="text-align:center"><div>Syarat 2</div></th>
                <th colspan=8 style="text-align:center"><div>Syarat 3</div></th>
                <th colspan=8 style="text-align:center"><div>Syarat 4</div></th>
                <th colspan=4 style="text-align:center"><div>Syarat 5</div></th>
                <th  style="text-align:center"><div>Status</div></th>
                </tr>
                <tr>
                <th colspan=2 style="text-align:center"><div>Terverifikasi</div></th>
                <th colspan=2 style="text-align:center"><div>Tidak Terverifikasi</div></th>

                <th colspan=4 style="text-align:center"><div>Kegiatan PKB Utama</div></th>
                <th colspan=4 style="text-align:center"><div>Kegiatan PKB Penunjang</div></th>
                <th colspan=4 style="text-align:center"><div>Kegiatan Pendidikan Nonformal</div></th>
                <th colspan=4 style="text-align:center"><div>Selain Kegiatan Pendidikan Nonformal</div></th>


                <th colspan=4 style="text-align:center"><div>Kegiatan PKB Terverifikasi</div></th>
                <th colspan=4 style="text-align:center"><div>Kegiatan PKB Tidak Terverifikasi</div></th>

                <th colspan=4 style="text-align:center"><div>Kegiatan PKB Khusus</div></th>
                <th colspan=4 style="text-align:center"><div>Kegiatan PKB Umum</div></th>
                <th colspan=4 style="text-align:center"><div>Nilai Kredit</div></th>
                <th rowspan=3 style="text-align:center;vertical-align: middle;"><div>Memenuhi/Belum Memenuhi</div></th>
                </tr>
                <tr>
                <th rowspan=2 style="text-align:center"><div>Berdasarkan Pelaporan</div></th>
                <th rowspan=2 style="text-align:center"><div>Setelah verifikasi,validasi dan penilaian</div></th>

                <th rowspan=2 style="text-align:center"><div>Berdasarkan penilaian mandiri</div></th>
                <th rowspan=2 style="text-align:center"><div>Setelah verifikasi,validasi dan penilaian</div></th>

                <th colspan=4 style="text-align:center"><div>> 75%</div></th>
                <th colspan=4 style="text-align:center"><div>< 25%</div></th>
                <th colspan=4 style="text-align:center"><div>< 25%</div></th>
                <th colspan=4 style="text-align:center"><div>> 75%</div></th>


                <th colspan=4 style="text-align:center"><div>> 60%</div></th>
                <th colspan=4 style="text-align:center"><div>< 40%</div></th>

                <th colspan=4 style="text-align:center"><div>> 60%</div></th>
                <th colspan=4 style="text-align:center"><div>< 40%</div></th>

                <th colspan=4 style="text-align:center"><div>Utama=200,Madya=150,Muda=100</div></th>
                </tr>
                <tr>
                <th><div>Syarat</div></th>
                <th><div>Perolehan</div></th>
                <th><div>M/T</div></th>
                <th><div>Lebihan</div></th>
                <th><div>Syarat</div></th>
                <th><div>Perolehan</div></th>
                <th><div>M/T</div></th>
                <th><div>Lebihan</div></th>

                <th><div>Syarat</div></th>
                <th><div>Perolehan</div></th>
                <th><div>M/T</div></th>
                <th><div>Lebihan</div></th>
                <th><div>Syarat</div></th>
                <th><div>Perolehan</div></th>
                <th><div>M/T</div></th>
                <th><div>Lebihan</div></th>

                <th><div>Syarat</div></th>
                <th><div>Perolehan</div></th>
                <th><div>M/T</div></th>
                <th><div>Lebihan</div></th>
                <th><div>Syarat</div></th>
                <th><div>Perolehan</div></th>
                <th><div>M/T</div></th>
                <th><div>Lebihan</div></th>

                <th><div>Syarat</div></th>
                <th><div>Perolehan</div></th>
                <th><div>M/T</div></th>
                <th><div>Lebihan</div></th>
                <th><div>Syarat</div></th>
                <th><div>Perolehan</div></th>
                <th><div>M/T</div></th>
                <th><div>Lebihan</div></th>

                <th><div>Syarat</div></th>
                <th><div>Perolehan</div></th>
                <th><div>M/T</div></th>
                <th><div>Lebihan</div></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr class="text-center">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->id_sub_bidang}} - {{$item->des_sub_klas}}</td>
                    <td>{{$item->kualifikasi}}</td>
                    <td>-</td>
                    <td>{{$item->tanggal_cetak}}</td>
                    <td>{{date('Y-m-d', strtotime('+3 year', strtotime($item->tanggal_cetak)))}}</td>
                    <td>{{$ak[0]->angka_kredit}}</td>
                    <td>{{$byValidasi[0]->angka_kredit}}</td>
                    <td></td>
                    <td></td>
                    <td>120</td>
                    <td>{{$utama[0]->angka_kredit}}</td>
                    <td></td>
                    <td></td>
                    <td>90</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>80</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>72</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>120</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>80</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>200</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
