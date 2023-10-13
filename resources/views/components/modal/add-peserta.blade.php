<div class="modal fade" id="modalPeserta" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Peserta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form id="addPesertaForm">
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="number" class="form-control" name="nik" maxlength="16" placeholder="nik" id="nik" required>
                        <input type="text" name="id_kegiatan" id="id_kegiatan" value="{{$data->uuid}}" hidden/>
                    </div>
                    <div class="form-group">
                        <label>Unsur Kegiatan</label>
                        <select class="form-control" name="unsur" id="unsur">
                            @foreach ($data->unsurKegiatan as $unsurKegiatan)
                            <option value="{{$unsurKegiatan->id_unsur}}" selected>{{$unsurKegiatan->unsur->nama_sub_unsur}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Metode Kegiatan</label>
                        <div class="radio-inline">
                            <label class="radio">
                                <input type="radio" name="metode" value="Tatap Muka" id="metode"/>
                                <span></span>
                                Tatap Muka
                            </label>
                            <label class="radio">
                                <input type="radio" name="metode" value="Daring" id="metode"/>
                                <span></span>
                                Daring
                            </label>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
        $('#addPesertaForm').submit(function(e){
        e.preventDefault();

        var idKegiatan = $('#id_kegiatan').val();
        var nik = $('#nik').val();
        var unsur = $('#unsur').val();
        var metode = $('#metode').val();

        $.ajax({
            url : "{{route('peserta.add')}}",
            type : "POST",
            data : {
                id_kegiatan : idKegiatan,
                nik : nik,
                unsur : unsur,
                metode: metode,
                _token : "{{csrf_token()}}"
            },
            success:function(res){
                alert("peserta berhasil ditambah")
                location.reload();
            }
        })
    })
</script>