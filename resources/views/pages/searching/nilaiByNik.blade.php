@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
         <h4> Cek Nilai SKPK</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <input type="hidden" name="csrf_token" value="{{ csrf_token() }}" id="token">
                        <input type="text" class="form-control" id="nik" placeholder="Masukan Nomor Induk Kependudukan" />
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-lg btn-block btn-primary" id="btnSearch">Search</button>
                </div>
            </div>
            <table class="table table-bordered" id="list" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Id Sub Bidang</th>
                    <th>Nilai SKPK</th>
                  </tr>
                </thead>
                <tbody>
                    <tr class="nofound">
                        <td colspan="4">
                            <p class="text-center">Data no found !</p>
                        </td>
                    </tr>
                </tbody>
              </table>
        </div>
      </div>
</div>
@endsection

@push('addon-script')
<script>
    $("#btnSearch").on("click", function(){
        let nik = $('#nik').val();
        let token = $('#token').val();

        if(nik == null){
            alert('masukan nik terlebih dahulu')
        }

        $.ajax({
            url : "{{route('get.sertifikat')}}",
            type : "POST",
            data : {
                "nik" : nik,
                "_token" : token
            },
            success:function(res){
                if(res !== 'NODATA'){
                    console.log(res)
                    rowIndex = 0;
                    for(let i = 0; i < res.length; i++){
                        $('#list > tbody .nofound').remove();
                        rowIndex++;
                        txt = '<tr id="row_" +>' + rowIndex + '</td>'
                        txt += '<td>' + rowIndex + '</td>'
                        txt += '<td>' + res[i].nama + '</td>'
                        txt += '<td>' + res[i].des_sub_klas + '</td>'
                        txt += '<td>' + res[i].nilai + '</td>'
                        txt += '</tr>';

                        $('#list > tbody').append(txt);
                    }
                }else{
                    alert('Data tidak ditemukan')
                }
            },
            error: function(xhr, status, error){
                alert(xhr, status, error);
            }
        })
    })  
</script>
@endpush