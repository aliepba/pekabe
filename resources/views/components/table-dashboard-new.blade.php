<div class="card card-custom mt-5">
    <div class="card-body pt-0 table-responsive scroller">
        <table class="table align-middle table-bordered fs-6 gy-5" id="kt_table_users">
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
              {{-- @for ($i = 0; $i < count($data); $i+++) --}}
                {{-- <tr class="text-center">
                    <td>{{$i}}</td>
                    <td>{{}}</td> --}}
                    {{-- <td>{{$data[$i]->kualifikasi}}</td>
                    <td>{{$data[$i]->sub}}</td>
                    <td>{{$data[$i]->tanggal_cetak}}</td>
                    <td>{{$data[$i]->berlaku}}</td>
                    <td>{{$data[$i]->syarat1}}</td>
                    <td>{{$data[$i]->utama}}</td>
                    <td>{{$data[$i]->syarat2}}</td>
                    <td>{{$data[$i]->penunjang}}</td>
                    <td>{{$data[$i]->penunjang1}}</td>
                    <td>{{$data[$i]->utama1}}</td>
                    <td></td>
                    <td></td>
                    <td>{{$data[$i]->syarat1}}</td>
                    <td>{{$data[$i]->selainNon}}</td>
                    <td>{{$data[$i]->syarat2}}</td>
                    <td>{{$data[$i]->non}}</td>
                    <td>{{$data[$i]->non1}}</td>
                    <td>{{$data[$i]->selainNon1}}</td>
                    <td></td>
                    <td></td>
                    <td>{{$data[$i]->syarat3}}</td>
                    <td>{{$data[$i]->terverifikasi}}</td>
                    <td>{{$data[$i]->syarat4}}</td>
                    <td>{{$data[$i]->unverifed}}</td>
                    <td>{{$data[$i]->unverifed1}}</td>
                    <td>{{$data[$i]->terverifikasi1}}</td>
                    <td></td>
                    <td></td>
                    <td>{{$data[$i]->syarat3}}</td>
                    <td>{{$data[$i]->khusus}}</td>
                    <td>{{$data[$i]->syarat4}}</td>
                    <td>{{$data[$i]->umum}}</td>
                    <td>{{$data[$i]->umum}}</td>
                    <td>{{$data[$i]->khusus1}}</td>
                    <td></td>
                    <td></td>
                    <td>{{$data[$i]->syarat}}</td>
                    <td>{{$data[$i]->all}}</td>
                    <td></td>
                    <td>{{$data[$i]->status}}</td> --}}
                {{-- </tr>   --}}
              {{-- @endfor --}}
                @foreach ($data as $item)
                <tr class="text-center">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item['jabatan_kerja']}}</td>
                    <td>{{$item['kualifikasi']}}</td>
                    <td>-</td>
                    <td>{{$item['berlaku']}}</td>
                    <td>
                    @if ($item['kualifikasi'] <= 9)
                        {{date('Y-m-d', strtotime('+5 year', strtotime($item['berlaku'])))}}
                    @else
                    {{date('Y-m-d', strtotime('+3 year', strtotime($item['berlaku'])))}}
                    @endif
                    </td>
                    <td>{{$item['syarat1']}}</td>
                    <td>{{$item['utama']}}</td>
                    <td>{{$item['syarat2']}}</td>
                    <td>{{$item['penunjang']}}</td>
                    <td>{{$item['penunjang1']}}</td>
                    <td>{{$item['utama1'] }}</td>
                    <td></td>
                    <td></td>
                    <td>{{$item['syarat1']}}</td>
                    <td>{{$item['selainNon']}}</td>
                    <td>{{$item['syarat2']}}</td>
                    <td>{{$item['non']}}</td>
                    <td>{{$item['non1']}}</td>
                    <td>{{$item['selainNon1'] }}</td>
                    <td></td>
                    <td></td>
                    <td>{{$item['syarat3']}}</td>
                    <td>{{$item['terverifikasi']}}</td>
                    <td>{{$item['syarat4']}}</td>
                    <td>{{$item['unverifed']}}</td>
                    <td>{{$item['unverifed1'] }}</td>
                    <td>{{$item['terverifikasi1']}}</td>
                    <td></td>
                    <td></td>
                    <td>{{$item['syarat3']}}</td>
                    <td>{{$item['khusus']}}</td>
                    <td>{{$item['syarat4']}}</td>
                    <td>{{$item['umum']}}</td>
                    <td>{{$item['umum1'] }}</td>
                    <td>{{$item['khusus1']}}</td>
                    <td></td>
                    <td></td>
                    <td>{{$item['syarat']}}</td>
                    <td>{{$item['all']}}</td>
                    <td></td>
                    <td colspan="2">{{$item['status']}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
