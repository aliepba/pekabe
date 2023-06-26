<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PKB</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #000;">
            <a class="navbar-brand" href="#">PKB</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation"></button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <section class="container mt-5">
        <h4 class="text-center">Kegiatan Yang Akan Terselenggara</h4>
        <table class="table" id="kegiatan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Subklasifikasi</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Email Penyelenggara</th>
                    <th>Penyelenggara</th>
                    <th>CP Penyelenggara / Link Pendaftaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kegiatan as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>  
                        <td>{{$item->subklasifikasi}}</td>
                        <td>{{$item->nama_kegiatan}}</td>
                        <td>{{$item->start_kegiatan}}</td>
                        <td>{{$item->end_kegiatan}}</td>
                        <td>{{$item->user->email}}</td>
                        <td>{{$item->user->name}}</td>
                        <td>{{$item->contact_person}} - {{$item->link_kegiatan}}
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br/>
        <br/>
        <h4 class="text-center">Kegiatan Yang Telah Terselenggara</h4>
        <table class="table mb-5" id="done">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Email Penyelenggara</th>
                    <th>Penyelenggara</th>
                    <th>CP Penyelenggara</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($done as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>  
                        <td>{{$item->nama_kegiatan}}</td>
                        <td>{{$item->start_kegiatan}}</td>
                        <td>{{$item->end_kegiatan}}</td>
                        <td>{{$item->user->email}}</td>
                        <td>{{$item->user->name}}</td>
                        <td>{{$item->contact_person}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" ></script>

    <script>
        $(document).ready(function () {
            $('#kegiatan').DataTable();
            $('#done').DataTable();
        });
    </script>
</body>
</html>