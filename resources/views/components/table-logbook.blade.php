<div class="card card-custom mt-5">
    <div class="card-body pt-0 table-responsive scroller">
        <table class="table table align-middle table-row-dashed fs-6 gy-5" id="kegiatan">
            <thead class="text-center" style="vertical-align: middle;">
                <tr>
                    <th rowspan="3">Kegiatan Ke</th>
                    <th rowspan="3">Nama Kegiatan</th>
                    <th rowspan="3">Tanggal Mulai</th>
                    <th colspan="{{4+count($data)}}">Klasifikasi Kegiatan</th>
                    <th colspan="{{count($data)*2}}">Nilai SKPK</th>
                    <th rowspan="3">Action</th>
                </tr>
                <tr>
                    <th rowspan="2">Unsur Kegiatan</th>
                    <th rowspan="2">Jenis</th>
                    <th colspan="{{count($data)}}">Sifat</th>
                    <th rowspan="2">Metode</th>
                    <th rowspan="2">Tingkat</th>
                    <th colspan="{{count($data)}}" style="border-right : 1px;">Berdasarkan Penilaian Mandiri</th>
                    <th colspan="{{count($data)}}">Sudah Verifikasi Validasi</th>
                </tr>
                <tr>
                    @foreach ($data as $item)
                        <th>{{$item->des_sub_klas}}</th>
                    @endforeach
                    @foreach ($data as $item)
                    <th>{{$item->des_sub_klas}}</th>
                    @endforeach
                    @foreach ($data as $item)
                    <th>{{$item->des_sub_klas}}</th>
                @endforeach
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($kegiatan as $d)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$d->nama_kegiatan}}</td>
                        <td>{{$d->start_kegiatan}}</td>
                        <td>{{$d->unsur_kegiatan}}</td>
                        <td>{{$d->is_verifikasi == 1 ? 'Terverifikasi' : 'Tidak Tervefikasi'}}</td>
                        @foreach ($data as $item)
                        <td>Khusus</td>
                        @endforeach
                        <td>{{$d->metode_kegiatan}}</td>
                        <td>{{$result = ($d->tingkat_kegiatan == 1) ? 'Nasional' : (($d->tingkat_kegiatan == 2) ? 'Internasional Dalam Negeri' : 'Internasional Luar Negeri')}}</td>
                        @foreach ($data as $item)
                        @if ($d->is_verifikasi == 1)
                        <td>{{App\Actions\Logbook\GetNilaiLogbook::run($item->id_sub_bidang, $item->tanggal_cetak, $d->uuid, $d->id_unsur)}}</td>
                        @endif
                        @if ($d->is_verifikasi == 0)
                        <td>{{\App\Actions\Logbook\GetNilaiLogbookUnverified::run($item->tanggal_cetak,$d->uuid)}}</td>
                        @endif
                        @endforeach
                        @foreach ($data as $item)
                        @if ($d->is_verifikasi == 1)
                        <td>{{App\Actions\Logbook\GetNilaiLogbook::run($item->id_sub_bidang, $item->tanggal_cetak, $d->uuid, $d->id_unsur)}}</td>
                        @endif
                        @if ($d->is_verifikasi == 0)
                        <td>{{\App\Actions\Logbook\GetNilaiLogbookUnverified::run($item->tanggal_cetak,$d->uuid)}}</td>
                        @endif
                        @endforeach
                        <td>
                            @if ($d->is_verifikasi == 1)
                                Terverifikasi
                            @endif
                            @if ($d->is_verifikasi == 0)
                            <a class="btn btn-sm btn-primary" href="{{route('unverified.edit', $d->id)}}">Edit</a>
                            <form action="{{route('unverified.delete', $d->id)}}" method="post">
                                @csrf
                                @method('delete')
                            <button class="btn btn-danger btn-sm mt-5"><i class="flaticon2-trash"></i></button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@push('addon-script')
    <script>
        $(document).ready(function () {
            $('#kegiatan').DataTable();
        });
    </script>
@endpush
