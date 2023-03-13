<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Berita Acara Pengesahan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .table-custom {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    {{-- $registeredAt = $user->status_submit->isoFormat('D MMMM Y'); --}}
    <div class="container">
        <h4 class="h4 text-center">BERITA ACARA PENGESAHAN/PENETAPAN</h4>
        <h4 class="h4 text-center">KEGIATAN PKB TERVERIFIKASI</h4>
        <br />
        <p>Berdasarkan hasil verifikasi, dan validasi, serta penilaian yang dilakukan
            oleh ..... terhadap kegiatan {{$data->nama_kegiatan}} yang diselenggarakan
            oleh {{$data->user->name}} pada tanggal {{date_format($data->updated_at, "d")}} bulan {{date_format($data->updated_at, "F")}}
            tahun {{date_format($data->updated_at, "Y")}} , dengan
            klasifikasi sebagai berikut :
        </p>
        <table border="0" style="font-size: 16px">
            <tr>
                <th width="200px">Unsur Kegiatan *)</th>
                <th>:</th>
                <th>
                    @foreach ($data->unsurKegiatan as $item)
                        {{$item->unsur->nama_sub_unsur}}
                    @endforeach
                </th>
            </tr>
            <tr>
                <th width="200px">Jenis Kegiatan</th>
                <th>:</th>
                <th>Kegiatan PKB Terverifikasi</th>
            </tr>
            <tr>
                <th width="200px">Sifat Kegiatan</th>
                <th>:</th>
                <th>Khusus</th>
            </tr>
            <tr>
                <th width="200px">Metode Kegiatan</th>
                <th>:</th>
                <th>{{$data->metode_kegiatan}}</th>
            </tr>
            <tr>
                <th width="200px">Tingkat Kegiatan</th>
                <th>:</th>
                <th>
                    {{$result = ($data->tingkat_kegiatan == 1) ? 'Nasional' : (($data->tingkat_kegiatan == 2) ? 'Internasional Dalam Negeri' : 'Internasional Luar Negeri')}}
                </th>
            </tr>
        </table>
        <br />
        <p>Kegiatan {{$data->nama_kegiatan}} ditetapkan sebagai Kegiatan PKB terverifikasi dan memperoleh
            angka kredit sesuai dengan hasil verifikasi dan validasi yang mengacu kepada
            ketentuan perundang-undangan yang berlaku.
        </p>
        <br/>
        <p>
            Demikian Berita Acara ini dibuat untuk dapat dipergunakan sebagaimana mestinya dan
            apabila dikemudian hari terdapat kekeliruan akan dilakukan perbaikan
            sebagaimana mestinya
        </p>
        <br/>
        <div style="width: 50%; text-align: center; float: right;">
            Tanggal Cetak
        </div><br><br><br><br><br></div><br></div>
        <div style="width: 60%; text-align: center; float: right;"> Jakarta, {{Carbon\Carbon::now()}}</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>
</html>
