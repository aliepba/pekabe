<div class="card card-custom mt-5">
    <div class="card-body pt-0 table-responsive scroller">
        <table class="table table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
            <thead class="text-center" style="vertical-align: middle;">
                <tr>
                    <th rowspan="3">Kegiatan Ke</th>
                    <th rowspan="3">Nama Kegiatan</th>
                    <th rowspan="3">Tanggal Mulai</th>
                    <th colspan="9">Klasifikasi Kegiatan</th>
                </tr>
                <tr>
                    <th rowspan="2">Unsur Kegiatan</th>
                    <th rowspan="2">Jenis</th>
                    <th colspan="{{count($data)}}">Sifat</th>
                    <th rowspan="2">Metode</th>
                    <th rowspan="2">Tingkat</th>
                </tr>
                <tr>
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
                        <td>Terverifikasi</td>
                        @foreach ($data as $item)
                        <td>Khusus</td>
                        @endforeach
                        <td>{{$d->metode_kegiatan}}</td>
                        <td>{{$d->tingkat_kegiatan}}</td>
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
