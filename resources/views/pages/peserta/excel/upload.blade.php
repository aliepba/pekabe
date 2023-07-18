@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <input id="uuid" value="{{$data->uuid}}" hidden />
        <div class="card-header py-3">
            <h4 class="h4">Form Kegiatan</h4>
        </div>
        <div class="card-body">
            <form action="{{route('excel.import', $data->uuid)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Upload File</label>
                            <input type="file" class="form-control" name="excel" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Format Upload Excel</label><br />
                            <a href="{{asset('format/format_excel.xlsx')}}" class="btn btn-sm btn-info">Format Excel</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="h4">Peserta Import</h4>
        </div>
        <div class="card-body">
            <span class="badge badge-success">Mohon Edit dan Submit untuk Peserta untuk pelaporan</span>
            <div class="table-responsive mt-5">
                <div id="data"></div>
              </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Kirim Email Penolakan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="form-group">
                        <label>NIK Peserta</label>
                        <input type="text" class="form-control" name="nik" id="nik" readonly/>
                        <input type="text" class="form-control" name="id" id="id" readonly/>
                        <input type="text" class="form-control" name="uuid" id="idKegiatan" readonly/>
                    </div>
                    <div class="form-group">
                        <label>Unsur Kegiatan</label>
                        <select class="form-control" name="unsur" id="unsur">
                        </select>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save changes</button>
            </div>
            </form>

        </div>
        </div>
    </div>


    <script>
        $(document).ready(function(){
            var uuid = $('#uuid').val();
            read(uuid)
        });

        function read(uuid){
            $.get("/data-excel/"+uuid, function(data){
                $('#data').html(data)
            })
        }

        function updatePeserta(id){
               $.get('/detail-peserta/'+id, function(data){
                    $("#nik").val(data.data.nik);
                    $("#id").val(data.data.id);
                    $("#idKegiatan").val(data.data.id_kegiatan);
                    $("#unsur").empty()
                    
                    if (data.kegiatan.unsur_kegiatan && data.kegiatan.unsur_kegiatan.length > 0) {
                        for (var i = 0; i < data.kegiatan.unsur_kegiatan.length; i++) {
                            var optionValue = data.kegiatan.unsur_kegiatan[i].unsur.id;
                            var optionText = data.kegiatan.unsur_kegiatan[i].unsur.nama_sub_unsur;

                            var option = $('<option></option>').attr('value', optionValue).text(optionText);
                            
                            if (optionValue === 16) {
                                option.attr('selected', 'selected');
                            }

                            $('#unsur').append(option);
                        }
                    }
                    
                   $("#edit").modal("toggle");
               })
        }

        $('#editForm').submit(function(e){
            e.preventDefault();
            var idKegiatan = $("#idKegiatan").val();
            var nik = $("#nik").val();
            var id = $("#id").val();
            var unsur = $("#unsur").val();

            $.ajax({
                url : "/peserta-updated/"+id,
                type : "PUT",
                data : {
                    id : id,
                    nik: nik,
                    unsur : unsur,
                    _token : "{{csrf_token()}}"
                },
                success:function(res){
                        $("#edit").modal('hide');
                        document.getElementById("editForm").reset();
                        Swal.fire(
                            'Good job!',
                            'Peserta updated',
                            'success'
                        )
                        read(res.data.id_kegiatan)
                    }
                })
            })
    </script>
@endpush
