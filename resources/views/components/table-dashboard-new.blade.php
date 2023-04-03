<div class="card card-custom mt-5">
    <div class="card-body pt-0 table-responsive scroller">
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
            <!--begin::Table head-->
            <thead>
                <tr>
                    <th rowspan=4 style="text-align:center;vertical-align: middle;"><div><b>No</b></div></th>
                    <th rowspan=4 style="text-align:center;vertical-align: middle;"><div><b>Jabatan Kerja</b></div></th>
                    <th rowspan=4 style="text-align:center;vertical-align: middle;"><div>Jenjang</div></th>
                    <th rowspan=4 style="text-align:center;vertical-align: middle;"><div>Klasifikasi-Sub Klasifikasi</div></th>
                    <th rowspan=4 style="text-align:center;vertical-align: middle;"><div>Mulai berlaku</div></th>
                    <th rowspan=4 style="text-align:center;vertical-align: middle;"><div>Masa Berakhir</div></th>
                    <th colspan=8 style="text-align:center"><div>Syarat 1</div></th>
                    <th colspan=8 style="text-align:center"><div>Syarat 2</div></th>
                    <th colspan=8 style="text-align:center"><div>Syarat 3</div></th>
                    <th colspan=8 style="text-align:center"><div>Syarat 4</div></th>
                    <th colspan=4 style="text-align:center"><div>Syarat 5</div></th>
                    <th rowspan=3 style="text-align:center"><div>Status</div></th>
                </tr>
                <tr>
                    <th colspan=2 style="text-align:center"><div>Kegiatan PKB Utama</div></th>
                    <th colspan=2 style="text-align:center"><div>Kegiatan PKB Penunjang</div></th>
                    <th colspan=4 style="text-align:center"><div>Hasil</div></th>

                    <th colspan=2 style="text-align:center"><div>Selain Kegiatan Pendidikan Nonformal</div></th>
                    <th colspan=2 style="text-align:center"><div>Kegiatan Pendidikan Nonformal</div></th>
                    <th colspan=4 style="text-align:center"><div>Hasil</div></th>

                    <th colspan=2 style="text-align:center"><div>Kegiatan PKB Terverifikasi</div></th>
                    <th colspan=2 style="text-align:center"><div>Kegiatan PKB Tidak Terverifikasi</div></th>
                    <th colspan=4 style="text-align:center"><div>Hasil</div></th>

                    <th colspan=2 style="text-align:center"><div>Kegiatan PKB Khusus</div></th>
                    <th colspan=2 style="text-align:center"><div>Kegiatan PKB Umum</div></th>
                    <th colspan=4 style="text-align:center"><div>Hasil</div></th>

                    <th colspan=3 style="text-align:center"><div>Nilai Kredit <br/> Utama=200,Madya=150,Muda=100</div></th>
                    <th colspan="3" style="text-align:center"><div>Memenuhi/ Belum Memenuhi</div></th>
                </tr>
                <tr style="align-items: center;">
                    {{-- //syarat 1 --}}
                    <th style="text-align:center">Syarat <br/>(> 75%)</th>
                    <th style="text-align:center">Perolehan</th>
                    <th style="text-align:center">Syarat <br/>(< 25%)</th>
                    <th style="text-align:center">Perolehan</th>
                    <th style="text-align:center">Kelebihan/ Kekurangan Nilai Kredit pada Kegiatan PKB Penunjang</th>
                    <th style="text-align:center">Kelebihan/ Kekurangan Nilai Kredit pada Kegiatan PKB Utama</th>
                    <th style="text-align:center">M/T</th>
                    <th style="text-align:center">Penjelasan</th>

                    {{-- syarat 2 --}}
                    <th style="text-align:center">Syarat <br/>(> 75%)</th>
                    <th style="text-align:center">Perolehan</th>
                    <th style="text-align:center">Syarat <br/>(< 25%)</th>
                    <th style="text-align:center">Perolehan</th>
                    <th style="text-align:center">Kelebihan/ Kekurangan Nilai Kredit pada Kegiatan PKB Pendidikan Nonformal</th>
                    <th style="text-align:center">Kelebihan/ Kekurangan Nilai Kredit pada Kegiatan PKB selain Pendidikan Nonformal</th>
                    <th style="text-align:center">M/T</th>
                    <th style="text-align:center">Penjelasan</th>

                    {{-- syarat 3 --}}
                    <th style="text-align:center">Syarat <br/>(> 60%)</th>
                    <th style="text-align:center">Perolehan</th>
                    <th style="text-align:center">Syarat <br/>(< 40%)</th>
                    <th style="text-align:center">Perolehan</th>
                    <th style="text-align:center">Kelebihan/ Kekurangan Nilai Kredit pada Kegiatan PKB Tidak Terverifikasi</th>
                    <th style="text-align:center">Kelebihan/ Kekurangan Nilai Kredit pada Kegiatan PKB Terverifikasi</th>
                    <th style="text-align:center">M/T</th>
                    <th style="text-align:center">Penjelasan</th>

                    {{-- syarat 4 --}}
                    <th style="text-align:center">Syarat <br/>(> 60%)</th>
                    <th style="text-align:center">Perolehan</th>
                    <th style="text-align:center">Syarat <br/>(< 40%)</th>
                    <th style="text-align:center">Perolehan</th>
                    <th style="text-align:center">Kelebihan/ Kekurangan Nilai Kredit pada Kegiatan PKB Umum</th>
                    <th style="text-align:center">Kelebihan/ Kekurangan Nilai Kredit pada Kegiatan PKB Khusus</th>
                    <th style="text-align:center">M/T</th>
                    <th style="text-align:center">Penjelasan</th>

                    <th style="text-align:center">Syarat</th>
                    <th style="text-align:center">Perolehan</th>
                    <th style="text-align:center">M/T</th>
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
                    <td>{{\helpers\MyHelper::nilaiSyarat(75, $item->kualifikasi)}}</td>
                    <td>{{\App\Actions\Logbook\GetNilaiKegiatanUtama::run($item->id_sub_bidang)}}</td>
                    <td>{{\helpers\MyHelper::nilaiSyarat(25, $item->kualifikasi)}}</td>
                    <td>{{\App\Actions\Logbook\GetNilaiKegiatanPenunjang::run($item->id_sub_bidang)}}</td>
                    <td>{{\App\Actions\Logbook\GetNilaiKegiatanPenunjang::run($item->id_sub_bidang) - \helpers\MyHelper::nilaiSyarat(25, $item->kualifikasi)}}</td>
                    <td>{{\App\Actions\Logbook\GetNilaiKegiatanUtama::run($item->id_sub_bidang) - \helpers\MyHelper::nilaiSyarat(75, $item->kualifikasi)}}</td>
                    <td></td>
                    <td></td>
                    <td>{{\helpers\MyHelper::nilaiSyarat(75, $item->kualifikasi)}}</td>
                    <td>{{\App\Actions\Logbook\GetNilaiKegiatanSelainNonFormal::run($item->id_sub_bidang)}}</td>
                    <td>{{\helpers\MyHelper::nilaiSyarat(25, $item->kualifikasi)}}</td>
                    <td>{{\App\Actions\Logbook\GetNilaiKegiatanNonFormal::run($item->id_sub_bidang)}}</td>
                    <td>{{\App\Actions\Logbook\GetNilaiKegiatanNonFormal::run($item->id_sub_bidang) - \helpers\MyHelper::nilaiSyarat(25, $item->kualifikasi)}}</td>
                    <td>{{\App\Actions\Logbook\GetNilaiKegiatanSelainNonFormal::run($item->id_sub_bidang) - \helpers\MyHelper::nilaiSyarat(75, $item->kualifikasi)}}</td>
                    <td></td>
                    <td></td>
                    <td>{{\helpers\MyHelper::nilaiSyarat(60, $item->kualifikasi)}}</td>
                    <td></td>
                    <td>{{\helpers\MyHelper::nilaiSyarat(40, $item->kualifikasi)}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{\helpers\MyHelper::nilaiSyarat(60, $item->kualifikasi)}}</td>
                    <td></td>
                    <td>{{\helpers\MyHelper::nilaiSyarat(40, $item->kualifikasi)}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{\App\Actions\Logbook\GetNilaiByIDSub::run()}}</td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
