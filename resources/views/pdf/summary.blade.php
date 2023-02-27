<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Summary SKPK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .table-custom {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 class="h3">Daftar Kegiatan Pengembangan Keprofesian Berkelanjutan (PKB) </h3>
        <h3 class="h3">Lembaga Pengembangan Jasa Konstruksi</h3>
        <br />
        <br />
        <table border="0" style="font-size: 16px">
            <tr>
                <th width="200px">Nama</th>
                <th>:</th>
                <th>{{$data->Nama}}</th>
            </tr>
            <tr>
                <th width="200px">NIK</th>
                <th>:</th>
                <th>{{$data->NIK}}</th>
            </tr>
            <tr>
                <th width="200px">Kode Subklasifikasi</th>
                <th>:</th>
                <th>{{$data->id_sub_bidang}}</th>
            </tr>
            <tr>
                <th width="200px">Subklasifikasi</th>
                <th>:</th>
                <th>{{$data->des_sub_klas}}</th>
            </tr>
        </table>
        <br />
        <br />
        <table class="table-custom" style="margin-left: -30px;">
            <thead>
                <tr>
                    <th width="50px" style="text-align: center;">No</th>
                    <th width="350px">Nama Kegiatan</th>
                    <th style="text-align: center" width="150px">Tanggal</th>
                    <th width="50px" style="text-align: center;">SKPK</th>
                </tr>
            </thead>
            <tbody class="table-custom">
                @foreach ($kegiatan as $item)
                    <tr style="border: 1px solid black;">
                        <td style="text-align: center;">{{$loop->iteration}}</td>
                        <td>{{$item->nama_kegiatan}}</td>
                        <td style="text-align: center">{{$item->mulai_kegiatan}}
                            <br />
                            s/d
                            <br/> {{$item->selesai_kegiatan}}</td>
                        <td style="text-align: center;">{{$item->prakiraan_skpk}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" style="text-align: center;">Jumlah Total SKPK</td>
                    <td height="30px" style="text-align: center;">{{$rekap->rekap}}</td>
                </tr>
            </tbody>
        </table>
        <br />
        <br />
        <br />
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
